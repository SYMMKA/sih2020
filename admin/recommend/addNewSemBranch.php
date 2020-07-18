<?php
//include connection file 
include("../session.php");
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if ($_POST['semester'] && $_POST['branch']) {
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $query = "INSERT INTO `sem_branch` (`sem`,`branch`) VALUES (:semester, :branch)";
        for ($i = 1; $i <= $semester; $i++) {
            # code...
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':semester', $i);
            $stmt->bindParam(':branch', $branch);
            $stmt->execute();
        }
    }
    $conn = null;
    exit('success');
} catch (PDOException $e) {
    $conn = null;
    exit($e);
}
