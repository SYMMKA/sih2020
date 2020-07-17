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

$sqlissueAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'issueAccess'";
$stmtissueAccess = $conn->prepare($sqlissueAccess);
$stmtissueAccess->execute();
$issueAccess = $stmtissueAccess->fetchObject()->value;
$return['issueAccess'] = $issueAccess;

$sqlreturnAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'returnAccess'";
$stmtreturnAccess = $conn->prepare($sqlreturnAccess);
$stmtreturnAccess->execute();
$returnAccess = $stmtreturnAccess->fetchObject()->value;
$return['returnAccess'] = $returnAccess;

$sqladdBookAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'addBookAccess'";
$stmtaddBookAccess = $conn->prepare($sqladdBookAccess);
$stmtaddBookAccess->execute();
$addBookAccess = $stmtaddBookAccess->fetchObject()->value;
$return['addBookAccess'] = $addBookAccess;

$sqlupdateBookAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'updateBookAccess'";
$stmtupdateBookAccess = $conn->prepare($sqlupdateBookAccess);
$stmtupdateBookAccess->execute();
$updateBookAccess = $stmtupdateBookAccess->fetchObject()->value;
$return['updateBookAccess'] = $updateBookAccess;

$sqlshelfModifyAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'shelfModifyAccess'";
$stmtshelfModifyAccess = $conn->prepare($sqlshelfModifyAccess);
$stmtshelfModifyAccess->execute();
$shelfModifyAccess = $stmtshelfModifyAccess->fetchObject()->value;
$return['shelfModifyAccess'] = $shelfModifyAccess;

$sqlbookShelfAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'bookShelfAccess'";
$stmtbookShelfAccess = $conn->prepare($sqlbookShelfAccess);
$stmtbookShelfAccess->execute();
$bookShelfAccess = $stmtbookShelfAccess->fetchObject()->value;
$return['bookShelfAccess'] = $bookShelfAccess;

$sqlsemBranchModifyAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'semBranchModifyAccess'";
$stmtsemBranchModifyAccess = $conn->prepare($sqlsemBranchModifyAccess);
$stmtsemBranchModifyAccess->execute();
$semBranchModifyAccess = $stmtsemBranchModifyAccess->fetchObject()->value;
$return['semBranchModifyAccess'] = $semBranchModifyAccess;

$sqlbookSemBranchAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'bookSemBranchAccess'";
$stmtbookSemBranchAccess = $conn->prepare($sqlbookSemBranchAccess);
$stmtbookSemBranchAccess->execute();
$bookSemBranchAccess = $stmtbookSemBranchAccess->fetchObject()->value;
$return['bookSemBranchAccess'] = $bookSemBranchAccess;

$sqlsettingsAccess = "SELECT `value` FROM `setting` WHERE `parameter` = 'settingsAccess'";
$stmtsettingsAccess = $conn->prepare($sqlsettingsAccess);
$stmtsettingsAccess->execute();
$settingsAccess = $stmtsettingsAccess->fetchObject()->value;
$return['settingsAccess'] = $settingsAccess;

echo json_encode($return);
$conn = null;