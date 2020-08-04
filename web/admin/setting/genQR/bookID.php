<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$query = "SELECT * FROM `main`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
	$bookID = $result->bookID;
	$return_arr[$bookID] = $result->title;
}
echo json_encode($return_arr);
$conn = null;