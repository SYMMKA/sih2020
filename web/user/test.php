<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

			/*	$sql = "SELECT * FROM main ";
				$stmt = $conn->prepare($sql);
				$stmt->execute();

				$sql1 = "SELECT AVG(star) AS `STAR` FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
				$stmt1 = $conn->prepare($sql1);
				$i = 0;

				while ($row = $stmt->fetchObject()) {

                    $data["title"] = $row->title;
                    $data["imgLink"] = $row->imgLink;
                    $data["isbn"] = $row->isbn;
                    $data["author"] = $row->author;
                    $data["quantity"] = $row->quantity;
                    $data["Category1"] = $row->Category1;
                    $data["Category2"] = $row->Category2;
                    $data["Category3"] = $row->Category3;
                    $data["Category4"] = $row->Category4;
                    $data["publisher"] = $row->publisher;
                    $data["pages"] = $row->pages;
                    $data["quantity"] = $row->quantity;
                    $data["price"] = $row->price;
                    $data["date_of_publication"] = $row->date_of_publication;

                    $stmt1->bindParam(':bookID', $bookID[$i]);
					$stmt1->execute();
					$row1 = $stmt1->fetchObject();
                    $data["star"] = $row1->STAR;
			
                    $return_arr[] = $data;
                }

                // Encoding array in JSON format
if (!isset($return_arr))
echo FALSE;
else
echo json_encode($return_arr);  */

$sql = "SELECT * FROM main ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':search', $search);
$stmt->execute();

$sql1 = "SELECT AVG(star) AS `STAR` FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
$stmt1 = $conn->prepare($sql1);


while ($row = $stmt->fetchObject()) {
   
    $stmt1->bindParam(':bookID', $row->bookID);
    $stmt1->execute();
    $row1 = $stmt1->fetchObject();

	$data["title"] = $row->title;
	$data["imgLink"] = $row->imgLink;
    $data["isbn"] = $row->isbn;
    $data["author"] = $row->author;
	$data["quantity"] = $row->quantity;
    $data["Category1"] = $row->Category1;
    $data["Category2"] = $row->Category2;
	$data["Category3"] = $row->Category3;
    $data["Category4"] = $row->Category4;
    $data["publisher"] = $row->publisher;
    $data["pages"] = $row->pages;
    $data["quantity"] = $row->quantity;
	$data["price"] = $row->price;
    $data["date_of_publication"] = $row->date_of_publication;
    $data["star"] = $row1->STAR;

    $return_arr[] = $data;
}

if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;
