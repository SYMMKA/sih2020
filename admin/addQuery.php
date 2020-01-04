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
if (isset($_POST['addBook'])) {
  if ($_POST['title'])
    $title2 = $_POST['title'];
  else
    $title2 = NULL;
  if ($_POST['author'])
    $author2 = $_POST['author'];
  else
    $author2 = NULL;
  if ($_POST['category'])
    $category2 = $_POST['category'];
  else
    $category2 = NULL;
  if ($_POST['publisher'])
    $publisher2 = $_POST['publisher'];
  else
    $publisher2 = NULL;
  if ($_POST['publishedDate'])
  $date_of_publication2 = $_POST['publishedDate'];
  else
    $date_of_publication2 = NULL;
  if ($_POST['isbn'])
    $isbn2 = $_POST['isbn'];
  else
    $isbn2 = NULL;
  if ($_POST['description'])
    $description2 = $_POST['description'];
  else
    $description2 = NULL;
  if ($_POST['pageCount'])
    $pageCount2 = $_POST['pageCount'];
  else
    $pageCount2 = NULL;
  if ($_POST['money'])
    $money2 = $_POST['money'];
  else
    $money2 = NULL;
  if ($_POST['quantity'])
    $quantity2 = $_POST['quantity'];
  else
    $quantity2 = '1';
  if ($_POST['imgValue'])
    $imgValue2 = $_POST['imgValue'] . "&printsec=frontcover&img=1&zoom=1&source=gbs_api";
  else
    $imgValue2 = NULL;
  //Dont add `id` column
  $sql = "INSERT INTO `books` (`title`, `author`, `category`, `publisher`, `date_of_publication`, `isbn`, `description`, `pages`, `price`, `imgLink`, `quantity`) VALUES ('$title2', '$author2', '$category2', '$publisher2', '$date_of_publication2', '$isbn2', '$description2', '$pageCount2', '$money2', '$imgValue2', '$quantity2')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
//================================================================
?>