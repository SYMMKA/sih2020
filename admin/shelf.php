<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
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
    <!-- <script
      src="https://kit.fontawesome.com/97f3c2998d.js"
      crossorigin="anonymous"
    ></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/common.css" />
    <!--Validation-->
    <script type="text/javascript">
        (function() {
            "use strict";
            window.addEventListener(
                "load",
                function() {
                    var form = document.getElementById("addShelf");
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                },
                false
            );
        })();
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Shelf <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container landing-section">
        <div class="row h-100">
            <div class="row col-12 align-self-end">
                <div class="col-6 align-self-center">
                    <h1 class="display-2">MANAGE <br />YOUR <br />SHELF</h1>
                </div>
                <div class="col-6 align-self-center">
                    <img src="https://static-2.gumroad.com/res/gumroad/1211634803146/asset_previews/753a3ff8ae2dce21d417b6c6a574440a/retina/reading-corner-colour-thumbnail.png" alt="" srcset="" style="width: 100%; height: 35rem;" />
                </div>
            </div>
            <div class="col-12 align-self-end text-center pb-5">
                <button type="button" class="btn btn-outline-dark pl-5 pr-5">
                    <span>
                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </div>
    </section>
    <section class="container">
        <h1 class="text-center p-5">Your Shelves</h1>
        <div class="row row-cols-1 row-cols-md-4">
            <?php
            $query = "SELECT * FROM shelf";
            $returnD = mysqli_query($conn, $query);

            $i = 0;

            while ($result = mysqli_fetch_array($returnD)) {
                $shelfID[$i] = $result["shelfID"];

                /* $query1 = "SELECT AVG(star) FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`isbn` = '$isbn[$i]'";
					$returnD1 = mysqli_query($conn, $query1);
					$result1 = mysqli_fetch_array($returnD1);
					$star[$i] = $result1["AVG(star)"]; */
            ?>
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title"><?= $shelfID[$i] ?></h4>
                            <p class="card-text">
                                No. of books
                            </p>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <button type="button" class="btn btn-info btn-block btn-sm" onclick="autoFillShelf('<?= $shelfID[$i] ?>')" data-toggle="modal" data-target="#shelf">
                                        Open Shelf
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </section>
    <section>
        <div class="container mb-5 mt-5 pt-5 pb-5">
            <h1 class="text-center mb-5">Add a new shelf</h1>
            <form id="addShelf" method="post" action="shelf/addShelf.php" novalidate>
                <div class="row justify-content-center mb-4">
                    <div class="form-group row col-sm-6">
                        <label for="shelfnamme" class="col-sm-2 col-form-label text-center">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="shelfName" placeholder="Name of the shelf" required />
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-info">ADD</button>
                        </div>
                        <div class="col-sm-6 text-left">
                            <button type="reset" class="btn btn-info">CLEAR</button>
                        </div>
                    </div>
            </form>
        </div>
    </section>

    <!-- Shelf Modal-->
    <div class="modal fade" name="shelf" id="shelf" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id='displayShelfCopies'></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script src="shelf/shelfFill.js"></script>
 -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="./assets/js/common.js"></script>
</body>

</html>