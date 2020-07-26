<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$dueFineParam = 'dueFine';
$duePointParam = 'duePoint';
$issueNumParam = 'issueNum';
$issuePeriodParam = 'issuePeriod';
$issuePointParam = 'issuePoint';
$ratingPointParam = 'ratingPoint';
$reserveNumParam = 'reserveNum';
$reservePeriodParam = 'reservePeriod';
$returnPointParam = 'returnPoint';

$teacherDueFineParam = 'teacherDueFine';
$teacherDuePointParam = 'teacherDuePoint';
$teacherIssueNumParam = 'teacherIssueNum';
$teacherIssuePeriodParam = 'teacherIssuePeriod';
$teacherIssuePointParam = 'teacherIssuePoint';
$teacherRatingPointParam = 'teacherRatingPoint';
$teacherReserveNumParam = 'teacherReserveNum';
$teacherReservePeriodParam = 'teacherReservePeriod';
$teacherReturnPointParam = 'teacherReturnPoint';

$UPIaddressParam = 'UPIaddress';

$sql = "SELECT `value` FROM `setting` WHERE `parameter` = :parameter";
$stmt = $conn->prepare($sql);

// student
$stmt->bindParam(':parameter', $dueFineParam);
$stmt->execute();
$dueFine = $stmt->fetchObject()->value;
$return['dueFine'] = $dueFine;

$stmt->bindParam(':parameter', $duePointParam);
$stmt->execute();
$duePoint = $stmt->fetchObject()->value;
$return['duePoint'] = $duePoint;

$stmt->bindParam(':parameter', $issueNumParam);
$stmt->execute();
$issueNum = $stmt->fetchObject()->value;
$return['issueNum'] = $issueNum;

$stmt->bindParam(':parameter', $issuePeriodParam);
$stmt->execute();
$issuePeriod = $stmt->fetchObject()->value;
$return['issuePeriod'] = $issuePeriod;

$stmt->bindParam(':parameter', $issuePointParam);
$stmt->execute();
$issuePoint = $stmt->fetchObject()->value;
$return['issuePoint'] = $issuePoint;

$stmt->bindParam(':parameter', $ratingPointParam);
$stmt->execute();
$ratingPoint = $stmt->fetchObject()->value;
$return['ratingPoint'] = $ratingPoint;

$stmt->bindParam(':parameter', $reserveNumParam);
$stmt->execute();
$reserveNum = $stmt->fetchObject()->value;
$return['reserveNum'] = $reserveNum;

$stmt->bindParam(':parameter', $reservePeriodParam);
$stmt->execute();
$reservePeriod = $stmt->fetchObject()->value;
$return['reservePeriod'] = $reservePeriod;

$stmt->bindParam(':parameter', $returnPointParam);
$stmt->execute();
$returnPoint = $stmt->fetchObject()->value;
$return['returnPoint'] = $returnPoint;

// teacher
$stmt->bindParam(':parameter', $teacherDueFineParam);
$stmt->execute();
$teacherDueFine = $stmt->fetchObject()->value;
$return['teacherDueFine'] = $teacherDueFine;

$stmt->bindParam(':parameter', $teacherDuePointParam);
$stmt->execute();
$teacherDuePoint = $stmt->fetchObject()->value;
$return['teacherDuePoint'] = $teacherDuePoint;

$stmt->bindParam(':parameter', $teacherIssueNumParam);
$stmt->execute();
$teacherIssueNum = $stmt->fetchObject()->value;
$return['teacherIssueNum'] = $teacherIssueNum;

$stmt->bindParam(':parameter', $teacherIssuePeriodParam);
$stmt->execute();
$teacherIssuePeriod = $stmt->fetchObject()->value;
$return['teacherIssuePeriod'] = $teacherIssuePeriod;

$stmt->bindParam(':parameter', $teacherIssuePointParam);
$stmt->execute();
$teacherIssuePoint = $stmt->fetchObject()->value;
$return['teacherIssuePoint'] = $teacherIssuePoint;

$stmt->bindParam(':parameter', $teacherRatingPointParam);
$stmt->execute();
$teacherRatingPoint = $stmt->fetchObject()->value;
$return['teacherRatingPoint'] = $teacherRatingPoint;

$stmt->bindParam(':parameter', $teacherReserveNumParam);
$stmt->execute();
$teacherReserveNum = $stmt->fetchObject()->value;
$return['teacherReserveNum'] = $teacherReserveNum;

$stmt->bindParam(':parameter', $teacherReservePeriodParam);
$stmt->execute();
$teacherReservePeriod = $stmt->fetchObject()->value;
$return['teacherReservePeriod'] = $teacherReservePeriod;

$stmt->bindParam(':parameter', $teacherReturnPointParam);
$stmt->execute();
$teacherReturnPoint = $stmt->fetchObject()->value;
$return['teacherReturnPoint'] = $teacherReturnPoint;

// UPi for payment
$stmt->bindParam(':parameter', $UPIaddressParam);
$stmt->execute();
$UPIaddress = $stmt->fetchObject()->value;
$return['UPIaddress'] = $UPIaddress;

echo json_encode($return);
$conn = null;