
<?php

include("db.php");

$sql1 = "SELECT * FROM shelf";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':shelfID', $shelfID);
$stmt1->execute();

$sql2 = "SELECT * FROM copies WHERE `copies`.`shelfID` = :shelfID";
$stmt2 = $conn->prepare($sql2);


while ($row1 = $stmt1->fetchObject()) {
    $data["shelfID"] = $row1->shelfID;
    $shelfID = $row1->shelfID;
    
	$stmt2->bindParam(':shelfID', $shelfID);
	$stmt2->execute();
	$row2 = $stmt2->fetchObject();
	$data["count"] =  $stmt2->rowCount();
	$return_arr[] = $data;
}

// Encoding array in JSON format
if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;

?>