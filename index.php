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
    <div class="container-fluid form ">
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
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Image</label>
          <div class="col-sm-6">
            <input type="file" class="form-control-file" id="image">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">

          <label for="" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-6">
            <input type="number" class="form-control" id="quantity" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <div class="col-sm-1 addbook">
            <button type="submit" class="btn btn-info btn-lg" onclick="addBook()">Add Book</button>
          </div>
        </div>
      </form>
    </div>
    <?php
    function addBook()
    {
    }
    ?>


  </section>
  <section>
    <div class="container-fluid search" style="background-color:powderblue;">
      <form id="search-form" method="post">
        <div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
          <!--<div class="col-auto">

            <div class="btn-group">
              <button type="button " class="form-control btn btn-default btn-lg dropdown-toggle mb-2" data-toggle="dropdown">Search Type<span class="caret"></span>
              </button>
              <ul class="dropdown-menu " role="menu">
                <li>Title</li>
                <li>Author</li>
                <li>ISBN</li>
                <li>Genre</li>
              </ul>
            </div>

          </div>
          drop-down menu for search type i.e. "Title", "Author"-->
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
          $title = $item['volumeInfo']['title'];
          echo "Title: " . $title;
          echo "\t";
          $author = @implode(",", $item['volumeInfo']['authors']);
          echo "Author: " . $author;
          echo "\t";
          $publisher = $item['volumeInfo']['publisher'];
          echo "Publisher: " . $publisher;
          echo "\t";
          $publishedDate = $item['volumeInfo']['publishedDate'];
          echo "Published Date: " . $publishedDate . "<br>";
          $description = $item['volumeInfo']['description'];
          echo "Description: " . $description . "<br>";
          $pageCount = $item['volumeInfo']['pageCount'];
          echo "Page Count: " . $pageCount;
          echo "\t";
          $country = $item['saleInfo']['country'];
          echo "Country: " . $country;
          echo "\t";
          $currencyCode = $item['saleInfo']['listPrice']['currencyCode'];
          $amount = $item['saleInfo']['listPrice']['amount'];

          //Displays amount if available
          if ($currencyCode || $amount) {
            echo "Amount: " . $currencyCode;
            echo "\t";
            echo $amount;
          }
        ?>
          <?php
          $imgLink = $item['volumeInfo']['imageLinks']['thumbnail'];
          ?>
          <img src="<?= $imgLink ?>">
          <p id="demo"></p>
          <script> var i = "<?= $i; ?>"; 
          document.getElementById("demo").innerHTML = i; </script>
          <button type="submit" class="btn btn-info btn-lg" onclick="autoFill(this.name)">Auto Fill</button>
          <script>
            var title = [];
            var author = [];
            title = "<?= $title; ?>";
            author = "<?= $author; ?>";
            var description = "<?= $description; ?>";
          
            function autoFill(i) {
              
              document.getElementById('title').value = title;
              
              document.getElementById('author').value = author;
              
              document.getElementById('description').value = description;
            }
          </script>



      <?php
          echo "<br>";
          echo "<br>";
          echo "<br>";
          $i++;
          echo "ID".$i;
        }
      }
      ?>

    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="main.js"></script>

</body>

</html>