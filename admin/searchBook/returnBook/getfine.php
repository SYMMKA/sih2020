<?php
include("../../session.php");
include("../../db.php");

$copyID = $_POST['copyID'];

$query = "SELECT `returnTime` FROM `copies` WHERE `copies`.`copyID` = :copyID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':copyID', $copyID);
$stmt->execute();

$result = $stmt->fetchObject();
$returnTime = $result->returnTime;
$returnDay = strtotime("today", $returnTime);
$today = time();
$days = ($today-$returnDay)/86400;
$days = floor($days);

// fine for late submission
$dueFineQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'dueFine'";
$dueFinestmt = $conn->prepare($dueFineQuery);
$dueFinestmt->execute();
$dueFinePerDay = $dueFinestmt->fetchObject()->value;
$dueFine = $dueFinePerDay*$days;

// -ve points for late submission
$duePointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'duePoint'";
$duePointstmt = $conn->prepare($duePointQuery);
$duePointstmt->execute();
$duePointPerDay = $duePointstmt->fetchObject()->value;
$point = -$duePointPerDay*$days;

// +ve points for submission in time
$returnPointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'returnPoint'";
$returnPointstmt = $conn->prepare($returnPointQuery);
$returnPointstmt->execute();
$returnPoint = $returnPointstmt->fetchObject()->value;
if($days == 0)
	$point += $returnPoint;

$return['dueFine'] = $dueFine;
$return['point'] = $point;
echo json_encode($return);