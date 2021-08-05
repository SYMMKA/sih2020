<?php
//include connection file 
include("../../../session.php");
include("../../../database.php");

$adminsIDs = $_POST['adminIDs'];
$adminsIDs = json_decode($adminsIDs, true);

foreach($adminsIDs as $adminID => $clearance) {
	$query = "UPDATE `adminlogin` SET `clearance` = :clearance WHERE `adminlogin`.`userID` = :adminID";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':clearance', $clearance);
	$stmt->bindParam(':adminID', $adminID);
	$stmt->execute();
}

$conn = null;