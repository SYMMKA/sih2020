<?php


include("db.php");

if($_GET['shelfID'])
{

$shelfID = $_GET['shelfID'];
$sql1 = "SELECT * FROM copies WHERE `copies`.`shelfID` = :shelfID";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':shelfID', $shelfID);
$stmt1->execute();

$sql2 = "SELECT * FROM main WHERE `main`.`bookID` = :bookID";
$stmt2 = $conn->prepare($sql2);
$reserve_time=30;
$sql3 = "SELECT AVG(star) AS `STAR` FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
$stmt3 = $conn->prepare($sql3);

while ($row1 = $stmt1->fetchObject()) {
    $data["bookID"] = $row1->bookID;
	$data["copyno"] = $row1->copyNO;
	$data["copyID"] = $row1->copyID;
	$data["oldID"] = $row1->oldID;
	$data["stud_ID"] = $row1->stud_ID;

	
	$data["time"] = $row1->time;
	$data["returnTime"] = $row1->returnTime;
	$data["currentTime"] = time();

	if($row1->status=='' || ($row1->status=='reserved' and time()-$row1->returnTime>$reserve_time))
	{
		$data["status"] = "";
	}
	else
	{
		$data["status"] = $row1->status;
	}		

	$bookID = $row1->bookID;

	$stmt2->bindParam(':bookID', $bookID);
	$stmt2->execute();
	$row2 = $stmt2->fetchObject();
	$data["title"] = $row2->title;
	$data["imgLink"] = $row2->imgLink;
    $data["isbn"] = $row2->isbn;
    $data["author"] = $row2->author;
	$data["quantity"] = $row2->quantity;
    $data["Category1"] = $row2->Category1;
    $data["Category2"] = $row2->Category2;
	$data["Category3"] = $row2->Category3;
    $data["Category4"] = $row2->Category4;
    $data["publisher"] = $row2->publisher;
    $data["pages"] = $row2->pages;
    $data["quantity"] = $row2->quantity;
	$data["date_of_publication"] = $row2->date_of_publication;

	$stmt3->bindParam(':bookID', $row1->bookID);
    $stmt3->execute();
	$row3 = $stmt3->fetchObject();
	$data["star"] = $row3->STAR;


	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
}

?>