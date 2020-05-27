<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
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
else
	$imgValue2 = NULL;
if ($_POST['oldID'])
	$oldID = $_POST['oldID'];
else
	$oldID = NULL;
$shelfID = "shelfID";
//Dont add `id` column
$sql = "INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`) VALUES ('$title2', '$author2', '$quantity2', '$mainCategorySelect1', '$mainCategorySelect2', '$mainCategorySelect3', '$mainCategorySelect4', '$publisher2', '$pageCount2', '$money2', '$imgValue2', '$date_of_publication2', '$isbn2', '$quantity2')";
if ($conn->query($sql) === TRUE) {
	for ($i = 1; $i <= $quantity2; $i++) {
		$copyID = $isbn2 . '-' . $i;
		$sql1 = "INSERT INTO `copies` (`isbn`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES ('$isbn2', '$i', '$oldID', '$copyID', '', NULL, '', NULL, '$shelfID')";
		if ($conn->query($sql1) === TRUE) {
			$sql2 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('$copyID', 'admin', '-', 'add', UNIX_TIMESTAMP(), '$isbn2', '$oldID')";
			if ($conn->query($sql2) === TRUE) {
			} else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
			}
		} else {
			echo "Error: " . $sql1 . "<br>" . $conn->error;
		}
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

header("Location: ../addBooks.php");
exit;
