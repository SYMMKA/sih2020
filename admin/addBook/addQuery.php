<?php
include('../session.php');
include("../db.php");
$uploadOk = 1;

if ($_POST['title1'])
	$title2 = $_POST['title1'];
else
	$title2 = '';
if ($_POST['author1'])
	$author2 = $_POST['author1'];
else
	$author2 = '';
if ($_POST['mainCategorySelect1'])
	$mainCategorySelect1 = $_POST['mainCategorySelect1'];
else
	$mainCategorySelect1 = '';
if ($_POST['mainCategorySelect2'])
	$mainCategorySelect2 = $_POST['mainCategorySelect2'];
else
	$mainCategorySelect2 = '';
if ($_POST['mainCategorySelect3'])
	$mainCategorySelect3 = $_POST['mainCategorySelect3'];
else
	$mainCategorySelect3 = '';
if ($_POST['mainCategorySelect4'])
	$mainCategorySelect4 = $_POST['mainCategorySelect4'];
else
	$mainCategorySelect4 = '';
if ($_POST['publisher1'])
	$publisher2 = $_POST['publisher1'];
else
	$publisher2 = '';
if ($_POST['publishedDate1'])
	$date_of_publication2 = $_POST['publishedDate1'];
else
	$date_of_publication2 = '';
if ($_POST['isbn1'])
	$isbn2 = $_POST['isbn1'];
else
	$isbn2 = '';
if ($_POST['pageCount1'])
	$pageCount2 = $_POST['pageCount1'];
else
	$pageCount2 = '';
if ($_POST['money1'])
	$money2 = $_POST['money1'];
else
	$money2 = '';
if ($_POST['quantity1'])
	$quantity2 = $_POST['quantity1'];
else
	$quantity2 = '1';
if ($_POST['imgValue1'])
	$imgValue2 = $_POST['imgValue1'] . "&printsec=frontcover&img=1&zoom=1&source=gbs_api";
else if (!isset($_FILES["imgFile"]['tmp_name']))
	$imgValue2 = '';
else {
	//check image upload
	if ($_FILES["imgFile"]["error"] == 0) {
		/* Location */
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/web/bookImage/";
		$target_file = $target_dir . basename($_FILES["imgFile"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["imgFile"]["tmp_name"]);
			if ($check !== false) {
				echo "<br>" . "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "<br>" . "File is not an image.";
				$uploadOk = 0;
			}
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
			$imageName = $isbn2 . '.' . end($temp);
			$newName = $target_dir . $imageName;
			if (move_uploaded_file($_FILES["imgFile"]["tmp_name"], $newName)) {
				echo "<br>" . "The file " . basename($_FILES["imgFile"]["name"]) . " has been uploaded.";
				$imgValue2 = "http://" . $_SERVER['SERVER_NAME'] . "/web/bookImage/" . $imageName;
			} else {
				echo "<br>" . "Sorry, there was an error uploading your file.";
				$uploadOk = 0;
			}
		}
	}
}

if ($_POST['oldID'])
	$oldID = $_POST['oldID'];
else
	$oldID = '';
$shelfID = NULL;
$adminID = $_SESSION['adminID'];
$digital = 0;
$book = 1;

if ($uploadOk == 1) {
	try {
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->beginTransaction();

		$sql1 = "INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`) VALUES (:title, :author, :quantity, :Category1, :Category2, :Category3, :Category4, :publisher, :pages, :price, :imgLink, :date_of_publication, :isbn, :orgQuan, :digital, :book)";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->bindParam(':title', $title2);
		$stmt1->bindParam(':author', $author2);
		$stmt1->bindParam(':quantity', $quantity2);
		$stmt1->bindParam(':Category1', $mainCategorySelect1);
		$stmt1->bindParam(':Category2', $mainCategorySelect2);
		$stmt1->bindParam(':Category3', $mainCategorySelect3);
		$stmt1->bindParam(':Category4', $mainCategorySelect4);
		$stmt1->bindParam(':publisher', $publisher2);
		$stmt1->bindParam(':pages', $pageCount2);
		$stmt1->bindParam(':price', $money2);
		$stmt1->bindParam(':imgLink', $imgValue2);
		$stmt1->bindParam(':date_of_publication', $date_of_publication2);
		$stmt1->bindParam(':isbn', $isbn2);
		$stmt1->bindParam(':orgQuan', $quantity2);
		$stmt1->bindParam(':digital', $digital);
		$stmt1->bindParam(':book', $book);
		$stmt1->execute();
		echo "New book added successfully";

		$bookID = $conn->lastInsertId();
		$sql2 = "INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES (:bookID, :copyNO, :oldID, '', NULL, NULL, '', NULL, :shelfID)";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->bindParam(':bookID', $bookID);
		$stmt2->bindParam(':oldID', $oldID);
		$stmt2->bindParam(':shelfID', $shelfID);

		$sql3 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, NULL, 'add', UNIX_TIMESTAMP(), :bookID, :oldID)";
		$stmt3 = $conn->prepare($sql3);
		$stmt3->bindParam(':adminID', $adminID);
		$stmt3->bindParam(':bookID', $bookID);
		$stmt3->bindParam(':oldID', $oldID);

		for ($copyNO = 1; $copyNO <= $quantity2; $copyNO++) {		
			$stmt2->bindParam(':copyNO', $copyNO);
			$stmt2->execute();
			echo "\nCopy no " . $copyNO . " added successfully";

			$copyID = $bookID.' - '.$copyNO;
			$stmt3->bindParam(':copyID', $copyID);
			$stmt3->execute();
			echo "\nCopy no " . $copyNO . " added to history";
		}
		$conn->commit();
	} catch (PDOException $e) {
		$conn->rollBack();
		echo "Failed " . $e->getMessage();
	}
}

$conn = null;
exit;
