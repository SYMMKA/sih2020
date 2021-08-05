<?php
include("../../../session.php");
include("../../../database.php");

$copyIDs = $_POST['copyIDs'];
$copyIDs = json_decode($copyIDs, true);
$bookID = $_POST['bookID'];

foreach($copyIDs as $copyID) {
	$return_arr[$bookID][] = $copyID;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
