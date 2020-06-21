<?php
include("../../db.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

// To get isbn, stud_id and oldID
$query = "SELECT * FROM copies Where `copies`.`copyID` = '$copyID'";
$returnD = mysqli_query($conn, $query);

while ($result = mysqli_fetch_array($returnD)) {
	$oldID = $result["oldID"];
	$st_ID = $result["stud_ID"];
	$isbn = $result["isbn"];
}

//Dont add `id` column
$sql = "UPDATE `copies` SET `stud_ID` = '', `status` = '' WHERE `copies`.`copyID` = '$copyID'";
if ($conn->query($sql) === TRUE) {
	$sql1 = "UPDATE `issued` SET `returnTime` = UNIX_TIMESTAMP() WHERE `issued`.`copyID` = '$copyID' AND `issued`.`returnTime` IS NULL";
	if ($conn->query($sql1) === TRUE) {
		$sql2 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('$copyID', 'user', '$st_ID', 'return', UNIX_TIMESTAMP(), '$isbn', '$oldID')";
		if ($conn->query($sql2) === TRUE) {
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
