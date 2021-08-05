<?php
include("../database.php");

if (@$_POST['bookID'] && @$_POST['copyNO'] && @$_POST['stud_ID'] && @$_POST['type']) {

    @$bookID = $_POST['bookID'];
    @$copyNO = $_POST['copyNO'];
    @$stud_ID = $_POST['stud_ID'];
    @$type = $_POST['type'];
    echo $type;

    if ($type == "student")
        $timePeriodQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'reserveNum'";
    else
        $timePeriodQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherReserveNum'";
    $timePeriodstmt = $conn->prepare($timePeriodQuery);
    $timePeriodstmt->execute();
    $reserveNum = $timePeriodstmt->fetchObject()->value;

    echo "amount = $reserveNum";

    $reserveNumQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'reservePeriod'";
    $reserveNumstmt = $conn->prepare($reserveNumQuery);
    $reserveNumstmt->execute();
    $reserve_time = ($reserveNumstmt->fetchObject()->value) * 60;

    echo "time = $reserve_time";

    $limitQuery = "SELECT * FROM `copies` where  stud_ID=$stud_ID and ((status='reserved' and UNIX_TIMESTAMP()-returnTime<$reserve_time)) ";
    $limitstmt = $conn->prepare($limitQuery);
    $limitstmt->execute();
    $limit = $limitstmt->rowCount();

    echo "row count $limit";

    if ($limit < $reserveNum) {
        $Sql_Query1 = "SELECT * FROM `copies` where bookID=$bookID and stud_ID=$stud_ID and (status='issued' or (status='reserved' and UNIX_TIMESTAMP()-returnTime<$reserve_time)) ";
        $stmt1 = $conn->prepare($Sql_Query1);
        $stmt1->execute();
        $count1 = $stmt1->rowCount();

        if ($count1 > 0) {
            echo "one_copy_is_already_reserved";
        } else {
            $Sql_Query2 = "UPDATE `copies` SET `stud_ID`=$stud_ID,`time`=UNIX_TIMESTAMP(),`status`='reserved',`returnTime`=UNIX_TIMESTAMP()+$reserve_time WHERE bookID=$bookID and copyNO=$copyNO ";
            $stmt2 = $conn->prepare($Sql_Query2);
            $stmt2->execute();
            $count2 = $stmt2->rowCount();
            if ($count2 > 0) {
                echo "Reservation_Sucessfull";
            } else {
                echo "Reservation_Failed";
            }
        }
    } else {
        echo "out_of_limit";
    }
} else {
    echo "error";
}
?>