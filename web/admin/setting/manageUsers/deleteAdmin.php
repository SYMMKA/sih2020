<?php
//include connection file 
include("../../../session.php");
include("../../../database.php");

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'settingsAdminAccess'";
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

$deleteAdmin = $_POST['deleteAdmin'];
$deleteAdmin = json_decode($deleteAdmin, true);

$query = "DELETE FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID";
$stmt = $conn->prepare($query);

foreach($deleteAdmin as $key=>$adminID) {
	$stmt->bindParam(':adminID', $adminID);
	if($stmt->execute())
		echo "\n".$adminID." deleted successfully";
}

$conn = null;