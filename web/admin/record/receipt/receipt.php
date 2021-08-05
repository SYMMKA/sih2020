<?php
include("../../../session.php");
include("../../../database.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
	$bookID = $_POST['bookID'];

    $sqlMain = "SELECT `title`, `receiptLink` FROM `main` WHERE `bookID` = :bookID";
	$stmtMain = $conn->prepare($sqlMain);
	$stmtMain->bindParam(':bookID', $bookID);
	$stmtMain->execute();
	$rowMain = $stmtMain->fetchObject();
	$title = $rowMain->title;
	$receiptLink = $rowMain->receiptLink;
	$return['book']['title'] = $title;
	$return['book']['receiptLink'] = $receiptLink;

	$sqlCopy = "SELECT * FROM `copies` WHERE `bookID` = :bookID";
	$stmtCopy = $conn->prepare($sqlCopy);
	$stmtCopy->bindParam(':bookID', $bookID);
	$stmtCopy->execute();

	$sqlCopyHistory = "SELECT `time` FROM `history` WHERE `copyID` = :copyID";
	$stmtCopyHistory = $conn->prepare($sqlCopyHistory);

    while ($rowCopy = $stmtCopy->fetchObject()) {
        $copyID = $rowCopy->copyID;
        $purchaseTime = $rowCopy->purchaseTime;
        $purchaseSource = $rowCopy->purchaseSource;
        $return['copy'][$copyID]['purchaseTime'] = date('d/m/Y H:i', $purchaseTime);
		$return['copy'][$copyID]['purchaseSource'] = $purchaseSource;
		
		$stmtCopyHistory->bindParam(':copyID', $copyID);
		$stmtCopyHistory->execute();
		$return['copy'][$copyID]['addDB'] = date('d/m/Y H:i', $stmtCopyHistory->fetchObject()->time);;
    }


    exit(json_encode($return));
} catch (PDOException $e) {
    exit($e);
}

$conn = null;
