<?php
include("../database.php");

$sql = "SELECT * FROM timetable ORDER BY id ASC ";

$stmt = $conn->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	$data["day"] = $row->day;
    $data["comment"] = $row->comment;

	if($row->start=="00:00:00")
	{
		$data["start"] = "";
	}
	else
	{
		$data["start"] = $row->start;
	}
	if($row->end=="00:00:00")
	{
		$data["end"] = "";
	}
	else
	{
		$data["end"] = $row->end;
	}
    $return_arr[] = $data;
}

if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);
