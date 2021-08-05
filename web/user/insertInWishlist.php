<?php
include("../database.php");

if (isset($_POST['stud_ID']) && isset($_POST['bookID'])) {
    $bookID = $_POST['bookID'];
    $stud_ID = $_POST['stud_ID'];


    $sql = "SELECT * FROM `notify_me` where `notify_me`.`stud_ID` = '$stud_ID' and `notify_me`.`bookID` = '$bookID'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

   
    if ($count == 0) {

        $sql1 = "INSERT INTO `notify_me`(`bookID`, `stud_ID`) VALUES ('$bookID','$stud_ID')";


        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
    
        $count1 = $stmt1->rowCount();

        
        if ($count1 > 0) {
    
            echo "insert_Sucessfull";
        } else {
            echo "insert_Failed";
        }
    } 
    else {
        echo "already present";
    }


    
}


?>