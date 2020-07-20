<?php
//include connection file 
include("../session.php");
include("../db.php");

$bookIDs = $_POST['bookIDs'];
$bookIDs = json_decode($bookIDs);
$sem_branchID = $_POST['sem_branchID'];

$query = "DELETE FROM `syllabus` WHERE `bookID`=:bookID AND `sem_branchID`=:sem_branchID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':sem_branchID', $sem_branchID);

foreach($bookIDs as $key=>$bookID) {
	$stmt->bindParam(':bookID', $bookID);
	if($stmt->execute()) {
		echo "\n".$bookID." removed";
	}
}

$conn = null;
exit;
