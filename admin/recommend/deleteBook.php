<?php
//include connection file 
include("../session.php");
include("../db.php");

if ($_POST['bookID'] && $_POST['sem_branchID']) {
    $bookID = $_POST['bookID'];
    $sem_branchID = $_POST['sem_branchID'];
} else {
    $bookID = '';
    $sem_branchID = '';
}

$query = "DELETE FROM `syllabus` WHERE `bookID`=:bookID AND `sem_branchID`=:sem_branchID";
$stmt->bindParam(':bookID', $bookID);
$stmt->bindParam(':sem_branchID', $sem_branchID);
$stmt = $conn->prepare($query);
$stmt->execute();
// Encoding array in JSON format
if (!isset($query))
    echo FALSE;
else
    echo json_encode($query);

$conn = null;
exit;
