<script>
  console.log("in addQuery.php");
</script>

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
	if ($_POST['title1'])
		$title2 = $_POST['title1'];
	else
		$title2 = NULL;
	echo $title2;
	if ($_POST['author1'])
		$author2 = $_POST['author1'];
	else
		$author2 = NULL;
	if ($_POST['bookID1'])
		$bookID = $_POST['bookID1'];
	else
		$bookID = NULL;
	if ($_POST['mainCategorySelect1']) {
		$category2 = $_POST['mainCategorySelect1'];
		echo $category2;
	} else
		$category2 = NULL;
	if ($_POST['publisher1'])
		$publisher2 = $_POST['publisher1'];
	else
		$publisher2 = NULL;
	if ($_POST['publishedDate1'])
		$date_of_publication2 = $_POST['publishedDate1'];
	else
		$date_of_publication2 = NULL;
	if ($_POST['isbn1'])
		$isbn2 = $_POST['isbn1'];
	else
		$isbn2 = NULL;
	if ($_POST['pageCount1'])
		$pageCount2 = $_POST['pageCount1'];
	else
		$pageCount2 = NULL;
	if ($_POST['money1'])
		$money2 = $_POST['money1'];
	else
		$money2 = NULL;
	if ($_POST['quantity1'])
		$quantity2 = $_POST['quantity1'];
	else
		$quantity2 = '1';
	if ($_POST['imgValue1'])
		$imgValue2 = $_POST['imgValue1'] . "&printsec=frontcover&img=1&zoom=1&source=gbs_api";
	else
		$imgValue2 = NULL;
	if ($_POST['subCategorySelect1'])
		$subCategory = $_POST['subCategorySelect1'];
	else
		$subCategory = NULL;
	//Dont add `id` column
	$sql = "INSERT INTO `books` (`title`, `author`, `bookID`, `category`, `subCategory`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`) VALUES ('$title2', '$author2', '$bookID', '$category2', '$subCategory', '$publisher2', '$pageCount2', '$money2', '$imgValue2', '$date_of_publication2', '$isbn2')";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
  
	header( "Location: addBooks.php" );
exit ;
}
/*
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
}*/
//================================================================
?>
<script>
  console.log("out addQuery.php");
</script>