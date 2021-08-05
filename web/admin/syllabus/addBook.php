<?php
//include connection file 
include("../../session.php");
include("../../database.php");

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'bookSemBranchAccess'";
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

$bookIDs = $_POST['bookIDs'];
$bookIDs = json_decode($bookIDs);
$sem_branchID = $_POST['sem_branchID'];

$query = "INSERT INTO `syllabus` (`sem_branchID`, `bookID`) VALUES (:sem_branchID, :bookID)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':sem_branchID', $sem_branchID);

foreach($bookIDs as $key=>$bookID) {
	$stmt->bindParam(':bookID', $bookID);
	if($stmt->execute()) {
		echo "\n".$bookID." added";
	}
}

$conn = null;
exit;
