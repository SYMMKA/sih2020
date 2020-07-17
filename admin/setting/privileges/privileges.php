<?php
//include connection file 
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$issueAccess = $_POST['issueAccess'];
$returnAccess = $_POST['returnAccess'];
$addBookAccess
    = $_POST['addBookAccess'];
$updateBookAccess
    = $_POST['updateBookAccess'];
$shelfModifyAccess
    = $_POST['shelfModifyAccess'];
$bookShelfAccess
    = $_POST['bookShelfAccess'];
$semBranchModifyAccess
    = $_POST['semBranchModifyAccess'];
$bookSemBranchAccess
    = $_POST['bookSemBranchAccess'];
$settingsAccess
    = $_POST['settingsAccess'];
$para;

try {

    $sql = "UPDATE `setting` SET `value` = :val WHERE `setting`.`parameter` = :parameter";

    $stmt = $conn->prepare($sql);

    $para = 'issueAccess';
    $stmt->bindParam(':val', $issueAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'returnAccess';
    $stmt->bindParam(':val', $returnAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'addBookAccess';
    $stmt->bindParam(':val', $addBookAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'updateBookAccess';
    $stmt->bindParam(':val', $updateBookAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'shelfModifyAccess';
    $stmt->bindParam(':val', $shelfModifyAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'bookShelfAccess';
    $stmt->bindParam(':val', $bookShelfAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'semBranchModifyAccess';
    $stmt->bindParam(':val', $semBranchModifyAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'bookSemBranchAccess';
    $stmt->bindParam(':val', $bookSemBranchAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    $para = 'settingsAccess';
    $stmt->bindParam(':val', $settingsAccess);
    $stmt->bindParam(':parameter', $para);
    $stmt->execute();

    exit('success');
} catch (PDOException $e) {

    exit($e);
}