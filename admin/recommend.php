<?php
include("session.php");
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Recommended</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
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
      <div class="col-12 align-self-end">
        <div class="mb-4 text-center">
          <h1 class="display-2">RECOMMENDED BOOKS</h1>
          <h4>Official Reference Books</h4>
        </div>
        <div class="row">
          <div class="col-12">
            <form class="row justify-content-center">
              <div class="input-group" style="max-width: 540px;">
                <div class="form-group col">
                  <select class="selectpicker w-100" name="branch" id="branch" data-live-search="true">
                    <option value=''>All</option>
                  </select>
                </div>
                <div class="form-group col">
                  <select class="selectpicker w-100" name="semester" id="semester" data-live-search="true">
                    <option value=''>All</option>
                  </select>
                </div>
                <div class="form-group col">
                  <button type="button" data-toggle="modal" data-target="#add" id="addNewSemBranch" class="btn btn-info">Add Sem/Branch</button>
                </div>
                <div class="form-group col">
                  <button type="button" data-toggle="modal" data-target="#delete" id="deleteSemBranch" class="btn btn-info">Delete Sem/Branch</button>
                </div>
              </div>
            </form>
          </div>
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


  <div name="add" id="add" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modalinput" style="max-height:100vh !important; max-width:90vw !important;">
      <div class="modal-content">
        <form id="addnew" novalidate>
          <div class="modal-header">
            <h5 class="modal-title">Add a new Sem Branch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="form-group row col-sm-6">
                  <label for="shelfnamme" class="col-sm-2 col-form-label text-center">Sem</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="semesterModal" name="semesterModal" placeholder="Semester" required />
                    <div class="invalid-feedback">
                      Required Field
                    </div>
                  </div>
                </div>
                <div class="form-group row col-sm-6">
                  <label for="shelfnamme" class="col-sm-2 col-form-label text-center">Branch</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="branchModal" name="branchModal" placeholder="Branch" required />
                    <div class="invalid-feedback">
                      Required Field
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="addSemBranch(); location.reload(true);" class="btn btn-info">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div name="delete" id="delete" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modalinput" style="max-height:100vh !important; max-width:90vw !important;">
      <div class="modal-content">
        <form id="deleteSem_branch" novalidate>
          <div class="modal-header">
            <h5 class="modal-title">Delete a Sem Branch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="form-group row col-sm-6">
                  <label for="shelfnamme" class="col-sm-2 col-form-label text-center">Sem</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="semesterModalDelete" name="semesterModalDelete" placeholder="Semester" required />
                    <div class="invalid-feedback">
                      Required Field
                    </div>
                  </div>
                </div>
                <div class="form-group row col-sm-6">
                  <label for="shelfnamme" class="col-sm-2 col-form-label text-center">Branch</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="branchModalDelete" name="branchModalDelete" placeholder="Branch" required />
                    <div class="invalid-feedback">
                      Required Field
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="deleteSemBranch(); location.reload(true);" class="btn btn-info">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <section class="container landing-section">
    <div id="bookCards"></div>
    <div id="addnewbook" hidden>
      <div class="col mb-4">
        <h5>Add Book in Sem/Branch</h5>

        <h5> Enter BookID</h5>
        <div class="col-sm-9">
          <select class="selectpicker w-100" data-live-search="true" name="bookID" id="bookID">
            <option value=''>All</option>
          </select>
        </div>
        <button type="button" id="addthebook" class="btn btn-info" name="">Add Book</button>
      </div>
    </div>
  </section>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  <script src="./assets/js/common.js"></script>
  <script src="recommend/recom.js"></script>
</body>

</html>