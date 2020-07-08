<?php
//include connection file 
include("../session.php");
include("../db.php");


$query = "SELECT * FROM `issued` WHERE `due` = 1";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
    $data["id"] = $row->id;
    $data["bookID"] = $row->bookID;
    $data["oldID"] = $row->oldID;
    $data["copyID"] = $row->copyID;
    $data["stud_ID"] = $row->stud_ID;
    $data["time"] = date('d/m/Y H:i', $row->time);
    $data["returnTime"] = date('d/m/Y H:i', $row->returnTime);
    //$data["star"] = $row->star;
    $data["fine"] = $row->fine;
    //$data["due"] = $row->due;
    $result[] = $data;
}
// Encoding array in JSON format
if (!isset($result))
    echo FALSE;
else
    echo json_encode($result);

$conn = null;
exit;
