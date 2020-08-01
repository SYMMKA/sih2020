


<?php

include("db.php");

if ($_GET['stud_ID'])
 {


    $reserveNumQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'reservePeriod'";
    $reserveNumstmt = $conn->prepare($reserveNumQuery);
    $reserveNumstmt->execute();
    $reserve_time= ($reserveNumstmt->fetchObject()->value)*60;

	$stud_ID = $_GET['stud_ID'];
	$sql1 = "SELECT * FROM `copies` where  stud_ID=$stud_ID and ((status='reserved' and UNIX_TIMESTAMP()-returnTime<$reserve_time))";
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
        $data["time"] = date("H:i", $row1->time);
        $data["returnTime"] = date("H:i", $row1->returnTime);

		$bookID = $row1->bookID;
		$stmt2->bindParam(':bookID', $bookID);
		$stmt2->execute();
		$row2 = $stmt2->fetchObject();
		$data["title"] = $row2->title;
		$data["author"] = $row2->author;
		$data["publisher"] = $row2->publisher;

		$return_arr[] = $data;
    }

	// Encoding array in JSON format
	if (isset($return_arr)) {
		echo json_encode($return_arr);
	} else {
		echo "false";
	}

}


?>