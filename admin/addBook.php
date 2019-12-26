
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/97f3c2998d.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="style.css" />



  <title>Document</title>

</head>

<body>


 

  <section>
    <div class="container-fluid form " style="height:auto; ">
      <h1 style=" color:#46b5d1;">ADD BOOK</h1>
      <form>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Title</label>
          <div class="col-md-6">
            <input type="text" class="form-control" id="title" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="author" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="category" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="isbn" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="description" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Publisher</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="publisher" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Published Date</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="publishedDate" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Page count</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="pageCount" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Price</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="money" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Image</label>
          <img id="imgLink" hidden="true" src="" alt="your image" width="100" height="100" />
          <input id="imgFile" type="file" onchange="document.getElementById('imgLink').src = window.URL.createObjectURL(this.files[0]), document.getElementById('imgLink').hidden= false">
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-6">
            <input type="number" class="form-control" id="quantity" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category1</label>
          <select class="col-sm-2 col-form-label" id="category1" onclick="autoBookId(this.value)">
            <option value="maths">Maths</option>
            <option value="science">Science</option>
            <option value="technology">Technology</option>
            <option value="art">Art</option>
          </select>
          <br><br>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Book ID</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="bookId" placeholder="Example input" value="MAT">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <div class="col-sm-1 addbook">
            <button type="submit" class="btn btn-info btn-lg" onclick=addBook()>Add Book</button>
          </div>
        </div>
      </form>
    </div>

<script>
  function addBook()
  {
    $.ajax({
      url:'addQuery.php',
      complete: function (response) {
          //$('#output').html(response.responseText);
          alert("reached add query ");
      },
      error: function () {
          //$('#output').html('Bummer: there was an error!');
          alert("did not reached add query ");
      }
  });
  return false;
  }
