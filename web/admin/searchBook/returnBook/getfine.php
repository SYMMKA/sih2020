<?php
include("../../../session.php");
include("../../../database.php");

$copyID = $_POST['copyID'];

$query = "SELECT returnTime,price FROM `copies` WHERE `copies`.`copyID` = :copyID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':copyID', $copyID);
$stmt->execute();

$result = $stmt->fetchObject();
$returnTime = $result->returnTime;
$price = $result->price;
$returnDay = strtotime("today", $returnTime);
$today = time();
$days = ($today - $returnDay) / 86400;
$days = floor($days);
if ($days < 0)
	$days = 0;

$studIDquery = "SELECT * FROM copies Where `copies`.`copyID` = :copyID";
$studIDstmt = $conn->prepare($studIDquery);
$studIDstmt->bindParam(':copyID', $copyID);
$studIDstmt->execute();
$st_ID = $studIDstmt->fetchObject()->stud_ID;

// check student or teacher
$typeQuery = "SELECT `type` FROM `students` WHERE `stud_ID` = :st_ID";
$typestmt = $conn->prepare($typeQuery);
$typestmt->bindParam(':st_ID', $st_ID);
$typestmt->execute();
$type = $typestmt->fetchObject()->type;

// fine for late submission
if ($type == "student")
	$dueFineQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'dueFine'";
else
	$dueFineQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherDueFine'";
$dueFinestmt = $conn->prepare($dueFineQuery);
$dueFinestmt->execute();
$dueFinePerDay = $dueFinestmt->fetchObject()->value;
$dueFine = $dueFinePerDay * $days;

// -ve points for late submission
if ($type == "student")
	$duePointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'duePoint'";
else
	$duePointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherDuePoint'";
$duePointstmt = $conn->prepare($duePointQuery);
$duePointstmt->execute();
$duePointPerDay = $duePointstmt->fetchObject()->value;
$point = -$duePointPerDay * $days;

//Get damage and Lost Book Parameters
if ($type == "student") {
	//light
	$damageLq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'LightDamageBookStudent'";

	//medium
	$damageMq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'MediumDamageBookStudent'";

	//heavy
	$damageHq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'HeavyDamageBookStudent'";

	//lost
	$lostq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'LostBookStudent'";
} else {
	//light
	$damageLq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'LightDamageBookTeacher'";

	//medium
	$damageMq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'MediumDamageBookTeacher'";

	//heavy
	$damageHq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'HeavyDamageBookTeacher'";

	//lost
	$lostq = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'LostBookTeacher'";
}
//light
$damageLstmt = $conn->prepare($damageLq);
$damageLstmt->execute();
$lightDamage = $damageLstmt->fetchObject()->value;
//medium
$damageMstmt = $conn->prepare($damageMq);
$damageMstmt->execute();
$mediumDamage = $damageMstmt->fetchObject()->value;
//heavy
$damageHstmt = $conn->prepare($damageHq);
$damageHstmt->execute();
$heavyDamage = $damageHstmt->fetchObject()->value;
//lost
$Loststmt = $conn->prepare($lostq);
$Loststmt->execute();
$lostBook = $Loststmt->fetchObject()->value;

// Due Point Fine Ratio
$duePointFineRatio = $duePointPerDay / $dueFinePerDay;

// +ve points for submission in time
if ($type == "student")
	$returnPointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'returnPoint'";
else
	$returnPointQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherReturnPoint'";
$returnPointstmt = $conn->prepare($returnPointQuery);
$returnPointstmt->execute();
$returnPoint = $returnPointstmt->fetchObject()->value;
if ($days == 0)
	$point = $returnPoint;

$return['days'] = $days;
$return['dueFine'] = $dueFine;
$return['point'] = $point;
$return['duePointFineRatio'] = $duePointFineRatio;
$return['price'] = $price;
$return['lightDamage'] = $lightDamage;
$return['mediumDamage'] = $mediumDamage;
$return['heavyDamage'] = $heavyDamage;
$return['lostBook'] = $lostBook;
echo json_encode($return);

$conn = null;
