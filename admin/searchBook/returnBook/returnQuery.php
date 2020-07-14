<?php
include("../../session.php");
include("../../db.php");

$copyID = $_POST['copyID'];
$fine = $_POST['fine'];
$points = (int)$_POST['points'];
$due = $_POST['due'];
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

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'returnAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if($access > $adminLevel){
	echo "\nAccess not granted";
	$conn = null;
	exit;
}

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$sql1 = "UPDATE `copies` SET `stud_ID` = NULL, `status` = '', `time` = NULL, `returnTime` = NULL WHERE `copies`.`copyID` = :copyID";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':copyID', $copyID);
	$stmt1->execute();
	echo "Copies table updated";

	$sql2 = "UPDATE `issued` SET `returnTime` = UNIX_TIMESTAMP(), `fine` = :fine, `due` = :due WHERE `issued`.`copyID` = :copyID AND `issued`.`returnTime` IS NULL";
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindParam(':copyID', $copyID);
	$stmt2->bindParam(':fine', $fine);
	$stmt2->bindParam(':due', $due);
	$stmt2->execute();
	echo "\nIssued table updated";

	$sql3_1 = "SELECT `points` FROM `students` WHERE `students`.`stud_ID` = :st_ID";
	$stmt3_1 = $conn->prepare($sql3_1);
	$stmt3_1->bindParam(':st_ID', $st_ID);
	$stmt3_1->execute();
	$orgPoint = $stmt3_1->fetchObject()->points;
	$point = $orgPoint + $points;
	echo $point;

	$sql3_2 = "UPDATE `students` SET `points` = :points WHERE `students`.`stud_ID` = :st_ID";
	$stmt3_2 = $conn->prepare($sql3_2);
	$stmt3_2->bindParam(':points', $point);
	$stmt3_2->bindParam(':st_ID', $st_ID);
	$stmt3_2->execute();
	echo "\nStudents table updated";

	$sql4 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, :st_ID, 'return', UNIX_TIMESTAMP(), :bookID, :oldID)";
	$stmt4 = $conn->prepare($sql4);
	$stmt4->bindParam(':copyID', $copyID);
	$stmt4->bindParam(':adminID', $adminID);
	$stmt4->bindParam(':st_ID', $st_ID);
	$stmt4->bindParam(':bookID', $bookID);
	$stmt4->bindParam(':oldID', $oldID);
	$stmt4->execute();
	echo "\nAdded to history table";

	$conn->commit();
} catch (PDOException $e) {
	$conn->rollBack();
	echo "Failed " . $e->getMessage();
}

$conn = null;
exit;
