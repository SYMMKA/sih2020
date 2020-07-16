<?php
//include connection file 
include("../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['generalSetting'])) {
    $issuePeriod = $_POST['issuePeriod'];
    $reservePeriod = $_POST['reservePeriod'];
    $issueLimit = $_POST['issueLimit'];
    $reserveLimit = $_POST['reserveLimit'];
    $dueFineAmount = $_POST['dueFineAmount'];
    $issuePoint = $_POST['issuePoint'];
    $returnPoint = $_POST['returnPoint'];
    $duePoint = $_POST['duePoint'];
    $ratingPoint = $_POST['ratingPoint'];

    try {
        $sql1 = "UPDATE `setting` SET `value` = :due_fine_amount WHERE `setting`.`parameter` = 'dueFine'";
        $sql2 = " UPDATE `setting` SET `value` = :due_point WHERE `setting`.`parameter` = 'duePoint'";
        $sql3 = " UPDATE `setting` SET `value` = :issue_limit WHERE `setting`.`parameter` = 'issueNum'";
        $sql4 = "UPDATE `setting` SET `value` = :issue_period WHERE `setting`.`parameter` = 'issuePeriod'";
        $sql5 = " UPDATE `setting` SET `value` = :issue_point WHERE `setting`.`parameter` = 'issuePoint'";
        $sql6 = " UPDATE `setting` SET `value` = :rating_point WHERE `setting`.`parameter` = 'ratingPoint'";
        $sql7 = " UPDATE `setting` SET `value` = :reserve_limit WHERE `setting`.`parameter` = 'reserveNum'";
        $sql8 = " UPDATE `setting` SET `value` = :reserve_period WHERE `setting`.`parameter` = 'reservePeriod'";
        $sql9 = "  UPDATE `setting` SET `value` = :return_point WHERE `setting`.`parameter` = 'returnPoint'";

        $stmt1 = $conn->prepare($sql1);
        $stmt2 = $conn->prepare($sql2);
        $stmt3 = $conn->prepare($sql3);
        $stmt4 = $conn->prepare($sql4);
        $stmt5 = $conn->prepare($sql5);
        $stmt6 = $conn->prepare($sql6);
        $stmt7 = $conn->prepare($sql7);
        $stmt8 = $conn->prepare($sql8);
        $stmt9 = $conn->prepare($sql9);

        $stmt4->bindParam(':issue_period', $issuePeriod);
        $stmt8->bindParam(':reserve_period', $reservePeriod);
        $stmt3->bindParam(':issue_limit', $issueLimit);
        $stmt7->bindParam(':reserve_limit', $reserveLimit);
        $stmt1->bindParam(':due_fine_amount', $dueFineAmount);
        $stmt5->bindParam(':issue_point', $issuePoint);
        $stmt9->bindParam(':return_point', $returnPoint);
        $stmt2->bindParam(':due_point', $duePoint);
        $stmt6->bindParam(':rating_point', $ratingPoint);

        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();
        $stmt5->execute();
        $stmt6->execute();
        $stmt7->execute();
        $stmt8->execute();
        $stmt9->execute();

        exit('success');
    } catch (PDOException $e) {

        exit($e);
    }
}