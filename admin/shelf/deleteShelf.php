<?php
include("../session.php");
include("../db.php");

$shelfID = $_POST['shelfID'];
try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM `shelf` WHERE `shelf`.`shelfID` = :shelfID";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':shelfID', $shelfID);
	$stmt->execute();
	echo "Shelf deleted successfully";
} catch (PDOException $e) {
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
