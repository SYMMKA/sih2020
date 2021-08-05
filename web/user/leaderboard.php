<?php
include("../database.php");

$sql1 = "SELECT * FROM students ORDER BY points DESC;";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$rank=1;

while ($row1 = $stmt1->fetchObject()) {
	$data["rank"] = $rank;
    $data["name"] = $row1->name;
	$data["points"] = $row1->points;
	$rank++;
	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;


?>