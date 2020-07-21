<?php
//include connection file 
include("../session.php");
include("../db.php");

$userType = $_POST['userType'];
$query = "SELECT * FROM `students` WHERE `type` = :userType";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userType', $userType);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$return_arr[] = $result->stud_ID;
}
echo json_encode($return_arr);
