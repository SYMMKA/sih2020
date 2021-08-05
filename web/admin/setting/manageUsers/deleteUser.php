<?php
//include connection file 
include("../../../session.php");
include("../../../database.php");

$deleteUser = $_POST['deleteUser'];
$deleteUser = json_decode($deleteUser, true);

$query = "DELETE FROM `students` WHERE `students`.`stud_ID` = :userID";
$stmt = $conn->prepare($query);

foreach($deleteUser as $key=>$userID) {
	$stmt->bindParam(':userID', $userID);
	if($stmt->execute())
		echo "\n".$userID." deleted successfully";
}

$conn = null;