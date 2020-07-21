<?php
include("../../session.php");
include("../../db.php");
$relative = dirname($_SERVER["SCRIPT_NAME"], 4) . '/';
$domain = $_SERVER['HTTP_HOST'] . $relative;
$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$link = $prefix . $domain;

$bookID = $_POST['bookID'];
$shelfID = NULL;
$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'updateBookAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if($access > $adminLevel){
	echo "\nAccess not granted";
	$conn = null;
	exit;
}

// To get original book properties
$query = "SELECT * FROM `main` Where `main`.`bookID` = :bookID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':bookID', $bookID);
$stmt->execute();
$row = $stmt->fetchObject();
$change = 0;

if ($_POST['title'] != $row->title) {
	$title = $_POST['title'];
	$change = 1;
} else
	$title = $row->title;

if ($_POST['author'] != $row->author) {
	$author = $_POST['author'];
	$change = 1;
} else
	$author = $row->author;

if ($_POST['isbn'] != $row->isbn) {
	$isbn = $_POST['isbn'];
	$change = 1;
} else
	$isbn = $row->isbn;

if ($_POST['mainCategory1'] != $row->Category1) {
	$category1 = $_POST['mainCategory1'];
	$change = 1;
} else
	$category1 = $row->Category1;

if ($_POST['mainCategory2'] != $row->Category2) {
	$category2 = $_POST['mainCategory2'];
	$change = 1;
	echo "hi";
} else
	$category2 = $row->Category2;

if ($_POST['mainCategory3'] != $row->Category3) {
	$category3 = $_POST['mainCategory3'];
	$change = 1;
} else
	$category3 = $row->Category3;

if ($_POST['mainCategory4'] != $row->Category4) {
	$category4 = $_POST['mainCategory4'];
	$change = 1;
} else
	$category4 = $row->Category4;

if ($_POST['publisher'] != $row->publisher) {
	$publisher = $_POST['publisher'];
	$change = 1;
} else
	$publisher = $row->publisher;

if ($_POST['publishedDate'] != $row->date_of_publication) {
	$date_of_publication = $_POST['publishedDate'];
	$change = 1;
} else
	$date_of_publication = $row->date_of_publication;

if (!isset($_FILES["imgFile"]['tmp_name']))
	$imgLink = $row->imgLink;
