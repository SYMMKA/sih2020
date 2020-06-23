<?php
include("../../session.php");
include("../../db.php");

if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

// To get bookID, stud_id and oldID
$query = "SELECT * FROM copies Where `copies`.`copyID` = '$copyID'";
$stmt = $conn->prepare($query);
$stmt->execute();
$row = $stmt->fetchObject();
$oldID = $row->oldID;
$st_ID = $row->stud_ID;
$bookID = $row->bookID;

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `copies` SET `stud_ID` = '', `status` = '' WHERE `copies`.`copyID` = '$copyID'";
	$conn->exec($sql1);
	echo "Copies table updated";

	$sql2 = "UPDATE `issued` SET `returnTime` = UNIX_TIMESTAMP() WHERE `issued`.`copyID` = '$copyID' AND `issued`.`returnTime` IS NULL";
	$conn->exec($sql2);
	echo "\nIssued table updated";

	$sql3 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `bookID`, `oldID`) VALUES ('$copyID', 'user', '$st_ID', 'return', UNIX_TIMESTAMP(), '$bookID', '$oldID')";
	$conn->exec($sql3);
	echo "\nAdded to history table";

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
