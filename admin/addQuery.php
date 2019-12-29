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

$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$publisher = $_POST['publisher'];
$date_of_publication = $_POST['publishedDate'];
$isbn = $_POST['isbn'];
$description = $_POST['description'];
$pageCount = $_POST['pageCount'];
$money = $_POST['money'];
$name = $_POST['name'];
$imgLink = $_POST['imgLink'];
$quantity = $_POST['quantity'];

        /*$title=document.getElementById('title').value;
        $author=document.getElementById('author').value;
        $author=document.getElementById('category').value;
        $publisher=document.getElementById('publisher').value; 
        $date_of_publication=document.getElementById('publishedDate').value; 
        $isbn=document.getElementById('isbn').value ;
        $description= document.getElementById('description').value;
        $pages=document.getElementById('pageCount').value;
        $price=document.getElementById('money').value ;
        $imgLink=document.getElementById('imgLink').src ;
        $quantity=document.getElementById('quantity').value ; */

$sql = "INSERT INTO `books` (`title`, `author`, `isbn`, `description`, `publisher`, `date_of_publication`, `pages`, `price`, `quantity`) VALUES ($title, $author, $isbn, $description, $publisher, $publishedDate, $pageCount, $money, $quantity)";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

//================================================================
?>


<!--<script>
function addBook(){
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "yousha",
  password: "youshayousha",
  database: "test1"
});

    con.connect(function(err) {
      if (err) throw err;
      var title=document.getElementById('title').value;
      var author=document.getElementById('author').value;
      var author=document.getElementById('category').value;
      var publisher=document.getElementById('publisher').value; 
      var date_of_publication=document.getElementById('publishedDate').value; 
      var isbn=document.getElementById('isbn').value ;
      var description= document.getElementById('description').value;
      var pages=document.getElementById('pageCount').value;
      var price=document.getElementById('money').value ;
      var imgLink=document.getElementById('imgLink').src ;
      var quantity=document.getElementById('quantity').value ;
      var sql = "INSERT INTO books (title, author, isbn, description, imgLink, publisher, date_of_publication, pages, price, quantity) VALUES (title, author, isbn, description, imgLink, publisher, date_of_publication, pages, price, quantity)"
        con.query(sql, function (err, result) {
          if (err) throw err;
    //console.log("1 record inserted, ID: " + result.insertId);
      });
  });
}
</script>-->