<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
      <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
      <script src="https://kit.fontawesome.com/97f3c2998d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/home.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container">
        <a class="navbar-brand" href="#">Library Management System</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"
                >Home <span class="sr-only">(current)</span></a
              >
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
    <div class="container">
      <h1 class="display-2 home-text text-center">VOICE IT</h1>
      <div class="text-center mic-box">
        <button id="speech" class="btn">
          <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
          <div class="pulse-ring"></div>
      </div>
    </div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  </body>
</html>