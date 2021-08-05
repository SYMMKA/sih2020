<?php
include("../database.php");

if (isset($_POST['title']))
	$title = $_POST['title'];

if (isset($_POST['author']))
	$author =  $_POST['author'];

if (isset($_POST['isbn']))
	$isbn = $_POST['isbn'];

if (isset($_POST['stud_ID']))
	$stud_ID =  $_POST['stud_ID'];

$sql = "INSERT INTO `request_list` (`title`, `author`, `isbn`, `userID`) VALUES (:title, :author, :isbn, :userID)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':author', $author);
$stmt->bindParam(':isbn', $isbn);
$stmt->bindParam(':userID', $stud_ID);
$stmt->execute();

$count = $stmt->rowCount();
if($count>0)
	echo "true";
else
	echo "false";