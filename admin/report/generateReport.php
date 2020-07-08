<?php
//include connection file 
include("../session.php");
include("../db.php");

if ($_POST['query'])
    $query = $_POST['query'];
else
    $query = '';

$stmt = $conn->prepare($query);
$stmt->execute();
$i = 0;
while ($row = $stmt->fetchObject()) {
    $data["id"] = $row->id;
    $data["copyID"] = $row->copyID;
    $data["adminID"] = $row->adminID;
    $data["studentID"] = $row->studentID;
    $data["action"] = $row->action;
    $data["time"] = date('d/m/Y H:i', $row->time);
    $data["bookID"] = $row->bookID;
    $data["oldID"] = $row->oldID;
    $result[] = $data;
}
// Encoding array in JSON format
if (!isset($result))
    echo FALSE;
else
    echo json_encode($result);

$conn = null;
exit;
