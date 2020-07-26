<?php
//include connection file 
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// student
$issuePeriod = $_POST['issuePeriod'];
$issuePeriodParam = 'issuePeriod';

$reservePeriod = $_POST['reservePeriod'];
$reservePeriodParam = 'reservePeriod';

$issueLimit = $_POST['issueLimit'];
$issueLimitParam = 'issueNum';

$reserveLimit = $_POST['reserveLimit'];
$reserveLimitParam = 'reserveNum';

$dueFineAmount = $_POST['dueFineAmount'];
$dueFineAmountParam = 'dueFine';

$issuePoint = $_POST['issuePoint'];
$issuePointParam = 'issuePoint';

$returnPoint = $_POST['returnPoint'];
$returnPointParam = 'returnPoint';

$duePoint = $_POST['duePoint'];
$duePointParam = 'duePoint';

$ratingPoint = $_POST['ratingPoint'];
$ratingPointParam = 'ratingPoint';

// teacher
$teacherIssuePeriod = $_POST['teacherIssuePeriod'];
$teacherIssuePeriodParam = 'teacherIssuePeriod';

$teacherReservePeriod = $_POST['teacherReservePeriod'];
$teacherReservePeriodParam = 'teacherReservePeriod';

$teacherIssueLimit = $_POST['teacherIssueLimit'];
$teacherIssueLimitParam = 'teacherIssueNum';

$teacherReserveLimit = $_POST['teacherReserveLimit'];
$teacherReserveLimitParam = 'teacherReserveNum';

$teacherDueFineAmount = $_POST['teacherDueFineAmount'];
$teacherDueFineAmountParam = 'teacherDueFine';

$teacherIssuePoint = $_POST['teacherIssuePoint'];
$teacherIssuePointParam = 'teacherIssuePoint';

$teacherReturnPoint = $_POST['teacherReturnPoint'];
$teacherReturnPointParam = 'teacherReturnPoint';

$teacherDuePoint = $_POST['teacherDuePoint'];
$teacherDuePointParam = 'teacherDuePoint';

$teacherRatingPoint = $_POST['teacherRatingPoint'];
$teacherRatingPointParam = 'teacherRatingPoint';

try {
	$sql = "UPDATE `setting` SET `value` = :val WHERE `setting`.`parameter` = :parameter";
	$stmt = $conn->prepare($sql);

	// student
	$stmt->bindParam(':val', $dueFineAmount);
	$stmt->bindParam(':parameter', $dueFineAmountParam);
	$stmt->execute();

	$stmt->bindParam(':val', $duePoint);
	$stmt->bindParam(':parameter', $duePointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $issueLimit);
	$stmt->bindParam(':parameter', $issueLimitParam);
	$stmt->execute();

	$stmt->bindParam(':val', $issuePeriod);
	$stmt->bindParam(':parameter', $issuePeriodParam);
	$stmt->execute();

	$stmt->bindParam(':val', $issuePoint);
	$stmt->bindParam(':parameter', $issuePointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $ratingPoint);
	$stmt->bindParam(':parameter', $ratingPointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $reserveLimit);
	$stmt->bindParam(':parameter', $reserveLimitParam);
	$stmt->execute();

	$stmt->bindParam(':val', $reservePeriod);
	$stmt->bindParam(':parameter', $reservePeriodParam);
	$stmt->execute();

	$stmt->bindParam(':val', $returnPoint);
	$stmt->bindParam(':parameter', $returnPointParam);
	$stmt->execute();

	// teacher
	$stmt->bindParam(':val', $teacherIssuePeriod);
	$stmt->bindParam(':parameter', $teacherIssuePeriodParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherReservePeriod);
	$stmt->bindParam(':parameter', $teacherReservePeriodParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherIssueLimit);
	$stmt->bindParam(':parameter', $teacherIssueLimitParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherReserveLimit);
	$stmt->bindParam(':parameter', $teacherReserveLimitParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherDueFineAmount);
	$stmt->bindParam(':parameter', $teacherDueFineAmountParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherIssuePoint);
	$stmt->bindParam(':parameter', $teacherIssuePointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherReturnPoint);
	$stmt->bindParam(':parameter', $teacherReturnPointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherDuePoint);
	$stmt->bindParam(':parameter', $teacherDuePointParam);
	$stmt->execute();

	$stmt->bindParam(':val', $teacherRatingPoint);
	$stmt->bindParam(':parameter', $teacherRatingPointParam);
	$stmt->execute();

	exit('success');
} catch (PDOException $e) {
	exit($e);
}

$conn = null;
