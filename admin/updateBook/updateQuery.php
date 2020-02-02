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
	if ($_POST['title'])
		$title2 = $_POST['title'];
	else
		$title2 = NULL;
	if ($_POST['author'])
		$author2 = $_POST['author'];
	else
		$author2 = NULL;
	if ($_POST['encodedcatID'])
		$bookID = $_POST['encodedcatID'];
	else
		$bookID = NULL;
	$orgupdateID = $_POST['orgupdateID'];

	$sql = "UPDATE `books` SET `title` = '$title2', `author` = '$author2', `bookID` = '$bookID' WHERE `books`.`bookID` = $orgupdateID";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
  
	header( "Location: ../searchBooks.php" );
exit ;
?>