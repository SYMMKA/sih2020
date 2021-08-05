<?php
//include connection file 
include("../../database.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $bookID = $_POST['bookID'];

    $sql1 = "SELECT * FROM `copies` WHERE bookID = :bookID AND `status` = 'issued' ";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':bookID', $bookID);
    $stmt1->execute();
    $count['issueCount'] = $stmt1->rowCount();

    $sql2 = "SELECT * FROM `copies` WHERE bookID = :bookID AND `status` = 'reserved' ";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':bookID', $bookID);
    $stmt2->execute();
    $count['reserveCount'] = $stmt2->rowCount();

    echo json_encode($count);
    exit;
} catch (PDOException $e) {
    exit($e);
}

$conn = null;