else {
	//check image upload
	if ($_FILES["imgFile"]["error"] == 0) {
		/* Location */
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . $relative . "bookImage/";
		$target_file = $target_dir . basename($_FILES["imgFile"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image

		$check = getimagesize($_FILES["imgFile"]["tmp_name"]);
		if ($check !== false) {
			echo "<br>" . "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "<br>" . "File is not an image.";
			$uploadOk = 0;
		}
		// Check file size
		/* if ($_FILES["imgFile"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		} */

		/* Valid Extensions */
		$valid_extensions = array("jpg", "jpeg", "png");
		/* Check file extension */
		if (!in_array(strtolower($imageFileType), $valid_extensions)) {
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "<br>" . "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			$temp = explode(".", $_FILES["imgFile"]["name"]);
			$imageName = $bookID . '.' . end($temp);
			$imageDest = $target_dir . $imageName;
			if (move_uploaded_file($_FILES["imgFile"]["tmp_name"], $imageDest)) {
				echo "<br>" . "The file " . basename($_FILES["imgFile"]["name"]) . " has been uploaded.";
				$imgLink = $link . "bookImage/" . $imageName;
				$change = 1;
			} else {
				echo "<br>" . "Sorry, there was an error uploading your file.";
				$uploadOk = 0;
				echo "<br>" . "Wrong file format.";
			}
		}
	}
}

$pages = $row->pages;
if ($row->book == 1) {
	if ($_POST['pageCount'] != $row->pages) {
		$pages = $_POST['pageCount'];
		$change = 1;
	}
}

$prevOrgQuan = $row->quantity;
$quantity = $row->quantity;
$orgQuan = $row->orgQuan;
$source = '';
$dop = '';
$oldID = '';
$price = '';
if ($row->digital == 0) {
	if ($_POST['addQuan']>0) {
		$addQuan = $_POST['addQuan'];
		$quantity = $addQuan + $row->quantity;
		$prevOrgQuan = $row->orgQuan;
		$orgQuan =  $addQuan + $prevOrgQuan;

		if ($_POST['source'])
			$source = $_POST['source'];

		if ($_POST['dop'])
			$dop = $_POST['dop'];

		if ($_POST['oldID'])
			$oldID = json_decode($_POST['oldID']);

		if ($_POST['money'])
			$price = $_POST['money'];
	}
 } else {
	if (!isset($_FILES["mediaFile"]['tmp_name']))
		$digitalLink = $row->digitalLink;
	else {
		if ($_FILES["mediaFile"]["error"] == 0) {
			/* Location */
			$target_dir = $_SERVER["DOCUMENT_ROOT"] . $relative . "book_audio/";
			$target_file = $target_dir . basename($_FILES["mediaFile"]["name"]);
			$mediaFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image

			$check = filesize($_FILES["mediaFile"]["tmp_name"]);
			if ($check !== false) {
				echo "<br>" . "File is not corrupt.";
				$uploadOk = 1;
			} else {
				echo "<br>" . "File is corrupt.";
				$uploadOk = 0;
			}

			/* Valid Extensions */
			$valid_extensions = array("pdf", "epub", "mp3", "wav");
			/* Check file extension */
			if (!in_array(strtolower($mediaFileType), $valid_extensions)) {
				$uploadOk = 0;
				echo "<br>" . "Wrong file format.";
			}

			if ($uploadOk == 0) {
				echo "<br>" . "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
			} else {
				$temp = explode(".", $_FILES["mediaFile"]["name"]);
				$mediaName = $bookID . '.' . end($temp);
				$mediaDest = $target_dir . $mediaName;
				if (move_uploaded_file($_FILES["mediaFile"]["tmp_name"], $mediaDest)) {
					echo "<br>" . "The file " . basename($_FILES["mediaFile"]["name"]) . " has been uploaded.";
					$digitalLink = $link . "book_audio/" . $mediaName;
					$change = 1;
				} else {
					echo "<br>" . "Sorry, there was an error uploading your file.";
					$uploadOk = 0;
				}
			}
		}
	}
}

//oldID and shelfID for newly added copies not inserted
try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `main` SET `title` = :title, `author` = :author, `quantity` = :quantity, `Category1` = :category1, `Category2` = :category2, `Category3` = :category3, `Category4` = :category4, `publisher` = :publisher, `pages` = :pages, `imgLink` = :imgLink, `date_of_publication` = :date_of_publication, `isbn` = :isbn, `orgQuan` = :orgQuan, `digitalLink` = :digitalLink WHERE `main`.`bookID` = :bookID";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':title', $title);
	$stmt1->bindParam(':author', $author);
	$stmt1->bindParam(':quantity', $quantity);
	$stmt1->bindParam(':category1', $category1);
	$stmt1->bindParam(':category2', $category2);
	$stmt1->bindParam(':category3', $category3);
	$stmt1->bindParam(':category4', $category4);
	$stmt1->bindParam(':publisher', $publisher);
	$stmt1->bindParam(':pages', $pages);
	$stmt1->bindParam(':imgLink', $imgLink);
	$stmt1->bindParam(':date_of_publication', $date_of_publication);
	$stmt1->bindParam(':isbn', $isbn);
	$stmt1->bindParam(':orgQuan', $orgQuan);
	$stmt1->bindParam(':bookID', $bookID);
	$stmt1->bindParam(':digitalLink', $digitalLink);
	$stmt1->execute();
	echo "\nMain table updated";

	//if new copy added
	if ($_POST['addQuan']) {
		$sql2 = "INSERT INTO `copies` (`bookID`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`, `purchaseTime`, `purchaseSource`, `price`) VALUES (:bookID, :copyNO, :oldID, '', NULL, NULL, '', NULL, :shelfID, :purchaseTime, :purchaseSource, :price)";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->bindParam(':bookID', $bookID);
		$stmt2->bindParam(':shelfID', $shelfID);
		$stmt2->bindParam(':purchaseTime', $dop);
		$stmt2->bindParam(':purchaseSource', $source);
		$stmt2->bindParam(':price', $price);

		$sql3 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, NULL, 'add', UNIX_TIMESTAMP(), :bookID, :oldID)";
		$stmt3 = $conn->prepare($sql3);
		$stmt3->bindParam(':adminID', $adminID);
		$stmt3->bindParam(':bookID', $bookID);

		for ($copyNO = $prevOrgQuan + 1; $copyNO <= $orgQuan; $copyNO++) {
			$stmt2->bindParam(':copyNO', $copyNO);
			$stmt2->bindParam(':oldID', $oldID[$copyNO-1-$prevOrgQuan]);
			$stmt2->execute();
			echo "\nCopies table updated";

			$copyID = $bookID . ' - ' . $copyNO;
			$stmt3->bindParam(':copyID', $copyID);
			$stmt3->bindParam(':oldID', $oldID[$copyNO-1-$prevOrgQuan]);
			$stmt3->execute();
			echo "\nAdded to history table";
		}
	}

	// if book property changed
	if ($change == 1) {
		$sql4 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES ('-', :adminID, NULL, 'update', UNIX_TIMESTAMP(), :bookID, '')";
		$stmt4 = $conn->prepare($sql4);
		$stmt4->bindParam(':adminID', $adminID);
		$stmt4->bindParam(':bookID', $bookID);
		$stmt4->execute();
		echo "\nHistory table updated";
	}

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
