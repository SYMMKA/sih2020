<?php
include("../../db.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if ($_POST['isbn']) {
	$isbn = $_POST['isbn'];
} else
	$isbn = NULL;
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
//Dont add `id` column
$sql = "UPDATE `copies` SET `stud_ID` = '$st_ID', `status` = 'issued', `time` = UNIX_TIMESTAMP(), `returntime` = UNIX_TIMESTAMP()+$timePeriod WHERE `copies`.`copyID` = '$copyID' AND (`copies`.`status` = '' OR (`copies`.`status` = 'reserved' AND (`copies`.`stud_ID` = '$st_ID' OR `copies`.`returnTime` < UNIX_TIMESTAMP())))";
if (($conn->query($sql) === TRUE) && ($conn->affected_rows)) {
	$sql1 = "INSERT INTO `issued` (`isbn`, `oldID`, `copyID`, `stud_ID`, `time`, `returnTime`, `star`) VALUES ('$isbn', '$oldID', '$copyID', '$st_ID', UNIX_TIMESTAMP(), NULL, NULL)";
	if (($conn->query($sql1) === TRUE) && ($conn->affected_rows)) {
		$sql2 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('$copyID', 'user', '$st_ID', 'issue', UNIX_TIMESTAMP(), '$isbn', '$oldID')";
		if (($conn->query($sql2) === TRUE) && ($conn->affected_rows)) {
		} else {
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}
	} else {
		echo "Error: " . $sql1 . "<br>" . $conn->error;
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header( "Location: ../searchBooks.php" );
exit;
