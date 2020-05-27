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
if ($_POST['copyID'])
	$copyID = $_POST['copyID'];
else
	$copyID = NULL;

// To get isbn
$query = "SELECT * FROM copies Where `copies`.`copyID` = '$copyID'";
$returnD = mysqli_query($conn, $query);

while ($result = mysqli_fetch_array($returnD)) {
	$isbn = $result["isbn"];
}
// To get quantity
$query = "SELECT * FROM main Where `main`.`isbn` = '$isbn'";
$returnD = mysqli_query($conn, $query);

while ($result = mysqli_fetch_array($returnD)) {
	$quantity = $result["quantity"] - 1; //reduce quantity by 1
}

//Dont add `id` column
$sql = "DELETE FROM `copies` WHERE `copies`.`copyID` = '$copyID'";
if ($conn->query($sql) === TRUE) {
	$sql1 = "UPDATE `main` SET `quantity` = '$quantity' WHERE `main`.`isbn` = '$isbn'";
	if ($conn->query($sql1) === TRUE) {
		$sql2 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('$copyID', 'admin', '-', 'delete', UNIX_TIMESTAMP(), '$isbn', 'oldID')";
		if ($conn->query($sql2) === TRUE) {
		} else {
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}
	} else {
		echo "Error: " . $sql1 . "<br>" . $conn->error;
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header( "Location: ../searchBooks.php" );
exit;
