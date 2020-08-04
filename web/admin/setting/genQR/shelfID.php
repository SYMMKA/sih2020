<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$query = "SELECT * FROM `shelf`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$shelfID = $result->shelfID;
	$return_arr[] = $shelfID;
}
echo json_encode($return_arr);
$conn = null;