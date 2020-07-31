<?php
//include connection file 
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $bookID = $_POST['bookID'];

    $sql = "DELETE FROM `main` WHERE `main`.`bookID` = :bookID ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':bookID', $bookID);
    $stmt->execute();

    $conn = null;
    exit("success");
} catch (PDOException $e) {
    exit($e);
    $conn = null;
}
