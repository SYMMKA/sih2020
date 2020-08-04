

<?php


include("db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$reserveNumQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'reservePeriod'";
$reserveNumstmt = $conn->prepare($reserveNumQuery);
$reserveNumstmt->execute();
$reserve_time= $reserveNumstmt->fetchObject()->value;

if(@$_GET['bookID']){ 
    @$bookID=$_GET['bookID'];
   
        $Sql_Query = "SELECT * FROM `copies` where bookID=$bookID and (status='' or (status='reserved' and UNIX_TIMESTAMP()-returnTime>$reserve_time))";
        $stmt = $conn->prepare($Sql_Query);
        $stmt->execute();
        $count1 = $stmt->rowCount();
        
    
            if($count1>0)
            {
                while($row = $stmt->fetchObject()) {            
                    $data["bookID"] = $row->bookID;
                    $data["copyNO"] = $row->copyNO;
                    $data["copyID"] = $row->copyID;
                    $data["stud_ID"] = $row->stud_ID;
                    $data["shelfID"] = $row->shelfID;
                    $data["status"] = $row->status;
         
                    $return_arr[] = $data;   
            }      

             echo json_encode($return_arr);
         } 
        else {
        echo "NO_BOOKS_AVAILABLE";
        } 

}
 
?>