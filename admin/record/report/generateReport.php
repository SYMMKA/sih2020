<?php
//include connection file 
include("../../session.php");
include("../../db.php");

if ($_POST['add'] == 1)
	$action['add'] = $_POST['add'];
if ($_POST['issue'] == 1)
	$action['issue'] = $_POST['issue'];
if ($_POST['bookreturn'] == 1)
	$action['return'] = $_POST['bookreturn'];
if ($_POST['bookdelete'] == 1)
	$action['delete'] = $_POST['bookdelete'];
if ($_POST['update'] == 1)
	$action['update'] = $_POST['update'];
$bookID = $_POST['bookID'];
$bookID = json_decode($bookID, true);
$userID = $_POST['userID'];
$userID = json_decode($userID, true);
$adminID = $_POST['adminID'];
$adminID = json_decode($adminID, true);

//studentIDquery
if ($userID == '')
	$studentIDquery = "";
elseif ($userID == 'show')
	$studentIDquery = "(`studentID` is NOT NULL)";
else {
	$studentIDlength = count($userID);
	$i = 1;
	$studentIDquery = "(";
	foreach ($userID as $student) {
		$studentIDquery .= "`studentID` = :studentID" . $i;
		if ($i < $studentIDlength)
			$studentIDquery .= " OR ";
		$i++;
	}
	$studentIDquery .= ")";
}

//adminIDquery
if ($adminID != '') {
	$adminIDlength = count($adminID);
	$i = 1;
	$adminIDquery = "(";
	foreach ($adminID as $admin) {
		$adminIDquery .= "`adminID` = :adminID" . $i;
		if ($i < $adminIDlength)
			$adminIDquery .= " OR ";
		$i++;
	}
	$adminIDquery .= ")";
} else
	$adminIDquery = "";

// actionquery
$actionlength = count($action);
$i = 1;
$actionquery = "(";
foreach ($action as $k => $v) {
	$actionquery .= "`action` = '" . $k . "'";
	if ($i < $actionlength)
		$actionquery .= " OR ";
	$i++;
}
$actionquery .= ")";

//bookID
if ($bookID != '') {
	$bookIDlength = count($bookID);
	$i = 1;
	$bookIDquery = "(";
	foreach ($bookID as $book) {
		$bookIDquery .= "`bookID` = :bookID" . $i;
		if ($i < $bookIDlength)
			$bookIDquery .= " OR ";
		$i++;
	}
	$bookIDquery .= ")";
} else
	$bookIDquery = "";

$query = "SELECT * FROM `history` WHERE " . $actionquery;
if ($adminIDquery != '')
	$query .= " AND " . $adminIDquery;
if ($studentIDquery != '')
	$query .= " AND " . $studentIDquery;
if ($bookIDquery != '')
	$query .= " AND " . $bookIDquery;

$stmt = $conn->prepare($query);

if ($bookID != '') {
	for ($i = 1; $i <= $bookIDlength; $i++)
		$stmt->bindParam(':bookID' . $i, $bookID[$i - 1]);
}
if ($adminID != '') {
	for ($i = 1; $i <= $adminIDlength; $i++)
		$stmt->bindParam(':adminID' . $i, $adminID[$i - 1]);
}
if (($userID != '') && ($userID != 'show')) {
	for ($i = 1; $i <= $studentIDlength; $i++)
		$stmt->bindParam(':studentID' . $i, $userID[$i - 1]);
}
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	$data["id"] = $row->id;
	$data["copyID"] = $row->copyID;
	$data["adminID"] = $row->adminID;
	$data["userID"] = $row->studentID;
	$data["action"] = $row->action;
	$data["time"] = date('d/m/Y H:i', $row->time);
	$data["bookID"] = $row->bookID;
	$data["oldID"] = $row->oldID;
	$result[] = $data;
}
// Encoding array in JSON format
if (!isset($result))
	echo FALSE;
else
	echo json_encode($result);

$conn = null;
exit;
