<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$sqldueFine = "SELECT `value` FROM `setting` WHERE `parameter` = 'dueFine'";
$stmtdueFine = $conn->prepare($sqldueFine);
$stmtdueFine->execute();
$dueFine = $stmtdueFine->fetchObject()->value;
$return['dueFine'] = $dueFine;

$sqlduePoint = "SELECT `value` FROM `setting` WHERE `parameter` = 'duePoint'";
$stmtduePoint = $conn->prepare($sqlduePoint);
$stmtduePoint->execute();
$duePoint = $stmtduePoint->fetchObject()->value;
$return['duePoint'] = $duePoint;

$sqlissueNum = "SELECT `value` FROM `setting` WHERE `parameter` = 'issueNum'";
$stmtissueNum = $conn->prepare($sqlissueNum);
$stmtissueNum->execute();
$issueNum = $stmtissueNum->fetchObject()->value;
$return['issueNum'] = $issueNum;

$sqlissuePeriod = "SELECT `value` FROM `setting` WHERE `parameter` = 'issuePeriod'";
$stmtissuePeriod = $conn->prepare($sqlissuePeriod);
$stmtissuePeriod->execute();
$issuePeriod = $stmtissuePeriod->fetchObject()->value;
$return['issuePeriod'] = $issuePeriod;

$sqlissuePoint = "SELECT `value` FROM `setting` WHERE `parameter` = 'issuePoint'";
$stmtissuePoint = $conn->prepare($sqlissuePoint);
$stmtissuePoint->execute();
$issuePoint = $stmtissuePoint->fetchObject()->value;
$return['issuePoint'] = $issuePoint;

$sqlratingPoint = "SELECT `value` FROM `setting` WHERE `parameter` = 'ratingPoint'";
$stmtratingPoint = $conn->prepare($sqlratingPoint);
$stmtratingPoint->execute();
$ratingPoint = $stmtratingPoint->fetchObject()->value;
$return['ratingPoint'] = $ratingPoint;

$sqlreserveNum = "SELECT `value` FROM `setting` WHERE `parameter` = 'reserveNum'";
$stmtreserveNum = $conn->prepare($sqlreserveNum);
$stmtreserveNum->execute();
$reserveNum = $stmtreserveNum->fetchObject()->value;
$return['reserveNum'] = $reserveNum;

$sqlreservePeriod = "SELECT `value` FROM `setting` WHERE `parameter` = 'reservePeriod'";
$stmtreservePeriod = $conn->prepare($sqlreservePeriod);
$stmtreservePeriod->execute();
$reservePeriod = $stmtreservePeriod->fetchObject()->value;
$return['reservePeriod'] = $reservePeriod;

$sqlreturnPoint = "SELECT `value` FROM `setting` WHERE `parameter` = 'returnPoint'";
$stmtreturnPoint = $conn->prepare($sqlreturnPoint);
$stmtreturnPoint->execute();
$returnPoint = $stmtreturnPoint->fetchObject()->value;
$return['returnPoint'] = $returnPoint;

echo json_encode($return);
$conn = null;