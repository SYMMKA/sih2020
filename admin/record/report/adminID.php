<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$query = "SELECT * FROM `adminlogin`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$return_arr[] = $result->userID;
}
echo json_encode($return_arr);
