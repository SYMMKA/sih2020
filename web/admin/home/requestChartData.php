<?php
include("../../session.php");
include("../../database.php");
$query = "SELECT * ,COUNT(*) AS count FROM request_list GROUP BY `title` ORDER BY COUNT(*) DESC LIMIT 5";
$stmt = $conn->prepare($query);

$stmt->execute();

while ($row = $stmt->fetchObject()) {
    $data["count"] = $row->count;
    $data["title"] = $row->title;
    $result[] = $data;
}

// Encoding array in JSON format
if (!isset($result))
    echo FALSE;
else
    echo json_encode($result);

$conn = null;
exit;
