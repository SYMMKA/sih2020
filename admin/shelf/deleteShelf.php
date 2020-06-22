<?php
include("../db.php");

$shelfID = $_POST['shelfID'];
try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM `shelf` WHERE `shelf`.`shelfID` = '$shelfID'";
	$conn->exec($sql);
	echo "Shelf deleted successfully";
} catch (PDOException $e) {
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
