
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function sendIssueMail($name, $issueTime, $returnTime, $copyID)
{

    return  $message = "Dear $name , you've issued copy $copyID. Please return it on $returnTime";
}


function sendReturnMail($name, $issueTime, $returnTime, $copyID)
{
    return $message = "Dear $name , please return the book copy $copyID";
}

function sendPayFineMail($name, $issueTime, $returnTime, $copyID)
{
    return $message = "Dear $name , please pay your fine for the book copy $copyID";
}


function sendMail($message, $email, $name)
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
    $mail->Body = $message;    //An HTML or plain text message body
    if ($mail->Send())        //Send an Email. Return true on success or false on error
    {
        echo "mail sent";
    } else {
        echo "error occured in sending mail";
    }
}



function mailBody($name, $issueTime, $returnTime, $copyID, $type, $email)
{

    if ($type == "issueMail") {
        $message = sendIssueMail($name, $issueTime, $returnTime, $copyID);
        sendMail($message, $email, $name);
    } else if ($type == "returnMail") {
        $message = sendReturnMail($name, $issueTime, $returnTime, $copyID);
        sendMail($message, $email, $name);
    } else if ($type == "payFineMail") {
        $message = sendPayFineMail($name, $issueTime, $returnTime, $copyID);
        sendMail($message, $email, $name);
    }
}

$sql2 = "SELECT value FROM setting where parameter='issuePeriod'";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$issuePeriod = $stmt2->fetchColumn();

$sql1 = "SELECT * FROM issued";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

while ($row1 = $stmt1->fetchObject()) {

    $bookID = $row1->bookID;
    $copyID = $row1->copyID;
    $stud_ID = $row1->stud_ID;
    $issuedate = strtotime(date("d-m-Y", $row1->time));
    $returnDate = $issuedate + $issuePeriod * 60 * 60 * 24;
    $due = $row1->due;
    $issuedate = strtotime(date("d-m-Y", $row1->time));
    $currentDate = strtotime(date("d-m-Y", time()));


    $sql3 = "SELECT * FROM students WHERE `students`.`stud_ID` = $stud_ID";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
    $row3 = $stmt3->fetchObject();
    $name = $row3->name;
    $email = $row3->email;

    if (($row1->returnTime) != null) {

        $returnTime = strtotime(date("d-m-Y", $row1->returnTime));


        if (($returnTime == $currentDate || (($currentDate - $returnTime) % 4 != 0)) && $due == 1) {

            mailBody($name, $issuedate, date("d-m-Y", $returnDate), $copyID, "payFineMail", $email);
        }
    } else {

        if ($issuedate == $currentDate) {

            mailBody($name, $issuedate, date("d-m-Y", $returnDate), $copyID, "issueMail", $email);
        } else if ($returnDate == $currentDate ||  (($currentDate - $returnDate) % 4 != 0)) {

            mailBody($name, $issuedate, date("d-m-Y", $returnDate), $copyID, "returnMail", $email);
        }
    }
}




?>