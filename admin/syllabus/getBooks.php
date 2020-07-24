<?php
//include connection file 
include("../session.php");
include("../db.php");

$sem_branchID = $_POST['sem_branchID'];

$query2 = "SELECT `bookID` FROM `syllabus` WHERE `sem_branchID` = :sem_branchID";
$stmt2 = $conn->prepare($query2);

$query3 = "SELECT * FROM `main` WHERE `bookID`=:bookID";
$stmt3 = $conn->prepare($query3);

$query4 = "SELECT AVG(star) AS 'STAR' FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
$stmt4 = $conn->prepare($query4);

$stmt2->bindParam(':sem_branchID', $sem_branchID);
$stmt2->execute();
while ($row2 = $stmt2->fetchObject()) {
	$bookID = $row2->bookID;
	$stmt3->bindParam(':bookID', $bookID);
	$stmt3->execute();
	$row3 = $stmt3->fetchObject();

	$data["bookID"] = $row3->bookID;
	$data["title"] = $row3->title;
	$data["author"] = $row3->author;
	$data["quantity"] = $row3->quantity;
	$data["Category1"] = $row3->Category1;
	$data["Category2"] = $row3->Category2;
	$data["Category3"] = $row3->Category3;
	$data["Category3"] = $row3->Category3;
	$data["Category4"] = $row3->Category4;
	$data["publisher"] = $row3->publisher;
	$data["pages"] = $row3->pages;
	$data["imgLink"] = $row3->imgLink;
	$data["date_of_publication"] = $row3->date_of_publication;
	$data["isbn"] = $row3->isbn;

	$stmt4->bindParam(':bookID', $bookID);
	$stmt4->execute();
	$row4 = $stmt4->fetchObject();
	$data["star"] = $row4->STAR;

	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
