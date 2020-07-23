<?php
include("../../session.php");
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    $sql = "SELECT * FROM `main`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetchObject()) {
        $bookID = $row->bookID;
        $return[$bookID] = $row->title;
    }

    exit(json_encode($return));
} catch (PDOException $e) {
    exit($e);
}
