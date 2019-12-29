<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />



  <link rel="stylesheet" href="style.css" />



  <title>Document</title>

</head>

<body>


  <script>
    function addBook() {
      var data = form.serialize();
      $.post('addQuery.php', data, function(response) {
        alert(response);
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
  <section>
    <div class="container-fluid search" style="height:auto; color:powderblue; padding-bottom: 5rem; ">
      <form id="search-form" method="post">
        <div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
          <div class="col-md-4">
            <label class="sr-only " for="inlineFormInput">Name</label>
            <input type="text" class="form-control mb-2 form-control form-control-lg" id="search-input" placeholder="Book Name" name="voice-search" autocomplete="on" />
            <span id="voice-trigger">
              <svg width="32px" height="32px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="10px" y="10px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
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
          $title[$i] = $item['volumeInfo']['title'];
          $author[$i] = @implode(",", $item['volumeInfo']['authors']);
          $category[$i] = @implode(",", $item['volumeInfo']['categories']);
          $publisher[$i] = $item['volumeInfo']['publisher'];
          $publishedDate[$i] = $item['volumeInfo']['publishedDate'];
          //volumeInfo.industryIdentifiers[].type
          $isbn[$i] = "";
          for ($n = 0; $n < count($item['volumeInfo']['industryIdentifiers']); $n++) {
            $isbn[$i] = $isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " ";
          }
          $description[$i] = $item['volumeInfo']['description'];
          $pageCount[$i] = $item['volumeInfo']['pageCount'];
          $country[$i] = $item['saleInfo']['country'];
          $currencyCode[$i] = $item['saleInfo']['listPrice']['currencyCode'];
          $amount[$i] = $item['saleInfo']['listPrice']['amount'];
          if ($currencyCode[$i] || $amount[$i])
            $money[$i] = $currencyCode[$i] . " " . $amount[$i];
          else
            $money[$i] = NULL;
          $imgLink[$i] = $item['volumeInfo']['imageLinks']['thumbnail'];
        ?>

          <table id="settings" class="table table-bordered table-hover">
            <thead>
              <?php if ($title[$i]) { ?>
                <tr>
                  <th>Title</th>
                  <td><?= $title[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($author[$i]) { ?>
                <tr>
                  <th>Author</th>
                  <td><?= $author[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($category[$i]) { ?>
                <tr>
                  <th>Category</th>
                  <td><?= $category[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($publisher[$i]) { ?>
                <tr>
                  <th>Publisher</th>
                  <td><?= $publisher[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($publishedDate[$i]) { ?>
                <tr>
                  <th>Published Date</th>
                  <td><?= $publishedDate[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($isbn[$i]) { ?>
                <tr>
                  <th>ISBN</th>
                  <td><?= $isbn[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($description[$i]) { ?>
                <tr>
                  <th style="vertical-align: top;">Description</th>
                  <td>
                    <div class="style-2" style="
                    overflow-y: auto;
                    min-height:20px;
                    max-height: 200px;">
                      <?= $description[$i] ?></div>
                  </td>
                </tr>
              <?php } ?>
              <?php if ($pageCount[$i]) { ?>
                <tr>
                  <th>Page Count</th>
                  <td><?= $pageCount[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($country[$i]) { ?>
                <tr>
                  <th>Country</th>
                  <td><?= $country[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($money[$i]) { ?>
                <tr>
                  <th>Amount</th>
                  <td><?= $money[$i] ?></td>
                </tr>
              <?php } ?>
              <?php if ($imgLink[$i]) { ?>
                <tr>
                  <td colspan="2"><img src="<?= $imgLink[$i] ?>"></td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2"><button type="submit" class="btn btn-info btn-lg" id="<?= $i; ?>" onclick="autoFill(this.id)">Auto Fill</button></td>
              </tr>

            </thead>
          </table>
      <?php
          $i++;
        }
      }
      ?>
    </div>

    
  </section>



  <form id="myform">
    <div class="container-fluid form " style="height:auto; ">
      <h1 style=" color:#46b5d1;">ADD BOOK</h1>
      <form>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Title</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="title" id="title" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="author" id="author" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="category" id="category" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-6">
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Publisher</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Published Date</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="publishedDate" id="publishedDate" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Page count</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="pageCount" id="pageCount" placeholder="Example input">
          </div>
        </div>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Price</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="money" id="money" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Image</label>
          <img name="imgLink" id="imgLink" hidden="true" src="" alt="your image" width="100" height="100" />
          <input id="imgFile" type="file" onchange="document.getElementById('imgLink').src = window.URL.createObjectURL(this.files[0]), document.getElementById('imgLink').hidden= false">
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-6">
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Example input">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category1</label>
          <select class="col-sm-2 col-form-label" name="category1" id="category1" onclick="autoBookId(this.value)">
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
            <input type="text" class="form-control" name="bookId" id="bookId" placeholder="Example input" value="MAT">
          </div>
        </div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <div class="col-sm-1 addbook">
            <button type="submit" class="btn btn-info btn-lg" onclick="addBook()">Add Book</button>
          </div>
        </div>
      </form>
    </div>
  </form>

  <script src="https://kit.fontawesome.com/97f3c2998d.js" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:700&display=swap" rel="stylesheet">
  <script src="main.js"></script>
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
        if (imgLink[i]) {
          document.getElementById('imgLink').src = imgLink[i];
          document.getElementById('imgLink').hidden = false;
        }
      }
    </script>

</body>

</html>