<?php
//include connection file 
include("../session.php");
include("../db.php");
if ($_POST['lastid'])
    $lastid = $_POST['lastid'];
else
    $lastid = '';

$query1 = "SELECT MAX(id) AS id FROM `chats`";
$stmt1 = $conn->prepare($query1);
$stmt1->execute();
$id = $stmt1->fetchObject()->id;

if ($lastid == $id) {
    $conn = null;
    exit;
} else {
    $query2 = "SELECT * FROM `chats` WHERE `id` > :id";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':id', $lastid);
    $stmt2->execute();
    while ($row = $stmt2->fetchObject()) {
        $data["id"] = $row->id;
        $data["stud_ID"] = $row->stud_ID;
        $data["name"] = $row->name;
        $data["message"] = $row->message;
        $data["time"] = date('d/m/Y H:i', $row->time);
        $result[] = $data;
    }
    // Encoding array in JSON format
    if (!isset($result))
        echo FALSE;
    else
        echo json_encode($result);
    $conn = null;
    exit;
}
