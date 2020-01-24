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
	//Dont add `id` column
	$sql = "INSERT INTO `books` (`title`, `author`, `bookID`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`) VALUES ('$title2', '$author2', '$bookID', '$mainCategorySelect1', '$mainCategorySelect2', '$mainCategorySelect3', '$mainCategorySelect4', '$publisher2', '$pageCount2', '$money2', '$imgValue2', '$date_of_publication2', '$isbn2')";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
  
	header( "Location: ../addBooks.php" );
exit ;
?>