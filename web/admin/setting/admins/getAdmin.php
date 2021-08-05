<?php
//include connection file 
include("../../../session.php");
include("../../../database.php");

$query = "SELECT * FROM `adminlogin`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$adminID = $result->userID;
	$clearance = $result->clearance;
	$return_arr[$adminID] = $clearance;
}
echo json_encode($return_arr);
$conn = null;