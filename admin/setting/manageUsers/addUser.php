<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$userID = $_POST['userID'];
$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userMobile = $_POST['userMobile'];
$type = $_POST['type'];

$query = "INSERT INTO `students` (`stud_ID`, `name`, `email`, `mobile`, `type`) VALUES (:stud_ID, :stuName, :email, :mobile, :userType)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':stud_ID', $userID);
$stmt->bindParam(':stuName', $userName);
$stmt->bindParam(':email', $userEmail);
$stmt->bindParam(':mobile', $userMobile);
$stmt->bindParam(':userType', $type);
if($stmt->execute())
	echo $type." added successfully";
else
	echo "Duplicate entry";

$conn = null;