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
$sql = "UPDATE `copies` SET `stud_ID` = '', `status` = '' WHERE `copies`.`copyID` = '$copyID'";
if ($conn->query($sql) === TRUE) {
	$sql1 = "UPDATE `issued` SET `returnTime` = UNIX_TIMESTAMP() WHERE `issued`.`copyID` = '$copyID' AND `issued`.`returnTime` IS NULL";
	if ($conn->query($sql1) === TRUE) {
	} else {
		echo "Error: " . $sql1 . "<br>" . $conn->error;
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header( "Location: ../searchBooks.php" );
exit;
