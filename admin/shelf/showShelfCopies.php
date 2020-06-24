<?php
include("../session.php");
include("../db.php");

$shelfID = $_POST['shelfID'];
$sql1 = "SELECT * FROM copies WHERE `copies`.`shelfID` = :shelfID";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':shelfID', $shelfID);
$stmt1->execute();

$sql2 = "SELECT `title`, `imgLink`, `isbn` FROM main WHERE `main`.`bookID` = :bookID";
$stmt2 = $conn->prepare($sql2);

while ($row1 = $stmt1->fetchObject()) {
	$data["copyno"] = $row1->copyNO;
	$data["copyID"] = $row1->copyID;
	$data["oldID"] = $row1->oldID;
	$data["stud_ID"] = $row1->stud_ID;
	$data["status"] = $row1->status;
	$data["time"] = $row1->time;
	$data["returnTime"] = $row1->returnTime;
	$data["currentTime"] = time();
	$bookID = $row1->bookID;

	$stmt2->bindParam(':bookID', $bookID);
	$stmt2->execute();
	$row2 = $stmt2->fetchObject();
	$data["title"] = $row2->title;
	$data["imgLink"] = $row2->imgLink;
	$data["isbn"] = $row2->isbn;

	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
