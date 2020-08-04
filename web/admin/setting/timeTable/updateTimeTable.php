<?php
include("../../session.php");
include("../../db.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
    $startTime[] = $_POST["mondayStartTime"];
    $startTime[] = $_POST["tuesdayStartTime"];
    $startTime[] = $_POST["wednesdayStartTime"];
    $startTime[] = $_POST["thursdayStartTime"];
    $startTime[] = $_POST["fridayStartTime"];
    $startTime[] = $_POST["saturdayStartTime"];
    $startTime[] = $_POST["sundayStartTime"];
   
    $endTime[] = $_POST["mondayEndTime"];
    $endTime[] = $_POST["tuesdayEndTime"];
    $endTime[] = $_POST["wednesdayEndTime"];
    $endTime[] = $_POST["thursdayEndTime"];
    $endTime[] = $_POST["fridayEndTime"];
    $endTime[] = $_POST["saturdayEndTime"];
    $endTime[] = $_POST["sundayEndTime"];
   
    $comment[] = $_POST["mondayComment"];
    $comment[] = $_POST["tuesdayComment"];
    $comment[] = $_POST["wednesdayComment"];
    $comment[] = $_POST["thursdayComment"];
    $comment[] = $_POST["fridayComment"];
    $comment[] = $_POST["saturdayComment"];
    $comment[] = $_POST["sundayComment"];
   
	$days[] = "Monday";
	$days[] = "Tuesday";
	$days[] = "Wednesday";
	$days[] = "Thursday";
	$days[] = "Friday";
	$days[] = "Saturday";
	$days[] = "Sunday";
    
	$sql = "UPDATE `timetable` SET `start` = :startTime, `end` = :endTime, `comment` = :comment WHERE `timetable`.`day` = :dayofWeek";
	$stmt = $conn->prepare($sql);

	for($i=0; $i<7; $i++) {
		$stmt->bindParam(':startTime',$startTime[$i]);
        $stmt->bindParam(':endTime',$endTime[$i]);
        $stmt->bindParam(':comment', $comment[$i]);
		$stmt->bindParam(':dayofWeek',$days[$i]);
		$stmt->execute();
    }
    
    exit("success");
}
catch(PDOException $e) {
    exit($e);
}

$conn = null;