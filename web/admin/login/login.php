<?php
include("../../database.php");
session_start();

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];

        $sql = "SELECT `password` FROM adminlogin WHERE `adminlogin`.`userID` = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $pass = $stmt->fetchObject()->password;
        if ($pass == $password) {
            $_SESSION['adminID'] = $username;
        } else {
            exit("error");
        }
    }

    exit("success");
} catch (PDOException $e) {
    exit($e);
}

$conn = NULL;
