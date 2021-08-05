<?php
//include connection file 
include("../../session.php");
include("../../database.php");

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'semBranchModifyAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if($access > $adminLevel){
	echo "\nAccess not granted";
	$conn = null;
	exit;
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if ($_POST['semester'] && $_POST['branch']) {
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $query = "INSERT INTO `sem_branch` (`sem`,`branch`) VALUES (:semester, :branch)";
        for ($i = 1; $i <= $semester; $i++) {
            # code...
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':semester', $i);
            $stmt->bindParam(':branch', $branch);
            $stmt->execute();
        }
    }
    $conn = null;
    exit('success');
} catch (PDOException $e) {
    $conn = null;
    exit($e);
}
