<?php
//include connection file 
include("../../session.php");
include("../../database.php");
if ($_POST['message'])
    $message = $_POST['message'];
else
    $message = '';

$adminID = $_SESSION['adminID'];
$query1 = "SELECT `fname` FROM `adminlogin` WHERE `userID`=:adminID";
$stmt1 = $conn->prepare($query1);
$stmt1->bindParam(':adminID', $adminID);
$stmt1->execute();
$fname = $stmt1->fetchObject()->fname;

$query2 = "INSERT INTO `chats` (`stud_ID`,`name`,`message`,`time`) VALUES (:adminID, :fname, :mess, UNIX_TIMESTAMP())";
$stmt2 = $conn->prepare($query2);
$stmt2->bindParam(':adminID', $adminID);
$stmt2->bindParam(':fname', $fname);
$stmt2->bindParam(':mess', $message);
$stmt2->execute();
echo $message;

$conn = null;
exit;
