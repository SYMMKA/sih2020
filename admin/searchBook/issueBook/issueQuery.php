<?php
include("../../session.php");
include("../../db.php");

if ($_POST['bookID']) {
	$bookID = $_POST['bookID'];
} else
	$bookID = '';
if ($_POST['stud_ID']) {
	$st_ID = $_POST['stud_ID'];
} else
	$st_ID = '';
if ($_POST['oldID'])
	$oldID = $_POST['oldID'];
else
	$oldID = '';
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = '';

$timePeriod = 20; //reserve time period
$adminID = $_SESSION['adminID'];

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `copies` SET `stud_ID` = :st_ID, `status` = 'issued', `time` = UNIX_TIMESTAMP(), `returntime` = UNIX_TIMESTAMP()+$timePeriod WHERE `copies`.`copyID` = :copyID AND (`copies`.`status` = '' OR (`copies`.`status` = 'reserved' AND (`copies`.`stud_ID` = :st_ID OR `copies`.`returnTime` < UNIX_TIMESTAMP())))";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':st_ID', $st_ID);
	$stmt1->bindParam(':copyID', $copyID);
	$stmt1->execute();
	echo "Copies table updated";

	$sql2 = "INSERT INTO `issued` (`bookID`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`) VALUES (:bookID, :oldID, :copyID, :st_ID, UNIX_TIMESTAMP(), NULL, NULL)";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindParam(':bookID', $bookID);
	$stmt2->bindParam(':oldID', $oldID);
	$stmt2->bindParam(':copyID', $copyID);
	$stmt2->bindParam(':st_ID', $st_ID);
	$stmt2->execute();
	echo "\nAdded to issued table";

	$sql3 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, :st_ID, 'issue', UNIX_TIMESTAMP(), :bookID, :oldID)";
	$stmt3 = $conn->prepare($sql3);
	$stmt3->bindParam(':copyID', $copyID);
	$stmt3->bindParam(':adminID', $adminID);
	$stmt3->bindParam(':st_ID', $st_ID);
	$stmt3->bindParam(':bookID', $bookID);
	$stmt3->bindParam(':oldID', $oldID);
	$stmt3->execute();
	echo "\nAdded to history table";

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
