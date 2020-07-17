<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$addBookAccessParam = 'addBookAccess';
$issueAccessParam = 'issueAccess';
$bookShelfAccessParam = 'bookShelfAccess';
$settingsAccessParam = 'settingsAccess';
$updateBookAccessParam = 'updateBookAccess';
$returnAccessParam = 'returnAccess';
$semBranchModifyAccessParam = 'semBranchModifyAccess';
$shelfModifyAccessParam = 'shelfModifyAccess';
$bookSemBranchAccessParam = 'bookSemBranchAccess';

$sql = "SELECT `value` FROM `setting` WHERE `parameter` = :parameter";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':parameter', $addBookAccessParam);
$stmt->execute();
$addBookAccess = $stmt->fetchObject()->value;
$return['addBookAccess'] = $addBookAccess;

$stmt->bindParam(':parameter', $issueAccessParam);
$stmt->execute();
$issueAccess = $stmt->fetchObject()->value;
$return['issueAccess'] = $issueAccess;

$stmt->bindParam(':parameter', $bookShelfAccessParam);
$stmt->execute();
$bookShelfAccess = $stmt->fetchObject()->value;
$return['bookShelfAccess'] = $bookShelfAccess;

$stmt->bindParam(':parameter', $settingsAccessParam);
$stmt->execute();
$settingsAccess = $stmt->fetchObject()->value;
$return['settingsAccess'] = $settingsAccess;

$stmt->bindParam(':parameter', $updateBookAccessParam);
$stmt->execute();
$updateBookAccess = $stmt->fetchObject()->value;
$return['updateBookAccess'] = $updateBookAccess;

$stmt->bindParam(':parameter', $returnAccessParam);
$stmt->execute();
$returnAccess = $stmt->fetchObject()->value;
$return['returnAccess'] = $returnAccess;

$stmt->bindParam(':parameter', $semBranchModifyAccessParam);
$stmt->execute();
$semBranchModifyAccess = $stmt->fetchObject()->value;
$return['semBranchModifyAccess'] = $semBranchModifyAccess;

$stmt->bindParam(':parameter', $shelfModifyAccessParam);
$stmt->execute();
$shelfModifyAccess = $stmt->fetchObject()->value;
$return['shelfModifyAccess'] = $shelfModifyAccess;

$stmt->bindParam(':parameter', $bookSemBranchAccessParam);
$stmt->execute();
$bookSemBranchAccess = $stmt->fetchObject()->value;
$return['bookSemBranchAccess'] = $bookSemBranchAccess;

echo json_encode($return);
$conn = null;