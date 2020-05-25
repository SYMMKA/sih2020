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
if ($_POST['stud_ID']) {
	$stud_ID = $_POST['stud_ID'];
} else
	$stud_ID = NULL;
if ($_POST['oldID'])
	$oldID = $_POST['oldID'];
else
	$oldID = NULL;
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

$timePeriod = 20; //reserve time period
//Dont add `id` column
$sql = "UPDATE `copies` SET `stud_ID` = '$stud_ID', `status` = 'reserved', `time` = UNIX_TIMESTAMP(), `returntime` = UNIX_TIMESTAMP()+$timePeriod WHERE `copies`.`copyID` = '$copyID' AND (`copies`.`status` = '' OR (`copies`.`status` = 'reserved' AND `copies`.`returnTime` < UNIX_TIMESTAMP()))";
if ($conn->query($sql) === TRUE) {
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

header("Location: ../searchBooks.php");
exit;
