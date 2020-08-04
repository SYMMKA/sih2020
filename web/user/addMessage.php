
<?php

include("db.php");

if(@$_GET['message'] && @$_GET['stud_ID'] && @$_GET['name'])
{
    @$stud_ID=$_GET['stud_ID'];
    @$message=$_GET['message'];
    @$name=$_GET['name'];
    @$time=time();

    $sql1 = "SELECT `block` FROM `students` where `students`.`stud_ID`='$stud_ID'";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $block= $stmt1->fetchColumn();


    if($block!="1")
    {
    $sql = "INSERT INTO `chats`(`stud_ID`, `name`, `message`, `time`) VALUES ('$stud_ID','$name','$message','$time')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if( $stmt->rowCount() > 0)
        echo TRUE;
    else
        echo FALSE;
    }
    else
    {
        echo "You_are_blocked";
    }        
}


$conn = null;
exit;


?>