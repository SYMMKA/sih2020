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

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'issueAccess'";
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

// check if user is yet to pay fine
$dueLeftQuery = "SELECT * FROM `issued` WHERE `issued`.`stud_ID` = :st_ID AND `issued`.`due` = '1'";
$dueLeftstmt = $conn->prepare($dueLeftQuery);
$dueLeftstmt->bindParam(':st_ID', $st_ID);
$dueLeftstmt->execute();
$dueLeft = $dueLeftstmt->rowCount();

if($dueLeft > 0){
	echo "\nClear dues";
	$conn = null;
	exit;
}

// total books issued currently by the user
$totalIssuedQuery = "SELECT * FROM `copies` WHERE `copies`.`stud_ID` = :st_ID";
$totalIssuedstmt = $conn->prepare($totalIssuedQuery);
$totalIssuedstmt->bindParam(':st_ID', $st_ID);
$totalIssuedstmt->execute();
$totalissued = $totalIssuedstmt->rowCount();

// check student or teacher
$typeQuery = "SELECT `type` FROM `students` WHERE `stud_ID` = :st_ID";
$typestmt = $conn->prepare($typeQuery);
$typestmt->bindParam(':st_ID', $st_ID);
$typestmt->execute();
$type = $typestmt->fetchObject()->type;

// check issue limit
if($type == "student")
	$issueLimitQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'issueNum'";
else
	$issueLimitQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherIssueNum'";
$issueLimitstmt = $conn->prepare($issueLimitQuery);
$issueLimitstmt->execute();
$issueLimit = (int)$issueLimitstmt->fetchObject()->value;

if($totalissued >= $issueLimit){
	echo "\nIssue limit crossed by the student";
	$conn = null;
	exit;
}

// issue time period
if($type == "student")
	$timePeriodQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'issuePeriod'";
else
	$timePeriodQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherIssuePeriod'";
$timePeriodstmt = $conn->prepare($timePeriodQuery);
$timePeriodstmt->execute();
$timePeriod = $timePeriodstmt->fetchObject()->value;

$timePeriod *= 86400; //days

// issue point
if($type == "student")
	$pointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'issuePoint'";
else
	$pointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherIssuePoint'";
$pointstmt = $conn->prepare($pointQuery);
$pointstmt->execute();
$addPoint = $pointstmt->fetchObject()->value;

// original points
$sqlPoint = "SELECT `points` FROM `students` WHERE `students`.`stud_ID` = :st_ID";
$stmtPoint = $conn->prepare($sqlPoint);
$stmtPoint->bindParam(':st_ID', $st_ID);
$stmtPoint->execute();
$orgPoint = $stmtPoint->fetchObject()->points;

// new points
$point = $orgPoint + $addPoint;

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

	$sql3 = "UPDATE `students` SET `points` = :points WHERE `students`.`stud_ID` = :st_ID";
	$stmt3 = $conn->prepare($sql3);
	$stmt3->bindParam(':points', $point);
	$stmt3->bindParam(':st_ID', $st_ID);
	$stmt3->execute();
	echo "\nStudents table updated";

	$sql4 = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, :st_ID, 'issue', UNIX_TIMESTAMP(), :bookID, :oldID)";
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
