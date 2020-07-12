<?php
//include connection file 
include("../session.php");
include("../db.php");

if ($_POST['semester'] && $_POST['branch']) {
	$semester = $_POST['semester'];
	$branch = $_POST['branch'];
} else {
	$semester = '';
	$branch = '';
}

$query1 = "SELECT `sem_branchID` FROM `sem_branch` WHERE `sem`= :semester AND `branch` = :branch";
$stmt1 = $conn->prepare($query1);
$stmt1->bindParam(':semester', $semester);
$stmt1->bindParam(':branch', $branch);
$stmt1->execute();
$row1 = $stmt1->fetchObject();
$sem_branchID = $row1->sem_branchID;

$query2 = "SELECT `bookID` FROM `syllabus` WHERE `sem_branchID` = :sem_branchID";
$stmt2 = $conn->prepare($query2);
$stmt2->bindParam(':sem_branchID', $sem_branchID);
$stmt2->execute();

$query3 = "SELECT * FROM `main` WHERE `bookID`=:bookID";
$stmt3 = $conn->prepare($query3);

$query4 = "SELECT AVG(star) AS 'STAR' FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
$stmt4 = $conn->prepare($query4);

while ($row2 = $stmt2->fetchObject()) {
	$bookID = $row2->bookID;
	$stmt3->bindParam(':bookID', $bookID);
	$stmt3->execute();
	$row3 = $stmt3->fetchObject();

	$data1["bookID"] = $row3->bookID;
	$data1["title"] = $row3->title;
	$data1["author"] = $row3->author;
	$data1["quantity"] = $row3->quantity;
	$data1["Category1"] = $row3->Category1;
	$data1["Category2"] = $row3->Category2;
	$data1["Category3"] = $row3->Category3;
	$data1["Category3"] = $row3->Category3;
	$data1["Category4"] = $row3->Category4;
	$data1["publisher"] = $row3->publisher;
	$data1["pages"] = $row3->pages;
	$data1["price"] = $row3->price;
	$data1["imgLink"] = $row3->imgLink;
	$data1["date_of_publication"] = $row3->date_of_publication;
	$data1["isbn"] = $row3->isbn;
	$data1["sem_branchID"] = $sem_branchID;

	$stmt4->bindParam(':bookID', $bookID);
	$stmt4->execute();
	$row4 = $stmt4->fetchObject();
	$data1["star"] = $row4->STAR;

	$return_arr[] = $data1;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
