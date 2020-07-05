<?php
include("../../session.php");
include("../../db.php");

if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = '';

// To get bookID
$query1 = "SELECT * FROM copies Where `copies`.`copyID` = :copyID";
$stmtt1 = $conn->prepare($query1);
$stmtt1->bindParam(':copyID', $copyID);
$stmtt1->execute();
$row1 = $stmtt1->fetchObject();
$bookID = $row1->bookID;
$oldID = $row1->oldID;

// To get quantity
$query2 = "SELECT * FROM main Where `main`.`bookID` = :bookID";
$stmtt2 = $conn->prepare($query2);
$stmtt2->bindParam(':bookID', $bookID);
$stmtt2->execute();
$row2 = $stmtt2->fetchObject();
$quantity = $row2->quantity - 1;  //reduce quantity by 1

$adminID = $_SESSION['adminID'];

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "DELETE FROM `copies` WHERE `copies`.`copyID` = :copyID";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':copyID', $copyID);
	$stmt1->execute();
	echo "Copies table updated";

	$sql2 = "UPDATE `main` SET `quantity` = :quantity WHERE `main`.`bookID` = :bookID";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindParam(':quantity', $quantity);
	$stmt2->bindParam(':bookID', $bookID);
	$stmt2->execute();
	echo "\nIssued table updated";

	$sql3 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, NULL, 'delete', UNIX_TIMESTAMP(), :bookID, :oldID)";
	$stmt3 = $conn->prepare($sql3);
	$stmt3->bindParam(':copyID', $copyID);
	$stmt3->bindParam(':adminID', $adminID);
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
