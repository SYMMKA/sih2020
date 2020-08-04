
<?php
include("db.php");

if ( @$_POST['stud_ID'] && @$_POST['password'] ) {

    @$password = $_POST['password'];
    @$stud_ID = $_POST['stud_ID'];

    $sql = "UPDATE `students` SET `password`= '$password' WHERE `stud_ID`='$stud_ID' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();        
    if ($count>0) {

        echo "Update_Sucessfull";
    } else {
        echo "Update_Failed";
    }
}


?>