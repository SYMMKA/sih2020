<?php
include("session.php");
?>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
    <!-- <script
    src="https://kit.fontawesome.com/97f3c2998d.js"
    crossorigin="anonymous"
  ></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/common.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">LIBRARY MANAGEMENT SYSTEM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php" data-toggle="tooltip" data-placement="bottom" title="Home">
                            <div class="d-flex">
                                <i class="fa fa-home mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Home</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Library">
                            <div class="d-flex">
                                <i class="fa fa-book mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Library</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="manageBooks.php" title="Manage Books">Manage Books</a>
                            <a class="dropdown-item" href="addBooks.php" title="Add Books">Add Books</a>
                            <a class="dropdown-item" href="shelf.php" title="Shelf">Shelf</a>
                            <a class="dropdown-item" href="record.php" title="Records">Records</a>
                            <a class="dropdown-item" href="syllabus.php" title="Syllabus">Syllabus</a>
                            <a class="dropdown-item" href="achievement.php" title="achievements">Achievements</a>
                            <a class="dropdown-item" href="request.html" title="Book Requests">Book Requests</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="docs.html" data-toggle="tooltip" data-placement="bottom" title="Read Docs">
                            <div class="d-flex">
                                <i class="fa fa-question mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Read Docs</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="chatroom.php" data-toggle="tooltip" data-placement="bottom" title="Chatroom">
                            <div class="d-flex">
                                <i class="fa fa-comment mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Chatroom</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="settings.php" data-toggle="tooltip" data-placement="bottom" title="Settings">
                            <div class="d-flex">
                                <i class="fa fa-cog mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Settings</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown  active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" title="Profile" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex">
                                <i class="fa fa-user-circle mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">My Profile</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font-weight-bold" href="#"><?= $adminID ?> </a>
                            <div class="dropdown-divider"></div>
                            <a class="btn dropdown-item" data-toggle="modal" data-target="#changePassword">Change password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><button class="btn btn-danger btn-block">Logout</button></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class="container pt-4 mb-4" style="margin-top: 10vh;">
            <div class="jumbotron shadow bg-green pt-4 pb-2">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading font-weight-bold mb-4">
                            Achievements
                        </h2>
                        <p class="lead">
                            Lets see who is at the top of the Points table
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="achievementData">
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="./assets/js/common.js"></script>
    <script src="achievement/getPoints.js"></script>
</body>

</html>