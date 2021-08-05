<?php
include("../../session.php");
include("../../database.php");

$bookID = $_POST['bookID'];
$sql = "SELECT * FROM copies Where `copies`.`bookID` = :bookID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':bookID', $bookID);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	$data["copyno"] = $row->copyNO;
	$data["copyID"] = $row->copyID;
	$data["oldID"] = $row->oldID;
	$data["stud_ID"] = $row->stud_ID;
	$data["status"] = $row->status;
	$data["time"]
		= date('d/m/Y H:i', $row->time);
	$data["returnTime"] =
		date('d/m/Y H:i', $row->returnTime);
	$data["currentTime"] =
		date('d/m/Y H:i', time());
	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
