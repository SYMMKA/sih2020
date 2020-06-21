<?php
include("../db.php");

$copyID = $_POST['copyID'];
$sql = "UPDATE `copies` SET `shelfID` = NULL WHERE `copies`.`copyID` = '$copyID'";

if ($conn->query($sql) === TRUE) {
    echo $copyID;
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>