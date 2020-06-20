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
$change = 0;
if ($_POST['title']){
	$title = $_POST['title'];
	$change = 1;
}
else
	$title = $result["title"];

if ($_POST['author']){
	$author = $_POST['author'];
	$change = 1;
}
else
	$author = $result["author"];

if ($_POST['mainCategory1']){
	$category1 = $_POST['mainCategory1'];
	$change = 1;
}
else
	$category1 = $result["Category1"];

if ($_POST['mainCategory2']){
	$category2 = $_POST['mainCategory2'];
	$change = 1;
}
else
	$category2 = $result["Category2"];

if ($_POST['mainCategory3']){
	$category3 = $_POST['mainCategory3'];
	$change = 1;
}
else
	$category3 = $result["Category3"];

if ($_POST['mainCategory4']){
	$category4 = $_POST['mainCategory4'];
	$change = 1;
}
else
	$category4 = $result["Category4"];

if ($_POST['publisher']){
	$publisher = $_POST['publisher'];
	$change = 1;
}
else
	$publisher = $result["publisher"];

if ($_POST['pageCount']){
	$pages = $_POST['pageCount'];
	$change = 1;
}
else
	$pages = $result["pages"];

if ($_POST['publishedDate']){
	$date_of_publication = $_POST['publishedDate'];
	$change = 1;
}
else
	$date_of_publication = $result["date_of_publication"];

if ($_POST['money']){
	$price = $_POST['money'];
	$change = 1;
}
else
	$price = $result["price"];

if ($_POST['imgValue']){
	$imgLink = $_POST['imgValue'];
	$change = 1;
}
else
	$imgLink = $result["imgLink"];

if ($_POST['addQuan']) {
	$addQuan = $_POST['addQuan'];
	$quantity = $addQuan + $result["quantity"];
	$prevOrgQuan = $result["orgQuan"];
	$orgQuan =  $addQuan + $prevOrgQuan;
} else {
	$prevOrgQuan = $result["quantity"];
	$quantity = $result["quantity"];
	$orgQuan = $result["orgQuan"];
}

//old id for newly added copies not inserted
//Dont add `id` column
$sql = "UPDATE `main` SET `title` = '$title', `author` = '$author', `quantity` = '$quantity', `Category1` = '$category1', `Category2` = '$category2', `Category3` = '$category3', `Category4` = '$category4', `publisher` = '$publisher', `pages` = '$pages', `price` = '$price', `imgLink` = '$imgLink', `date_of_publication` = '$date_of_publication', `orgQuan` = '$orgQuan' WHERE `main`.`isbn` = '$isbn'";
if ($conn->query($sql) === TRUE) {
	if ($_POST['addQuan']) {
		for ($i = $prevOrgQuan + 1; $i <= $orgQuan; $i++) {
			$copyID = $isbn . '-' . $i;
			$sql1 = "INSERT INTO `copies` (`isbn`, `copyno`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`) VALUES ('$isbn', '$i', 'oldID', '$copyID', '', NULL, '', NULL, 'name')";
			if ($conn->query($sql1) === TRUE) {
				$sql2 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('$copyID', 'admin', '-', 'add', UNIX_TIMESTAMP(), '$isbn', 'oldID')";
				if ($conn->query($sql2) === TRUE) {
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
			} else {
				echo "Error: " . $sql1 . "<br>" . $conn->error;
			}
		}
	}
	if($change == 1) {
		$sql1 = "INSERT INTO `history` (`copyID`, `user`, `stud_ID`, `action`, `time`, `isbn`, `oldID`) VALUES ('-', 'admin', '-', 'update', UNIX_TIMESTAMP(), '$isbn', 'oldID')";
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