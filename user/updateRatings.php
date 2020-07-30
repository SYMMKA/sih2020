
<?php
include("db.php");

if( @$_POST['copyID'] && @$_POST['stud_ID'] && @$_POST['star']){
 
    @$copyID=$_POST['copyID'];
    @$stud_ID=$_POST['stud_ID'];
    @$star=$_POST['star'];
    
            $sql = "UPDATE `issued` SET `star`= $star WHERE `stud_ID`='$stud_ID' and `copyID`='$copyID'";         
            $stmt = $conn->prepare($sql);
            $stmt->execute();         
            if ($stmt->execute()) {       
             echo "Update_Sucessfull";
            } else {
            echo "Update_Failed";
            }

}

 
?>