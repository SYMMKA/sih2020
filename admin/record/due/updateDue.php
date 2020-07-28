<?php
//include connection file 
include("../../session.php");
include("../../db.php");

if ($_POST['id'])
    $id = $_POST['id'];
else
    $id = '';
$query = "UPDATE `issued` SET `due`=0 WHERE `id`='$id'";
//echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();

$conn = null;
exit;
