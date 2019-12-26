<?php
       console.log("hey addQuery==================");
        //DB CONNECTION====================================
        $servername = "localhost";
        $username = "yousha";
        $password = "youshayousha";
        $dbname = "test1";
  
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $title=document.getElementById('title').value;
        $author=document.getElementById('author').value;
        $publisher=document.getElementById('publisher').value; 
        $date_of_publication=document.getElementById('publishedDate').value; 
        $isbn=document.getElementById('isbn').value ;
        $description= document.getElementById('description').value;
        $pages=document.getElementById('pageCount').value;
        $price=document.getElementById('money').value ;
        $imgLink=document.getElementById('imgLink').src ;
        $quantity=document.getElementById('quantity').value ;
  
        $sql = "INSERT INTO books (title, author, isbn, description, imgLink, publisher, date_of_publication, pages, price, quantity) VALUES ($title, $author, $isbn, $description, $imgLink, $publisher, $date_of_publication, $pages, $price, $quantity)";
  
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