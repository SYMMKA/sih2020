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

$adminID = $_POST['adminID'];
$adminFirstName = $_POST['adminFirstName'];
$adminLastName = $_POST['adminLastName'];
$adminAccess = $_POST['adminAccess'];

$query = "INSERT INTO `adminlogin` (`userID`, `fname`, `lname`, `clearance`) VALUES (:userID, :fname, :lname, :clearance)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userID', $adminID);
$stmt->bindParam(':fname', $adminFirstName);
$stmt->bindParam(':lname', $adminLastName);
$stmt->bindParam(':clearance', $adminAccess);
if($stmt->execute())
	echo "Admin added successfully";

$conn = null;