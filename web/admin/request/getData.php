<?php
include("../session.php");
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql = "SELECT *, COUNT(*) AS count FROM `request_list` GROUP BY `title`, `author`, `isbn` order by count(*) desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetchObject()) {
        $data['title'] = $row->title;
        $data['author'] = $row->author;
        $data['isbn'] = $row->isbn;
        $data['count'] = $row->count;
        $return[] = $data;
    }
    // Encoding array in JSON format
    if (!isset($return))
        exit("false");
    else
        exit(json_encode($return));
} catch (PDOException $e) {
    exit($e);
}

$conn = null;
