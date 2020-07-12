<?php
//include connection file 
include("../session.php");
include("../db.php");

if ($_POST['semester'] && $_POST['branch']) {
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];
} else {
    $semester = '';
    $branch = '';
}

$query = "INSERT INTO `sem_branch` (`sem`,`branch`) VALUES (:semester, :branch)";
$stmt->bindParam(':semester', $semester);
$stmt->bindParam(':branch', $branch);
$stmt = $conn->prepare($query);
$stmt->execute();

// Encoding array in JSON format
if (!isset($query))
    echo FALSE;
else
    echo json_encode($query);

$conn = null;
exit;
