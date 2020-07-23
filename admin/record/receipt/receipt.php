<?php
include("../../session.php");
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    $sql = "SELECT * FROM `main`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetchObject()) {
        $data['bookID'] = $row->bookID;
        $data['title'] = $row->title;
        $data['receiptLink'] = $row->receiptLink;
        $return[] = $data;
    }


    exit(json_encode($return));
} catch (PDOException $e) {
    exit($e);
}
