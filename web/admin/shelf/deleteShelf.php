<?php
include("../session.php");
include("../db.php");

$shelfID = $_POST['shelfID'];

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'shelfModifyAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if($access > $adminLevel){
	echo "\nAccess not granted";
	$conn = null;
	exit;
}

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
