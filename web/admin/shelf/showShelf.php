<?php
include("../../session.php");
include("../../database.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

	$search = $_POST['search'];

	if (isset($_POST['qr'])) {
		$sql = "SELECT * FROM shelf Where shelfID = :search";
	} else if (isset($_POST['main'])) {
		$search = "%$search%";
		$sql = "SELECT * FROM shelf Where shelfID LIKE :search";
	} else {
		exit('error');
	}

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':search', $search);
	$stmt->execute();

	while ($row = $stmt->fetchObject()) {
		$data["shelfID"] = $row->shelfID;
		$i = $data["shelfID"];

		$sql1 = "SELECT COUNT(*) AS 'QUANTITY' FROM `copies` WHERE `copies`.`shelfID` = :shelfID";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->bindParam(':shelfID', $i);
		$stmt1->execute();
		$row1 = $stmt1->fetchObject();
		$data["count"] = $row1->QUANTITY;

		$return_arr[] = $data;
	}

	if (!isset($return_arr))
		echo FALSE;
	else
		echo json_encode($return_arr);
	exit;
} catch (PDOException $e) {
	exit($e);
}

$conn = null;