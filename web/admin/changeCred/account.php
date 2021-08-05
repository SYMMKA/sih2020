<?php
include("../../session.php");
include("../../database.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    if (isset($_POST["password"])) {

        $pass = $_POST["password"];
        $sql = "UPDATE `adminlogin` SET `password` = :pass WHERE `adminlogin`.`userID` = :adminID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pass', $pass);
    } else {
        exit("error");
    }

    $stmt->bindParam(':adminID', $adminID);
    $stmt->execute();

    exit("success");
} catch (PDOException $e) {
    exit($e);
}

$conn = NULL;
