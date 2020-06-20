<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$isbn = $_POST['isbn'];
$query = "SELECT * FROM copies WHERE `copies`.`isbn` = '$isbn'";
$returnD = mysqli_query($conn, $query);

while ($result = mysqli_fetch_array($returnD)) {
    $data["shelfID"] = $result["shelfID"];
    $data["copyno"] = $result["copyno"];
    $data["copyID"] = $result["copyID"];
    $data["oldID"] = $result["oldID"];
    $data["stud_ID"] = $result["stud_ID"];
    $data["status"] = $result["status"];
    $data["time"] = $result["time"];
    $data["returnTime"] = $result["returnTime"];
    $data["currentTime"] = time();
    $return_arr[] = $data;
}

// Encoding array in JSON format
if(!isset($return_arr))
    echo FALSE;
else
    echo json_encode($return_arr);
?>