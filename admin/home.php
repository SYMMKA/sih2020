<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./assets/css/common.css" />
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container">
      <a class="navbar-brand" href="#">Library Management System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Manage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Shelf</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- landing -->
  <section>
    <div class="container">
      <div class="jumbotron">
        <h1 class="display-5">Welcome to AlphaByte</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <div class="row">
          <div class="col">
            <a class="btn btn-info btn-lg mr-sm-2" href="#" role="button">Docs</a>
            <a class="btn btn-outline-secondary btn-lg" href="#" role="button">Setting</a>
          </div>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-sm-4">
        <div class="col">
          <div class="card btn btn-outline-info h-100" id="card1">
            <div class="card-body text-center  ">
              <h4 class="card-title" id="cardtitle1">Add</h4>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card btn btn-outline-info h-100" id="card2">
            <div class="card-body text-center  ">
              <h4 class="card-title" id="cardtitle2">Manage</h4>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card btn btn-outline-info h-100" id="card3">
            <div class="card-body text-center  ">
              <h4 class="card-title" id="cardtitle3">Shelf</h4>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card btn btn-outline-info h-100" id="card4">
            <div class="card-body text-center  ">
              <h4 class="card-title" id="cardtitle4">Report</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  <script src="./assets/js/common.js"></script>
  <script src="./assets/js/voice-search.js"></script>
  <script>
    $('#card1').mouseenter(function() {

      $('#cardtitle1').addClass('text-white');
    }).mouseleave(function() {
      $('#cardtitle1').removeClass('text-white');
    });
    $('#card2').mouseenter(function() {

      $('#cardtitle2').addClass('text-white');
    }).mouseleave(function() {
      $('#cardtitle2').removeClass('text-white');
    });
    $('#card3').mouseenter(function() {

      $('#cardtitle3').addClass('text-white');
    }).mouseleave(function() {
      $('#cardtitle3').removeClass('text-white');
    });
    $('#card4').mouseenter(function() {

      $('#cardtitle4').addClass('text-white');
    }).mouseleave(function() {
      $('#cardtitle4').removeClass('text-white');
    });
  </script>
</body>

</html>