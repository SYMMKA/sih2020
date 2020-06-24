<?php
include("../../session.php");
include("../../db.php");

$bookID = $_POST['bookID'];

// To get original book properties
$query = "SELECT * FROM `main` Where `main`.`bookID` = '$bookID'";
$stmt = $conn->prepare($query);
$stmt->execute();
$row = $stmt->fetchObject();
$change = 0;

if ($_POST['title']) {
	$title = $_POST['title'];
	$change = 1;
} else
	$title = $row->title;

if ($_POST['author']) {
	$author = $_POST['author'];
	$change = 1;
} else
	$author = $row->author;

if ($_POST['isbn']) {
	$isbn = $_POST['isbn'];
	$change = 1;
} else
	$isbn = $row->isbn;

if ($_POST['mainCategory1']) {
	$category1 = $_POST['mainCategory1'];
	$change = 1;
} else
	$category1 = $row->Category1;

if ($_POST['mainCategory2']) {
	$category2 = $_POST['mainCategory2'];
	$change = 1;
} else
	$category2 = $row->Category2;

if ($_POST['mainCategory3']) {
	$category3 = $_POST['mainCategory3'];
	$change = 1;
} else
	$category3 = $row->Category3;

if ($_POST['mainCategory4']) {
	$category4 = $_POST['mainCategory4'];
	$change = 1;
} else
	$category4 = $row->Category4;

if ($_POST['publisher']) {
	$publisher = $_POST['publisher'];
	$change = 1;
} else
	$publisher = $row->publisher;

if ($_POST['pageCount']) {
	$pages = $_POST['pageCount'];
	$change = 1;
} else
	$pages = $row->pages;

if ($_POST['publishedDate']) {
	$date_of_publication = $_POST['publishedDate'];
	$change = 1;
} else
	$date_of_publication = $row->date_of_publication;

if ($_POST['money']) {
	$price = $_POST['money'];
	$change = 1;
} else
	$price = $row->price;

if (!isset($_FILES["imgFile"]['tmp_name']))
	$imgLink = $row->imgLink;
else {
	//check image upload
	if ($_FILES["imgFile"]["error"] == 0) {
		/* Location */
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/web/bookImage/";
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
			$newName = $target_dir . $imageName;
			if (move_uploaded_file($_FILES["imgFile"]["tmp_name"], $newName)) {
				echo "<br>" . "The file " . basename($_FILES["imgFile"]["name"]) . " has been uploaded.";
				$imgLink = "http://" . $_SERVER['SERVER_NAME'] . "/web/bookImage/" . $imageName;
				$change = 1;
			} else {
				echo "<br>" . "Sorry, there was an error uploading your file.";
				$uploadOk = 0;
			}
		}
	}
}


if ($_POST['addQuan']) {
	$addQuan = $_POST['addQuan'];
	$quantity = $addQuan + $row->quantity;
	$prevOrgQuan = $row->orgQuan;
	$orgQuan =  $addQuan + $prevOrgQuan;
} else {
	$prevOrgQuan = $row->quantity;
	$quantity = $row->quantity;
	$orgQuan = $row->orgQuan;
}

$adminID = $_SESSION['adminID'];

//oldID and shelfID for newly added copies not inserted
try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `main` SET `title` = '$title', `author` = '$author', `quantity` = '$quantity', `Category1` = '$category1', `Category2` = '$category2', `Category3` = '$category3', `Category4` = '$category4', `publisher` = '$publisher', `pages` = '$pages', `price` = '$price', `imgLink` = '$imgLink', `date_of_publication` = '$date_of_publication', `isbn` = '$isbn', `orgQuan` = '$orgQuan' WHERE `main`.`bookID` = '$bookID'";
	$conn->exec($sql1);
	echo "Copies table updated";

	//if new copy added
	if ($_POST['addQuan']) {
		for ($copyNO = $prevOrgQuan + 1; $copyNO <= $orgQuan; $copyNO++) {
			$sql2 = "INSERT INTO `copies` (`bookID`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES ('$bookID', '$copyNO', 'oldID', '', '', NULL, '', NULL, 'name')";
			$conn->exec($sql2);
			echo "\nIssued table updated";

			$sql3 = "INSERT INTO `history` (`copyID`, `user`, `user_ID`, `action`, `time`, `bookID`, `oldID`) VALUES (CONCAT($bookID, ' - ', $copyNO), 'admin', '$adminID', 'add', UNIX_TIMESTAMP(), '$bookID', 'oldID')";
			$conn->exec($sql3);
			echo "\nAdded to history table";
		}
	}

	// if book property changed
	if ($change == 1) {
		$sql4 = "INSERT INTO `history` (`copyID`, `user`, `user_ID`, `action`, `time`, `bookID`, `oldID`) VALUES ('-', 'admin', '$adminID', 'update', UNIX_TIMESTAMP(), '$bookID', 'oldID')";
		$conn->exec($sql4);
		echo "Copies table updated";
	}

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
