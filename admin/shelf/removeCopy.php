<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$copyID = $_POST['copyID'];
$sql = "UPDATE `copies` SET `shelfID` = NULL WHERE `copies`.`copyID` = '$copyID'";

if ($conn->query($sql) === TRUE) {
    echo $copyID;
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>