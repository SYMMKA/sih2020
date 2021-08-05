<?php
include("../database.php");

if (isset($_POST['stud_ID'])) {
    $stud_ID = $_POST['stud_ID'];

    if (isset($_POST['operation'])) {
        $operation = $_POST['operation'];

        if ($operation == "fetch") {
            $sql = "SELECT * FROM `notify_me` where `notify_me`.`stud_ID` = '$stud_ID'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql2 = "SELECT * FROM main WHERE `main`.`bookID` = :bookID";
            $stmt2 = $conn->prepare($sql2);

            $reserveNumQuery = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'reservePeriod'";
            $reserveNumstmt = $conn->prepare($reserveNumQuery);
            $reserveNumstmt->execute();
            $reserve_time = $reserveNumstmt->fetchObject()->value;


            $Sql_Query = "SELECT * FROM `copies` where bookID=:bookID and (status='' or (status='reserved' and UNIX_TIMESTAMP()-returnTime>$reserve_time))";
            $stmt3 = $conn->prepare($Sql_Query);

            while ($row = $stmt->fetchObject()) {
                $data["bookID"] = $row->bookID;
                $data["stud_ID"] = $row->stud_ID;

                $bookID = $row->bookID;
                $stmt2->bindParam(':bookID', $bookID);
                $stmt2->execute();
                $row2 = $stmt2->fetchObject();
                $data["title"] = $row2->title;
                $data["author"] = $row2->author;
                $data["publisher"] = $row2->publisher;

                $stmt3->bindParam(':bookID', $bookID);
                $stmt3->execute();
                $data["noOfBooks"] = $stmt3->rowCount();

                if ($stmt3->rowCount() > 0)
                    $data["status"] = "1";
                else
                    $data["status"] = "0";

                $return_arr[] = $data;
            }

            // Encoding array in JSON format
            if (isset($return_arr)) {
                echo json_encode($return_arr);
            } else {
                echo "false";
            }
        } else if ($operation == "delete") {
            if (isset($_POST['bookID'])) {
                $bookID = $_POST['bookID'];

                $sql = "DELETE FROM `notify_me` WHERE  `notify_me`.`stud_ID` = '$stud_ID' AND  `notify_me`.`bookID` = '$bookID'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $count = $stmt->rowCount();
                if ($count > 0) {

                    echo "delete_Sucessfull";
                } else {
                    echo "delete_Failed";
                }
            }
        }
    }
}

$conn = null;
