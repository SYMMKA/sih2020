<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$shelfID = $_POST['shelfID'];
$sql = "DELETE FROM `shelf` WHERE `shelf`.`shelfID` = '$shelfID'";

if ($conn->query($sql) === TRUE) {
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>