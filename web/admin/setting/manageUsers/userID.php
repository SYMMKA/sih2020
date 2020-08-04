<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$query = "SELECT * FROM `students`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$return_arr[] = $result->stud_ID;
}
echo json_encode($return_arr);
$conn = null;