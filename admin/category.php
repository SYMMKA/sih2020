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

  <form>
    <div class="container-fluid form " style="height:100vm; ">
      <h1 style=" color:#46b5d1;">ADD Category</h1>
      <form>
        <div class="form-group row align-items-center justify-content-center ">
          <label for="" class="col-sm-2 col-form-label">Category</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="category" id="category" placeholder="Example input" required>
          </div>
        </div>
        <div class="alert">The book has been added</div>
        <div class="form-group form-row align-items-center justify-content-center ">
          <div class="col-sm-1">
            <button type="submit" class="btn btn-info btn-lg" id="addCategory" name="addCategory" onclick="test()">Add Category</button>
          </div>
        </div>
      </form>
    </div>
  </form>

  <script>
    function test()
    {
      var category = docuement.getElementById('category').value;
      console.log(category);
    }
    
    function display() {
      // Show alert
      document.querySelector('.alert').style.display = 'block';

      // Hide alert after 1.5 seconds
      setTimeout(function() {
        document.querySelector('.alert').style.display = 'none';
      }, 1500);

      // Clear form
      document.getElementById('addCategory').reset();

    }
  </script>

  <script src="https://kit.fontawesome.com/97f3c2998d.js" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:700&display=swap" rel="stylesheet">



  <script src="main.js"></script>

</body>

</html>