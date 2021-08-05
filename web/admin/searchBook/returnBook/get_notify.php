<?php
include("../../../session.php");
include("../../../database.php");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../mail/vendor/autoload.php';

function sendNotifyMail($title, $email, $name)
{
    $mail = new PHPMailer(true);
    $mail_to_ncdrc = new PHPMailer(true);

    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com;';  //Sets the SMTP hosts
    $mail->Port = '587';        //Sets the default SMTP server port
    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'symmka.ng@gmail.com';     //Sets SMTP username
    $mail->Password = 'xXN3onGenesisXx';     //Sets SMTP password
    $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = "symmka.ng@gmail.com";     //Sets the From email address for the message
    $mail->FromName = "From College Library";    //Sets the From name of the message
    $mail->AddAddress("$email", "$name"); //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML    
    $mail->Subject = "Regarding book Issued";    //Sets the Subject of the message
    $mail->Body =
        "Dear $name , the book $title is available for reservation.";    //An HTML or plain text message body
    if ($mail->Send())        //Send an Email. Return true on success or false on error
    {
        echo ("success");
    } else {
        exit("error occured in sending mail");
    }
}

try {
    if (isset($_POST["copyID"])) {
        $copyID = $_POST["copyID"];
        $query = "SELECT * FROM copies Where `copies`.`copyID` = :copyID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':copyID', $copyID);
        $stmt->execute();
        $row = $stmt->fetchObject();
        $bookID = $row->bookID;
        echo "$bookID\n";
        $query2 = "SELECT * FROM main Where `main`.`bookID` = :bookID";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':bookID', $bookID);
        $stmt2->execute();
        $row2 = $stmt2->fetchObject();
        $title = $row2->title;
        $query3 = "SELECT * FROM notify_me Where `notify_me`.`bookID` = :bookID";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bindParam(':bookID', $bookID);
        $stmt3->execute();
        while ($row3 = $stmt3->fetchObject()) {
            $stud_ID = $row3->stud_ID;
            $query4  = "SELECT * FROM students Where `students`.`stud_ID` = :stud_ID";
            $stmt4 = $conn->prepare($query4);
            $stmt4->bindParam(':stud_ID', $stud_ID);
            $stmt4->execute();
            $row4 = $stmt4->fetchObject();
            $email = $row4->email;
            $name = $row4->name;
            sendNotifyMail($title, $email, $name);
            $query5  = "DELETE FROM notify_me Where `notify_me`.`stud_ID` = :stud_ID AND `notify_me`.`bookID` = :bookID";
            $stmt5 = $conn->prepare($query5);
            $stmt5->bindParam(':stud_ID', $stud_ID);
            $stmt5->bindParam(':bookID', $bookID);
            $stmt5->execute();
        }
    }
} catch (PDOException $e) {
    exit($e);
}

$conn = null;
