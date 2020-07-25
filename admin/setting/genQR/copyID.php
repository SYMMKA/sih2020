<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$bookIDs = $_POST['bookIDs'];
$bookIDs = json_decode($bookIDs, true);

$query = "SELECT * FROM `copies` WHERE `bookID` = :bookID";
$stmt = $conn->prepare($query);

foreach($bookIDs as $key => $bookID) {
	$stmt->bindParam(':bookID', $bookID);
	$stmt->execute();
	while ($result = $stmt->fetchObject()) {
		$copyID = $result->copyID;
		$return_arr[$bookID][] = $copyID;
	}
	
}

echo json_encode($return_arr);
$conn = null;