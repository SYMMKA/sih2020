<?php
include("../../session.php");
include("../../db.php");

$copyID = $_POST['copyID'];
$shelfID = $_POST['shelfID'];

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE `copies` SET `shelfID` = :shelfID WHERE `copies`.`copyID` = :copyID";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':shelfID', $shelfID);
	$stmt->bindParam(':copyID', $copyID);
	$stmt->execute();
	echo $copyID . " added to " . $shelfID . " successfully";
} catch (PDOException $e) {
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
