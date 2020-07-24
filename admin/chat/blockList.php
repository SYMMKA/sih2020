<?php
//include connection file 
include("../session.php");
include("../db.php");

$query = "SELECT * FROM `students` WHERE `students`.`block` = '1'";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
    $stud_ID = $result->stud_ID;
    $return_arr[$stud_ID] = $result->name;
}
echo json_encode($return_arr);