</script>
    <script>
      function autoBookId(category) {
        switch (category) {
          case "maths":
            document.getElementById('bookId').value = "MAT";
            break;
          case "science":
            document.getElementById('bookId').value = "SCI";
            break;
          case "technology":
            document.getElementById('bookId').value = "TECH";
            break;
          case "art":
            document.getElementById('bookId').value = "ART";
            break;
        }
      }
    </script>

  </section>
  <section>
    <div class="container-fluid search" style="height:auto; color:powderblue; padding-bottom: 5rem; ">
      <form id="search-form" method="post">
        <div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
          <div class="col-md-4">
            <label class="sr-only " for="inlineFormInput">Name</label>
            <input type="text" class="form-control mb-2 form-control form-control-lg" id="search-input" placeholder="Book Name" name="voice-search" autocomplete="on" />
            <span id="voice-trigger">
              <svg width="32px" height="32px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                <g>
                  <path d="M44,28c-0.552,0-1,0.447-1,1v6c0,7.72-6.28,14-14,14s-14-6.28-14-14v-6c0-0.553-0.448-1-1-1s-1,0.447-1,1v6   c0,8.485,6.644,15.429,15,15.949V56h-5c-0.552,0-1,0.447-1,1s0.448,1,1,1h12c0.552,0,1-0.447,1-1s-0.448-1-1-1h-5v-5.051   c8.356-0.52,15-7.465,15-15.949v-6C45,28.447,44.552,28,44,28z" />
                  <path d="M29,46c6.065,0,11-4.935,11-11V11c0-6.065-4.935-11-11-11S18,4.935,18,11v24C18,41.065,22.935,46,29,46z M20,11   c0-4.963,4.038-9,9-9s9,4.037,9,9v24c0,4.963-4.038,9-9,9s-9-4.037-9-9V11z" />
                </g>
              </svg>
            </span>
            </fieldset>
          </div>

          <div class="col-auto">
            <button type="submit" class="btn btn-info mb-2 btn-lg" style="width: 130px;" value="submit">
              Search 
            </button>
          </div>
        </div>
      </form>
      <script>
        var i;
      </script>

      <?php
      $search = '';
      if (!empty($_POST)) {

        $search = $_POST['voice-search'];
      }
      ?>
      <?php
      if ($search) {

        // API key, future ref
        $API_KEY = '';

        // donot delete
        require_once 'vendor/autoload.php';


        $client = new Google_Client();
        $client->setApplicationName("Client_Library_Examples");

        $service = new Google_Service_Books($client);
        //$optParams = array('filter' => 'free-ebooks');
        $results = $service->volumes->listVolumes($search);
      ?>

        <h3>Results Of Call:</h3>
        <?php
        $i = 0;
        foreach ($results as $item) {
          $title[$i] = $item['volumeInfo']['title'];
          echo "Title: " . $title[$i];
          echo "\t";
          $author[$i] = @implode(",", $item['volumeInfo']['authors']);
          echo "Author: " . $author[$i];
          echo "\t";
          $category[$i] = @implode(",", $item['volumeInfo']['categories']);
          echo "Category: " . $category[$i];
          echo "\t";
          $publisher[$i] = $item['volumeInfo']['publisher'];
          echo "Publisher: " . $publisher[$i];
          echo "\t";
          $publishedDate[$i] = $item['volumeInfo']['publishedDate'];
          echo "Published Date: " . $publishedDate[$i] . "<br>";
          //volumeInfo.industryIdentifiers[].type
          $isbn[$i] = "";
          for ($n = 0; $n < count($item['volumeInfo']['industryIdentifiers']); $n++) {
            $isbn[$i] = $isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " ";
          }
          echo "ISBN: " . $isbn[$i] . "<br>";
          $description[$i] = $item['volumeInfo']['description'];
          echo "Description: " . $description[$i] . "<br>";
          $pageCount[$i] = $item['volumeInfo']['pageCount'];
          echo "Page Count: " . $pageCount[$i];
          echo "\t";
          $country[$i] = $item['saleInfo']['country'];
          echo "Country: " . $country[$i];
          echo "\t";
          $currencyCode[$i] = $item['saleInfo']['listPrice']['currencyCode'];
          $amount[$i] = $item['saleInfo']['listPrice']['amount'];
          $money[$i] = $currencyCode[$i] . " " . $amount[$i];

          //Displays amount if available
          if ($money[$i]) {
            echo "Amount: " . $money[$i];
          }

        ?>
          <?php
          $imgLink[$i] = $item['volumeInfo']['imageLinks']['thumbnail'];
          ?>
          <img src="<?= $imgLink[$i] ?>">

          <!-- variables declared without var prefix mean that they are global
          I removed var because of warnings-->
          <script>
            title = <?php echo json_encode($title); ?>
          </script>
          <script>
            author = <?php echo json_encode($author); ?>
          </script>
          <script>
            category = <?php echo json_encode($category); ?>
          </script>
          <script>
            publisher = <?php echo json_encode($publisher); ?>
          </script>
          <script>
            publishedDate = <?php echo json_encode($publishedDate); ?>
          </script>
          <script>
            isbn = <?php echo json_encode($isbn); ?>
          </script>
          <script>
            description = <?php echo json_encode($description); ?>
          </script>
          <script>
            pageCount = <?php echo json_encode($pageCount); ?>
          </script>
          <script>
            money = <?php echo json_encode($money); ?>
          </script>
          <script>
            imgLink = <?php echo json_encode($imgLink); ?>
          </script>

          <button type="submit" class="btn btn-info btn-lg" id="<?= $i; ?>" onclick="autoFill(this.id)">Auto Fill</button>

          <script>
            function autoFill(i) {
              // donot remove the comments in this method if the id isnt predefined in html form

              document.getElementById('title').value = title[i];
              document.getElementById('author').value = author[i];
              document.getElementById('category').value = category[i];
              document.getElementById('publisher').value = publisher[i];
              document.getElementById('publishedDate').value = publishedDate[i];
              document.getElementById('isbn').value = isbn[i];
              document.getElementById('description').value = description[i];
              document.getElementById('pageCount').value = pageCount[i];
              document.getElementById('money').value = money[i];
              if(imgLink[i])
              {
                document.getElementById('imgLink').src = imgLink[i];
                document.getElementById('imgLink').hidden = false;
              }
            }
          </script>



      <?php
          echo "<br>";
          echo "<br>";
          echo "<br>";
          $i++;
        }
      }
      ?>

      
    </div>
  </section>

  <section>
    <div class="container-fluid form " style="height:auto; ">
      <h1 style=" color:#46b5d1;">ADD BOOK</h1>
      <form>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Title</label>
          <div class="col-md-6">
            <input type="text" class="form-control" id="title" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="author" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="isbn" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-6">
            <textarea class="form-control" id="description" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Publisher</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="publisher" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Published Date</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="publishedDate" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Page count</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="pageCount" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Price</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="money" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Image</label>
          <img id="imgLink" alt="your image" width="100" height="100" />
          <input type="file" onchange="document.getElementById('imgLink').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-6">
            <input type="number" class="form-control" id="quantity" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category</label>
          <select class="col-sm-2 col-form-label" id="category" onclick="autoBookId(this.value)">
            <option value="maths">Maths</option>
            <option value="science">Science</option>
            <option value="technology">Technology</option>
            <option value="art">Art</option>
          </select>
          <br><br>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Book ID</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="bookId" placeholder="Example input" value="MAT">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <div class="col-sm-1 addbook">
            <button type="submit" class="btn btn-info btn-lg" onclick="">Add Book</button>
          </div>
        </div>
      </form>
    </div>

    <script>
      function autoBookId(category) {
        switch (category) {
          case "maths":
            document.getElementById('bookId').value = "MAT";
            break;
          case "science":
            document.getElementById('bookId').value = "SCI";
            break;
          case "technology":
            document.getElementById('bookId').value = "TECH";
            break;
          case "art":
            document.getElementById('bookId').value = "ART";
            break;
        }
      }
    </script>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="main.js"></script>


</body>

</html>