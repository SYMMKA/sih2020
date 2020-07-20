<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$adminID = $_POST['adminID'];
$adminFirstName = $_POST['adminFirstName'];
$adminLastName = $_POST['adminLastName'];
$adminAccess = $_POST['adminAccess'];

$query = "INSERT INTO `adminlogin` (`userID`, `fname`, `lname`, `clearance`) VALUES (:userID, :fname, :lname, :clearance)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userID', $adminID);
$stmt->bindParam(':fname', $adminFirstName);
$stmt->bindParam(':lname', $adminLastName);
$stmt->bindParam(':clearance', $adminAccess);
if($stmt->execute())
	echo "Admin added successfully";

$conn = null;