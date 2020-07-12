<?php
//include connection file 
include("../session.php");
include("../db.php");

$query = "SELECT * FROM `sem_branch`";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($result = $stmt->fetchObject()) {
    $branch = $result->branch;
    $sem = $result->sem;
    $return_arr[$branch][] = $sem;
}
echo json_encode($return_arr);
