<?php
include("../../session.php");
include("../../db.php");

if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = '';

// To get bookID, stud_id and oldID
$query = "SELECT * FROM copies Where `copies`.`copyID` = :copyID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':copyID', $copyID);
$stmt->execute();
$row = $stmt->fetchObject();
$oldID = $row->oldID;
$st_ID = $row->stud_ID;
$bookID = $row->bookID;
$adminID = $_SESSION['adminID'];

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `copies` SET `stud_ID` = NULL, `status` = '' WHERE `copies`.`copyID` = :copyID";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':copyID', $copyID);
	$stmt1->execute();
	echo "Copies table updated";

	$sql2 = "UPDATE `issued` SET `returnTime` = UNIX_TIMESTAMP() WHERE `issued`.`copyID` = :copyID AND `issued`.`returnTime` IS NULL";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindParam(':copyID', $copyID);
	$stmt2->execute();
	echo "\nIssued table updated";

	$sql3 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, :st_ID, 'return', UNIX_TIMESTAMP(), :bookID, :oldID)";
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
