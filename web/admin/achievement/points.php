<?php
//include connection file 
include("../../session.php");
include("../../database.php");


$query = "SELECT * FROM `students` WHERE `type` = 'student' ORDER BY `points` DESC";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
    $data["stud_ID"] = $row->stud_ID;
    $data["name"] = $row->name;
    $data["email"] = $row->email;
    $data["mobile"] = $row->mobile;
    $data["points"] = $row->points;
    $result[] = $data;
}
// Encoding array in JSON format
if (!isset($result))
    echo FALSE;
else
    echo json_encode($result);

$conn = null;
exit;
