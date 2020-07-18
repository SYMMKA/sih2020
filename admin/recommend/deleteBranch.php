<?php
//include connection file 
include("../session.php");
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if ($_POST['branch']) {
        $branch = $_POST['branch'];
        $query = "DELETE FROM `sem_branch` WHERE `branch`=:branch";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':branch', $branch);
        $stmt->execute();
    }
    $conn = null;
    exit('success');
} catch (PDOException $e) {
    $conn = null;
    exit($e);
}