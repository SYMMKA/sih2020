<?php
//include connection file 
include("../../session.php");
include("../../db.php");

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'settingsAdminAccess'";
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

$addBookAccess = $_POST['addBookAccess'];
$addBookAccessParam = 'addBookAccess';

$issueAccess = $_POST['issueAccess'];
$issueAccessParam = 'issueAccess';

$bookShelfAccess = $_POST['bookShelfAccess'];
$bookShelfAccessParam = 'bookShelfAccess';

$settingsAccess = $_POST['settingsAccess'];
$settingsAccessParam = 'settingsAccess';

$settingsAdminAccess = $_POST['settingsAdminAccess'];
$settingsAdminAccessParam = 'settingsAdminAccess';

$updateBookAccess = $_POST['updateBookAccess'];
$updateBookAccessParam = 'updateBookAccess';

$returnAccess = $_POST['returnAccess'];
$returnAccessParam = 'returnAccess';

$semBranchModifyAccess = $_POST['semBranchModifyAccess'];
$semBranchModifyAccessParam = 'semBranchModifyAccess';

$shelfModifyAccess = $_POST['shelfModifyAccess'];
$shelfModifyAccessParam = 'shelfModifyAccess';

$bookSemBranchAccess = $_POST['bookSemBranchAccess'];
$bookSemBranchAccessParam = 'bookSemBranchAccess';

try {
	$sql = "UPDATE `setting` SET `value` = :val WHERE `setting`.`parameter` = :parameter";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':val', $addBookAccess);
	$stmt->bindParam(':parameter', $addBookAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $issueAccess);
	$stmt->bindParam(':parameter', $issueAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $bookShelfAccess);
	$stmt->bindParam(':parameter', $bookShelfAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $settingsAccess);
	$stmt->bindParam(':parameter', $settingsAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $settingsAdminAccess);
	$stmt->bindParam(':parameter', $settingsAdminAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $updateBookAccess);
	$stmt->bindParam(':parameter', $updateBookAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $returnAccess);
	$stmt->bindParam(':parameter', $returnAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $semBranchModifyAccess);
	$stmt->bindParam(':parameter', $semBranchModifyAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $shelfModifyAccess);
	$stmt->bindParam(':parameter', $shelfModifyAccessParam);
	$stmt->execute();

	$stmt->bindParam(':val', $bookSemBranchAccess);
	$stmt->bindParam(':parameter', $bookSemBranchAccessParam);
	$stmt->execute();

} catch (PDOException $e) {
	exit($e);
}

$conn = null;
