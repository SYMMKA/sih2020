<?php
//DB CONNECTION====================================
$servername = "remotemysql.com";
$username = "2qTzr9mwEz";
$password = "u931TbHEs5";
$database = "2qTzr9mwEz";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title2 = $_POST['title1'];
$author2 = $_POST['author1'];
$category2 = $_POST['category1'];
$publisher2 = $_POST['publisher1'];
$date_of_publication2 = $_POST['publishedDate1'];
$isbn2 = $_POST['isbn1'];
$description2 = $_POST['description1'];
$pageCount2 = $_POST['pageCount1'];
$money2 = $_POST['money1'];
$quantity2 = $_POST['quantity1'];
$imgLink2 = $_POST['imgLink1']."&printsec=frontcover&img=1&zoom=1&source=gbs_api";

if(!$_POST['title1'])
  $title2 = NULL;
if(!$_POST['author1'])
  $author2 = NULL;
if(!$_POST['category1'])
  $category2 = NULL;
if(!$_POST['publisher1'])
  $publisher2 = NULL;
if(!$_POST['publishedDate1'])
  $date_of_publication2 = '1900-01-01';
if(!$_POST['isbn1'])
  $isbn2 = NULL;
if(!$_POST['description1'])
  $description2 = NULL;
if(!$_POST['pageCount1'])
  $pageCount2 = NULL;
if(!$_POST['money1'])
  $money2 = NULL;
if(!$_POST['quantity1'])
  $quantity2 = '1';
if(!$_POST['imgLink1'])
  $imgLink2 = NULL;

//Dont add `id` column
$sql = "INSERT INTO `books` (`title`, `author`, `category`, `publisher`, `date_of_publication`, `isbn`, `description`, `pages`, `price`, `imgLink`, `quantity`) VALUES ('$title2', '$author2', '$category2', '$publisher2', '$date_of_publication2', '$isbn2', '$description2', '$pageCount2', '$money2', '$imgLink2', '$quantity2')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

//================================================================
?>