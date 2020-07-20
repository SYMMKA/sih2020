<?php
//include connection file 
include("../../session.php");
include("../../db.php");

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