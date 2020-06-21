<?php
include("../db.php");

$shelfID = $_POST['shelfID'];
$sql1 = "SELECT * FROM copies WHERE `copies`.`shelfID` = '$shelfID'";
$returnD = mysqli_query($conn, $sql1);

while ($result = mysqli_fetch_array($returnD)) {
    $isbn = $result["isbn"];
    $sql2 = "SELECT `imgLink` FROM main WHERE `main`.`isbn` = '$isbn'";
    $returnD2 = mysqli_query($conn, $sql2);
    $result2 = mysqli_fetch_array($returnD2);
    $data["imgLink"] = $result2["imgLink"];

    $data["isbn"] = $result["isbn"];
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