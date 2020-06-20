<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_POST['shelfName'])
    $shelfID = $_POST['shelfName'];
else
    $shelfID = NULL;

//Dont add `id` column
$sql = "INSERT INTO `shelf` (`shelfID`) VALUES ('$shelfID')";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

header( "Location: ../shelf.php" );
exit;
