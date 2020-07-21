<?php
//include connection file 
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
	if (isset($_POST['search'])) {

		$search = $_POST['search'];

		if (isset($_POST['qr'])) {
			$sql = "SELECT * FROM main Where bookID = :search";
		} else if (isset($_POST['main'])) {
			$search = "%$search%";
			$sql = "SELECT * FROM main Where title OR bookID LIKE :search";
		} else {
			exit('error');
		}

		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':search', $search);
		$stmt->execute();

		$sql1 = "SELECT AVG(star) AS `STAR` FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
		$stmt1 = $conn->prepare($sql1);

		while ($row = $stmt->fetchObject()) {
			$data["bookID"] = $row->bookID;
			$bookID = $row->bookID;
			$data["title"] = $row->title;
			$data["author"] = $row->author;
			$data["quantity"] = $row->quantity;
			$data["Category1"] = $row->Category1;
			$data["Category2"] = $row->Category2;
			$data["Category3"] = $row->Category3;
			$data["Category4"] = $row->Category4;
			$data["publisher"] = $row->publisher;
			$data["pages"] = $row->pages;
			$data["price"] = 0;
			$data["imgLink"] = $row->imgLink;
			$data["date_of_publication"] = $row->date_of_publication;
			$data["isbn"] = $row->isbn;
			$data["digital"] = $row->digital;
			$data["book"] = $row->book;
			$data["digitalLink"] = $row->digitalLink;

			$stmt1->bindParam(':bookID', $bookID);
			$stmt1->execute();
			$row1 = $stmt1->fetchObject();
			$data["star"] = $row1->STAR;

			$return_arr[] = $data;
		}
	}
	echo json_encode($return_arr);
	exit;
} catch (PDOException $e) {
	exit($e);
}
