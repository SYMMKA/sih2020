<?php
include("../../db.php");

$copyID = $_POST['copyID'];
$shelfID = $_POST['shelfID'];
$sql = "UPDATE `copies` SET `shelfID` = '$shelfID' WHERE `copies`.`copyID` = '$copyID'";

if ($conn->query($sql) === TRUE) {
    echo $copyID;
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>