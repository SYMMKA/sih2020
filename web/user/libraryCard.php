


<?php

include("db.php");

if ($_GET['stud_ID']) {

	$stud_ID = $_GET['stud_ID'];
	$sql1 = "SELECT * FROM issued WHERE `issued`.`stud_ID` = :stud_ID ORDER BY time DESC";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':stud_ID', $stud_ID);
	$stmt1->execute();

	$sql2 = "SELECT * FROM main WHERE `main`.`bookID` = :bookID";
	$stmt2 = $conn->prepare($sql2);

	while ($row1 = $stmt1->fetchObject()) {
		$data["bookID"] = $row1->bookID;
		$data["copyID"] = $row1->copyID;
		$data["oldID"] = $row1->oldID;
		$data["stud_ID"] = $row1->stud_ID;
		$data["time"] = date("d-m-Y H:i:s", $row1->time);

		if ($row1->returnTime != null)
			$data["returnTime"] = date("d-m-Y H:i:s", $row1->returnTime);
		else
			$data["returnTime"] = "Not returned";

		if ($row1->star != null)
		$data["star"] = $row1->star;
		else
		$data["star"] = "5";

		if ( $row1->due != null)
		$data["due"] = $row1->due;
		else
		$data["due"] = "";

		
		if ($row1->fine != null)
		$data["fine"] = $row1->fine;
		else
		$data["fine"] = "";

		$data["currentTime"] = time();
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

		$return_arr[] = $data;
	}

	// Encoding array in JSON format
	if (isset($return_arr)) {
		echo json_encode($return_arr);
	} else {

		$data["star"] = "";
		$data["fine"] = "";
		$data["due"] = "";
		$data["currentTime"] = "";
		$data["title"] = "";
		$data["imgLink"] = "";
		$data["isbn"] = "";
		$data["author"] = "";
		$data["quantity"] = "";
		$data["Category1"] = "";
		$data["Category2"] = "";
		$data["Category3"] = "";
		$data["Category4"] = "";
		$data["publisher"] = "";
		$data["pages"] = "";
		$data["quantity"] = "";
		$data["date_of_publication"] = "";
		$return_arr[] = $data;
		echo json_encode($return_arr);
	}


	$conn = null;
	exit;
}






?>