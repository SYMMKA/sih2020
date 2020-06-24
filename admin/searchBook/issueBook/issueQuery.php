<?php
include("../../session.php");
include("../../db.php");

if ($_POST['bookID']) {
	$bookID = $_POST['bookID'];
} else
	$bookID = NULL;
if ($_POST['stud_ID']) {
	$st_ID = $_POST['stud_ID'];
} else
	$st_ID = NULL;
if ($_POST['oldID'])
	$oldID = $_POST['oldID'];
else
	$oldID = NULL;
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

$timePeriod = 20; //reserve time period

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `copies` SET `stud_ID` = '$st_ID', `status` = 'issued', `time` = UNIX_TIMESTAMP(), `returntime` = UNIX_TIMESTAMP()+$timePeriod WHERE `copies`.`copyID` = '$copyID' AND (`copies`.`status` = '' OR (`copies`.`status` = 'reserved' AND (`copies`.`stud_ID` = '$st_ID' OR `copies`.`returnTime` < UNIX_TIMESTAMP())))";
	$conn->exec($sql1);
	echo "Copies table updated";

	$sql2 = "INSERT INTO `issued` (`bookID`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`) VALUES ('$bookID', '$oldID', '$copyID', '$st_ID', UNIX_TIMESTAMP(), NULL, NULL)";
	$conn->exec($sql2);
	echo "\nAdded to issued table";

	$sql3 = "INSERT INTO `history` (`copyID`, `user`, `user_ID`, `action`, `time`, `bookID`, `oldID`) VALUES ('$copyID', 'user', '$st_ID', 'issue', UNIX_TIMESTAMP(), '$bookID', '$oldID')";
	$conn->exec($sql3);
	echo "\nAdded to history table";

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
