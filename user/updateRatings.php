
<?php
include("db.php");

if (@$_POST['copyID'] && @$_POST['stud_ID'] && @$_POST['star'] && @$_POST['type']) {

    @$copyID = $_POST['copyID'];
    @$stud_ID = $_POST['stud_ID'];
    @$star = $_POST['star'];
    @$type = $_POST['type'];

    if ($type == "student")
        $getPointsQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'ratingPoint'";
    else
        $getPointsQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'teacherRatingpoint'";
    $getPointsstmt = $conn->prepare($getPointsQuery);
    $getPointsstmt->execute();
    $points = $getPointsstmt->fetchObject()->value;


    $sql = "UPDATE `issued` SET `star`= $star WHERE `stud_ID`='$stud_ID' and `copyID`='$copyID'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->execute()) {

        $sqlupdate1 = "UPDATE `students` SET `points`= points+'$points' WHERE `stud_ID`='$stud_ID' ";
        $stmtupdate1 = $conn->prepare($sqlupdate1);
        $stmtupdate1->execute();

        echo "Update_Sucessfull";
    } else {
        echo "Update_Failed";
    }
}


?>