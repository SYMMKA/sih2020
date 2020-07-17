<?php
//include connection file 
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

try {
	$sql = "UPDATE `setting` SET `value` = :val WHERE `setting`.`parameter` = :parameter";
	$stmt = $conn->prepare($sql);

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

	exit('success');
} catch (PDOException $e) {
	exit($e);
}
