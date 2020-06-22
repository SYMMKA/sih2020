<?php
include("../db.php");

if ($_POST['shelfID'])
	$shelfID = $_POST['shelfID'];
else
	$shelfID = NULL;

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO `shelf` (`shelfID`) VALUES ('$shelfID')";
	$conn->exec($sql);
	echo "New shelf added successfully";
} catch (PDOException $e) {
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
