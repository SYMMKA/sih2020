<?php
include("db.php");
session_start();

if(isset($_SESSION['adminID'])) {
	$adminID = $_SESSION['adminID'];

	$sql = "SELECT * FROM adminlogin WHERE `adminlogin`.`userID` = '$adminID'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}

$domain = $_SERVER['HTTP_HOST'].'/sih2020/web';
$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$relative = '/admin/login.php';
$url = $prefix.$domain.$relative;
if(!isset($_SESSION['adminID']) || !$stmt->rowCount()){
	header("location:".$url);
}

$conn = null;