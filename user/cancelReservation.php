
<?php

include("db.php");

if(@$_POST['copyID'] && @$_POST['stud_ID'])
{
    @$stud_ID=$_POST['stud_ID'];
    @$copyID=$_POST['copyID'];
    $set="";
    echo $copyID;
 
    $sql = "UPDATE `copies` SET `status`='$set' WHERE `stud_ID`='$stud_ID' and `copyID`='$copyID'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if( $stmt->rowCount() > 0)
        echo "TRUE";
    else
        echo "FALSE";
    
      
}




?>