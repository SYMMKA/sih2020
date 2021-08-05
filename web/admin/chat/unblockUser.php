<?php
//include connection file 
include("../../session.php");
include("../../database.php");

$userIDs = $_POST['userIDs'];
$userIDs = json_decode($userIDs, true);

$adminID = $_SESSION['adminID'];
$query = "UPDATE `students` SET `block` = '0' WHERE `stud_ID` = :stud_ID";
$stmt = $conn->prepare($query);

foreach ($userIDs as $userID) {
	$stmt->bindParam(':stud_ID', $userID);
	$stmt->execute();
}

$conn = null;
exit;