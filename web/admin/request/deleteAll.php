<?php
include("../session.php");
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql =
        "TRUNCATE `library`.`request_list`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    exit("success");
} catch (PDOException $e) {
    exit($e);
}

$conn = null;
