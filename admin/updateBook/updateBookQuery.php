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

$isbn = $_POST['isbn'];
$query = "SELECT * FROM `main` Where `main`.`isbn` = '$isbn'";
$returnD = mysqli_query($conn, $query);

$result = mysqli_fetch_array($returnD);

if ($_POST['title'])
	$title = $_POST['title'];
else
	$title = $result["title"];

if ($_POST['author'])
	$author = $_POST['author'];
else
	$author = $result["author"];

if ($_POST['mainCategory1'])
	$category1 = $_POST['mainCategory1'];
else
	$category1 = $result["Category1"];

if ($_POST['mainCategory2'])
	$category2 = $_POST['mainCategory2'];
else
	$category2 = $result["Category2"];

if ($_POST['mainCategory3'])
	$category3 = $_POST['mainCategory3'];
else
	$category3 = $result["Category3"];

if ($_POST['mainCategory4'])
	$category4 = $_POST['mainCategory4'];
else
	$category4 = $result["Category4"];

if ($_POST['publisher'])
	$publisher = $_POST['publisher'];
else
	$publisher = $result["publisher"];

if ($_POST['pageCount'])
	$pages = $_POST['pageCount'];
else
	$pages = $result["pages"];

if ($_POST['publishedDate'])
	$date_of_publication = $_POST['publishedDate'];
else
	$date_of_publication = $result["date_of_publication"];

if ($_POST['money'])
	$price = $_POST['money'];
else
	$price = $result["price"];

if ($_POST['imgValue'])
	$imgLink = $_POST['imgValue'];
else
	$imgLink = $result["imgLink"];

if ($_POST['addQuan']) {
	$prevQuan = $result["quantity"];
	$addQuan = $_POST['addQuan'];
	$quantity = $addQuan + $prevQuan;
} else{
	$prevQuan = $result["quantity"];
	$quantity = $result["quantity"];
}

//old id for newly added copies not inserted
//Dont add `id` column
$sql = "UPDATE `main` SET `title` = '$title', `author` = '$author', `quantity` = '$quantity', `Category1` = '$category1', `Category2` = '$category2', `Category3` = '$category3', `Category4` = '$category4', `publisher` = '$publisher', `pages` = '$pages', `price` = '$price', `imgLink` = '$imgLink', `date_of_publication` = '$date_of_publication' WHERE `main`.`isbn` = '$isbn'";
if ($conn->query($sql) === TRUE) {
	for ($i = $prevQuan + 1; $i <= $quantity; $i++) {
		$copyID = $isbn . '-' . $i;
		$sql1 = "INSERT INTO `copies` (`isbn`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`) VALUES ('$isbn', '$i', '', '$copyID', '', NULL, '', NULL)";
		if ($conn->query($sql1) === TRUE) {
		} else {
			echo "Error: " . $sql1 . "<br>" . $conn->error;
		}
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

//header( "Location: ../searchBooks.php" );
exit;
