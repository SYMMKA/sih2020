<?php

include("../database.php");

$sql1 = "SELECT * FROM issued ";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

$sql2 = "SELECT * FROM students WHERE `students`.`stud_ID` = :stud_ID";
$stmt2 = $conn->prepare($sql2);

while ($row1 = $stmt1->fetchObject()) {

    $data["bookID"] = $row1->bookID;
    $data["time"] = $row1->time;
    $data["returnTime"] = $row1->returnTime;
    $data["fine"] = $row1->fine;
    $data["stud_ID"] = $row1->stud_ID;

    $stmt2->bindParam(':stud_ID', $row1->stud_ID);
    $stmt2->execute();
    $row2 = $stmt2->fetchObject();

    $data["stud_ID"] = $row2->stud_ID;
    $data["name"] = $row2->name;

    $points = $row2->points;
    $issueTime = $row1->time;
    $returnTime = $issueTime + 60 * 60 * 24 * 2;
    $currentTime = time();
    $stud_ID = $row1->stud_ID;

    if ($currentTime > $returnTime) {
        $timediff = floor(($currentTime - $returnTime) / 86400);
        $data["timediff"] = $timediff;
        $data["points"] = $points - 5;
        $points = $points - 5;

        $sqlupdate1 = "UPDATE `students` SET `points`= '$points' WHERE `stud_ID`='$stud_ID' ";
        $stmtupdate1 = $conn->prepare($sqlupdate1);
        $stmtupdate1->execute();
    } 
    else if ($currentTime == $issueTime) {
        $points = $points + 20;
        $sqlupdate2 = "UPDATE `students` SET `points`= '$points' WHERE `stud_ID`='$stud_ID' ";
        $stmtupdate2 = $conn->prepare($sqlupdate2);
        $stmtupdate2->execute();
    }
    $return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
    echo FALSE;
else
    echo json_encode($return_arr);

$conn = null;
exit;
