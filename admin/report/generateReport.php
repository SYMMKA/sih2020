<?php
//include connection file 
include("../session.php");
include("../db.php");

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
$studentID = $_POST['studentID'];
$adminID = $_POST['adminID'];

//studentIDquery
if ($studentID == '')
	$studentIDquery = "";
elseif ($studentID == 'show')
	$studentIDquery = "(`studentID` is NOT NULL)";
else
	$studentIDquery = "(`studentID` = :studentID)";

//adminIDquery
if ($adminID == '')
	$adminIDquery = "";
else
	$adminIDquery = "(`adminID` = :adminID)";

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
if ($bookID != '')
	$bookIDquery = "(`bookID` = :bookID)";
else
	$bookIDquery = "";

$query = "SELECT * FROM `history` WHERE " . $actionquery;
if ($adminIDquery != '')
	$query .= " AND " . $adminIDquery;
if ($studentIDquery != '')
	$query .= " AND " . $studentIDquery;
if ($bookIDquery != '')
	$query .= " AND " . $bookIDquery;

$stmt = $conn->prepare($query);
if ($bookID != '')
	$stmt->bindParam(':bookID', $bookID);
if ($adminID != '')
	$stmt->bindParam(':adminID', $adminID);
if (($studentID != '') && ($studentID != 'show'))
	$stmt->bindParam(':studentID', $studentID);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	$data["id"] = $row->id;
	$data["copyID"] = $row->copyID;
	$data["adminID"] = $row->adminID;
	$data["studentID"] = $row->studentID;
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
