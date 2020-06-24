<?php
include('../session.php');
include("../db.php");
$uploadOk = 1;

if ($_POST['title1'])
	$title2 = $_POST['title1'];
else
	$title2 = NULL;
if ($_POST['author1'])
	$author2 = $_POST['author1'];
else
	$author2 = NULL;
if ($_POST['mainCategorySelect1'])
	$mainCategorySelect1 = $_POST['mainCategorySelect1'];
else
	$mainCategorySelect1 = NULL;
if ($_POST['mainCategorySelect2'])
	$mainCategorySelect2 = $_POST['mainCategorySelect2'];
else
	$mainCategorySelect2 = NULL;
if ($_POST['mainCategorySelect3'])
	$mainCategorySelect3 = $_POST['mainCategorySelect3'];
else
	$mainCategorySelect3 = NULL;
if ($_POST['mainCategorySelect4'])
	$mainCategorySelect4 = $_POST['mainCategorySelect4'];
else
	$mainCategorySelect4 = NULL;
if ($_POST['publisher1'])
	$publisher2 = $_POST['publisher1'];
else
	$publisher2 = NULL;
if ($_POST['publishedDate1'])
	$date_of_publication2 = $_POST['publishedDate1'];
else
	$date_of_publication2 = NULL;
if ($_POST['isbn1'])
	$isbn2 = $_POST['isbn1'];
else
	$isbn2 = NULL;
if ($_POST['pageCount1'])
	$pageCount2 = $_POST['pageCount1'];
else
	$pageCount2 = NULL;
if ($_POST['money1'])
	$money2 = $_POST['money1'];
else
	$money2 = NULL;
if ($_POST['quantity1'])
	$quantity2 = $_POST['quantity1'];
else
	$quantity2 = '1';
if ($_POST['imgValue1'])
	$imgValue2 = $_POST['imgValue1'] . "&printsec=frontcover&img=1&zoom=1&source=gbs_api";
else if (!isset($_FILES["imgFile"]['tmp_name']))
	$imgValue2 = NULL;
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
	$oldID = NULL;
$shelfID = "name";
$adminID = $_SESSION['adminID'];

if ($uploadOk == 1) {
	try {
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->beginTransaction();

		$sql1 = "INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`) VALUES ('$title2', '$author2', '$quantity2', '$mainCategorySelect1', '$mainCategorySelect2', '$mainCategorySelect3', '$mainCategorySelect4', '$publisher2', '$pageCount2', '$money2', '$imgValue2', '$date_of_publication2', '$isbn2', '$quantity2')";
		$conn->exec($sql1);
		echo "New book added successfully";

		$bookID = $conn->lastInsertId();
		for ($i = 1; $i <= $quantity2; $i++) {
			$sql2 = "INSERT INTO `copies` (`bookID`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES ('$bookID', '$i', '$oldID', '', '', NULL, '', NULL, '$shelfID')";
			$conn->exec($sql2);
			echo "\nCopy no " . $i . " added successfully";

			$sql3 = "INSERT INTO `history` (`copyID`, `user`, `user_ID`, `action`, `time`, `bookID`, `oldID`) VALUES (CONCAT('$bookID', ' - ', '$i'), 'admin', '$adminID', 'add', UNIX_TIMESTAMP(), '$bookID', '$oldID')";
			$conn->exec($sql3);
			echo "\nCopy no " . $i . " added to history";
		}
		$conn->commit();
	} catch (PDOException $e) {
		$conn->rollBack();
		echo "Failed " . $e->getMessage();
	}
}

$conn = null;
exit;
