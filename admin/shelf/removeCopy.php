<?php
include("../session.php");
include("../db.php");

$copyID = $_POST['copyID'];
try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE `copies` SET `shelfID` = NULL WHERE `copies`.`copyID` = :copyID";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':copyID', $copyID);
	$stmt->execute();
	echo $copyID . " removed from Shelf";
} catch (PDOException $e) {
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
