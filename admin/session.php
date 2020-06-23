<?php
include("db.php");
session_start();

if(isset($_SESSION['adminID'])) {
	$adminID = $_SESSION['adminID'];

	$sql = "SELECT * FROM adminlogin WHERE `adminlogin`.`userID` = '$adminID'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}

if(!isset($_SESSION['adminID']) || !$stmt->rowCount()){
	header("location:login.php");
}

$conn = null;