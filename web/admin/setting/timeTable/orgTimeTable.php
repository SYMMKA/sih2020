<?php
include("../../../session.php");
include("../../../database.php");

$sql = "SELECT * FROM `timetable`";
$stmt = $conn->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	$day = $row->day;
	$return_arr[$day]['start'] = $row->start;
	$return_arr[$day]['end'] = $row->end;
	$return_arr[$day]['comment'] = $row->comment;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
