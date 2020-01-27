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
	if ($_POST['stud_name'])
		$st_name = $_POST['stud_name'];
	else
		$st_name = NULL;
	if ($_POST['stud_email'])
		$st_email = $_POST['stud_email'];
	else
		$st_email = NULL;
	if ($_POST['stud_id']) {
		$st_id = $_POST['stud_id'];
	} else
		$st_id = NULL;
	if ($_POST['title'])
		$title2 = $_POST['title'];
	else
		$title2 = NULL;
	if ($_POST['author'])
		$author = $_POST['author'];
	else
		$author = NULL;
	if ($_POST['bookID'])
		$bookID = $_POST['bookID'];
	else
		$bookID = NULL;
	if ($_POST['isbn'])
		$isbn = $_POST['isbn'];
	else
		$isbn = NULL;
	if ($_POST['issue_date'])
		$issue_date = $_POST['issue_date'];
	else
		$issue_date = NULL;

	//Dont add `id` column
	$sql = "INSERT INTO `issued` (`stud_name`, `stud_email`, `stud_id`, `title`, `author`, `bookID`, `isbn`, `issue_date`) VALUES ('$st_name', '$st_email', '$st_id', '$title2', '$author', '$bookID', '$isbn', '$issue_date')";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
  
	header( "Location: ../searchBooks.php" );
exit ;
?>