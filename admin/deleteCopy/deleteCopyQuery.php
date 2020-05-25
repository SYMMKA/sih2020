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
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

//Dont add `id` column
$sql = "DELETE FROM `copies` WHERE `copies`.`copyID` = '$copyID'";
if ($conn->query($sql) === TRUE) {
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header( "Location: ../searchBooks.php" );
exit;
