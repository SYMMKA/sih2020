<?php
//include connection file 
include("../session.php");
include("../db.php");

$title = $_POST['title'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];

$query1 = "SELECT `bookID` FROM `main` WHERE `title` = :title AND `author` = :author AND `isbn` = :isbn";
$stmt1 = $conn->prepare($query1);
$stmt1->bindParam(':title', $title);
$stmt1->bindParam(':author', $author);
$stmt1->bindParam(':isbn', $isbn);
$stmt1->execute();
$bookID = $stmt1->fetchObject()->bookID;
$return['bookID'] = $bookID;

$query2 = "SELECT `copyID` FROM `copies` WHERE `bookID` = :bookID";
$stmt2 = $conn->prepare($query2);
$stmt2->bindParam(':bookID', $bookID);
$stmt2->execute();
while($result = $stmt2->fetchObject()){
	$return['copyID'][] = $result->copyID;
}

echo json_encode($return);
$conn = null;