<?php
//DB CONNECTION====================================
$servername = "remotemysql.com";
$username = "2qTzr9mwEz";
$password = "u931TbHEs5";
$database = "2qTzr9mwEz";
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
	echo $title2;
	if ($_POST['author1'])
		$author2 = $_POST['author1'];
	else
		$author2 = NULL;
	if ($_POST['bookID'])
		$bookID = $_POST['bookID'];
	else
		$bookID = NULL;
	if ($_POST['mainCategorySelect1j'])
		$mainCategorySelect1j = $_POST['mainCategorySelect1j'];
	else
		$mainCategorySelect1j = NULL;
	if ($_POST['mainCategorySelect2j'])
		$mainCategorySelect2j = $_POST['mainCategorySelect2j'];
	else
		$mainCategorySelect2j = NULL;
	if ($_POST['mainCategorySelect3j'])
		$mainCategorySelect3j = $_POST['mainCategorySelect3j'];
	else
		$mainCategorySelect3j = NULL;
	if ($_POST['mainCategorySelect4j'])
		$mainCategorySelect4j = $_POST['mainCategorySelect4j'];
	else
		$mainCategorySelect4j = NULL;
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
	if ($_POST['subCategorySelect1'])
		$subCategory = $_POST['subCategorySelect1'];
	else
		$subCategory = NULL;
	//Dont add `id` column
	$sql = "INSERT INTO `books` (`title`, `author`, `bookID`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`) VALUES ('$title2', '$author2', '$bookID', '$mainCategorySelect1j', '$mainCategorySelect2j', '$mainCategorySelect3j', '$mainCategorySelect4j', '$publisher2', '$pageCount2', '$money2', '$imgValue2', '$date_of_publication2', '$isbn2')";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
  
	header( "Location: ../addBooks.php" );
exit ;