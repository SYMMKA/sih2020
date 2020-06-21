<?php
include("../db.php");

$shelfID = $_POST['shelfID'];
$sql = "DELETE FROM `shelf` WHERE `shelf`.`shelfID` = '$shelfID'";

if ($conn->query($sql) === TRUE) {
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>