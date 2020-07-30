
<?php
$HostName = "localhost";
$DatabaseName = "library";
$HostUser = "root";
$HostPass = ""; 
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
if ($conn->connect_error) { 
 die("Connection failed: " . $conn->connect_error);
}
if(@$_GET['bookID']){ 
    @$bookID=$_GET['bookID'];
    $reserve_time=30;
        $Sql_Query = "SELECT * FROM `copies` where bookID=$bookID and (status='issued' or (status='reserved' and (UNIX_TIMESTAMP()-returnTime<$reserve_time) )) ORDER BY returnTime ASC;";
        $result=mysqli_query($conn,$Sql_Query);        
        if (mysqli_num_rows($result)) {
        
            while($row[] = $result->fetch_assoc()) {            
            $item = $row;            
            $json = json_encode($item);            
            }      
        echo $json;
        } 
        else {
        echo "ALL_BOOKS_ARE_AVAILABLE";
        } 
  $conn->close();
}
 
?>