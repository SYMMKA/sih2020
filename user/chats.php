
<?php


include("db.php");


$sql = "SELECT * FROM chats ";
$stmt = $conn->prepare($sql);
$stmt->execute();


while ($row = $stmt->fetchObject()) {
   
	$data["id"] = $row->id;
	$data["stud_ID"] = $row->id;
	$data["name"] = $row->name;
    $data["message"] = $row->message;
    $data["time"] = date("d-m-y H:i",$row->time);

    $return_arr[] = $data;
}

if (!isset($return_arr))
	echo FALSE;
else
	echo json_encode($return_arr);

$conn = null;
exit;


?>