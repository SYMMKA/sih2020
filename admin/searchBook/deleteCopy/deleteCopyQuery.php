<?php
include("../../db.php");

if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

// To get bookID
$query1 = "SELECT * FROM copies Where `copies`.`copyID` = '$copyID'";
$stmt1 = $conn->prepare($query1);
$stmt1->execute();
$row1 = $stmt1->fetchObject();
$bookID = $row1->bookID;

// To get quantity
$query2 = "SELECT * FROM main Where `main`.`bookID` = '$bookID'";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetchObject();
$quantity = $row2->quantity - 1;  //reduce quantity by 1

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "DELETE FROM `copies` WHERE `copies`.`copyID` = '$copyID'";
	$conn->exec($sql1);
	echo "Copies table updated";

	$sql2 = "UPDATE `main` SET `quantity` = '$quantity' WHERE `main`.`bookID` = '$bookID'";
	$conn->exec($sql2);
	echo "\nIssued table updated";

	$sql3 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `bookID`, `oldID`) VALUES ('$copyID', 'admin', '-', 'delete', UNIX_TIMESTAMP(), '$bookID', 'oldID')";
	$conn->exec($sql3);
	echo "\nAdded to history table";

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
