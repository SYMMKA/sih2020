<?php


//DB CONNECTION====================================
include("db.php");

if(@$_POST['stud_ID'] && @$_POST['password'])
{
$stud_ID = $_POST['stud_ID'];
$password = $_POST['password'];


$sql = "SELECT * FROM students WHERE `students`.`stud_ID` = '$stud_ID' AND `students`.`password` = '$password'";
$stmt = $conn->prepare($sql);
$stmt->execute();


if ($stmt->rowCount()) {

    while ($row = $stmt->fetchObject()) {

        $data["name"] = $row->name;
        $data["email"] = $row->email;
        $data["mobile"] = $row->mobile;
        $data["points"] = $row->points;
        $data["type"] = $row->type;
        $data["block"] = $row->block;
    
        $return_arr[] = $data;
    }

    
	echo json_encode($return_arr);

} else {
    echo FALSE;
}

}


?>