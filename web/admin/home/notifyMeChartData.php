<?php
include("../session.php");
include("../db.php");

$query = "SELECT * , COUNT(*) AS count FROM notify_me GROUP BY bookID ORDER BY COUNT(*) DESC LIMIT 5";
$stmt = $conn->prepare($query);
//$issuedstmt->bindParam(':copyID', $copyID);

$query1 = "SELECT `title` FROM `main` WHERE `bookID`=:bookID";
$stmt1 = $conn->prepare($query1);

$stmt->execute();

while ($row = $stmt->fetchObject()) {
    $data["count"] = $row->count;
    $bookID = $row->bookID;
    $stmt1->bindParam(':bookID', $row->bookID);
    $stmt1->execute();
    $row1 = $stmt1->fetchObject();
    $data["title"] = $row1->title;
    $result[] = $data;
}

// Encoding array in JSON format
if (!isset($result))
    echo FALSE;
else
    echo json_encode($result);

$conn = null;
exit;
