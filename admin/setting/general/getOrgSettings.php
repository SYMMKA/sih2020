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

$sql = "SELECT `value` FROM `setting` WHERE `parameter` = :parameter";
$stmt = $conn->prepare($sql);

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

echo json_encode($return);
$conn = null;