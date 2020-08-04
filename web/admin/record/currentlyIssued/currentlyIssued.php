<?php
include("../../session.php");
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    $sql = "SELECT `bookID`, `copyNO`, `stud_ID`, `time`, `returnTime` FROM `copies` WHERE `copies`.`status` = 'issued' ORDER BY `copies`.`returnTime` ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetchObject()) {
        $data['bookID'] = $row->bookID;
        $data['copyNO'] = $row->copyNO;
        $data['stud_ID'] = $row->stud_ID;
        $data['time'] = date('d/m/Y H:i', $row->time);
        $data['returnTime'] = date('d/m/Y H:i', $row->returnTime);
        $return[] = $data;
    }

    exit(json_encode($return));
} catch (PDOException $e) {
    exit($e);
}
$conn = null;
