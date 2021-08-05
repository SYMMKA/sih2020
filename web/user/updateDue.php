<?php
//include connection file 
include("../database.php");

if ( @$_POST['stud_ID'] && @$_POST['copyID'])
{
$copyID =$_POST['copyID'];
$stud_ID =$_POST['stud_ID'];

$query = "UPDATE `issued` SET `due`=0 WHERE `stud_ID`='$stud_ID' and `copyID`='$copyID'  ";

$stmt = $conn->prepare($query);
$stmt->execute();
echo "sucess";
}

$conn = null;
exit;
