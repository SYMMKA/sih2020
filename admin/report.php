<?php
include('session.php');
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Manage<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Shelf </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="container landing-section">
    <div class="row h-100">
      <div class="row col-12 align-self-end">
        <div class="col-md-12 col-lg-6 align-self-center">
          <h1 class="display-2 mb-4">GENERATE <br />LIBRARY <br />REPORT</h1>
          <div class="row">
            <button type="button" class="btn btn-info col-7 ml-4 mr-4" onclick="loadDropDowns()" data-toggle="modal" data-target=".bd-example-modal-xl">
              Generate Now
            </button>
          </div>
        </div>
        <div class="col-lg-6 align-self-center d-none d-md-block">
          <img src="https://static-2.gumroad.com/res/gumroad/1211634803146/asset_previews/06c502fdd9bffc8b179bc6f9f46b79dd/retina/drawkit-charts-and-graphs-thumbnail.png" alt="" srcset="" style="width: 100%; height: 35rem;" />
        </div>
      </div>
      <div class="col-12 align-self-end text-center pb-5">
        <button type="button" class="btn btn-outline-dark pl-5 pr-5" hidden>
          <span>
            <i class="fa fa-arrow-down" aria-hidden="true"></i>
          </span>
        </button>
      </div>
    </div>
  </section>
  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="max-width: 90vw;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Report Generation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <h1 class="text-center mt-3 mb-5">Choose Details</h1>
                <form>
                  <div class="row justify-content-center mb-4">
                    <div class="col-sm-6">
                      <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">User</label>
                        <div class="col-sm-9">
                          <select class="custom-select" onchange="changeAccess()">
                            <option selected id="admin" value="admin">Admin</option>
                            <option id="student" value="student">Student</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="container">
                        <div class="form-group row">
                          <label for="bookID" class="col-sm-3 col-form-label">Book ID</label>
                          <div class="col-sm-9">
                            <select class="selectpicker w-100" name="bookID" id="bookID" multiple data-live-search="true" data-actions-box="true">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-4">
                    <div class="col-sm-6" name="adminIDGroup" id="adminIDGroup">
                      <div class="form-group row">
                        <label for="adminID" class="col-sm-3 col-form-label">Admin ID</label>
                        <div class="col-sm-9">
                          <select class="selectpicker w-100" name="adminID" id="adminID" multiple data-live-search="true" data-actions-box="true">
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6" name="studentIDGroup" id="studentIDGroup" hidden>
                      <div class="container">
                        <div class="form-group row">
                          <label for="studentID" class="col-sm-3 col-form-label">Student ID</label>
                          <div class="col-sm-9">
                            <select class="selectpicker w-100" name="studentID" id="studentID" multiple data-live-search="true" data-actions-box="true">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 mb-3 text-center">
                    <div class="col mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="add" id="checkAdd" />
                        <label class="form-check-label" for="checkAdd">
                          Add
                        </label>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="delete" id="checkDelete" />
                        <label class="form-check-label" for="checkDelete">
                          Delete
                        </label>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="update" id="checkUpdate" />
                        <label class="form-check-label" for="checkUpdate">
                          Update
                        </label>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="issue" id="checkIssue" />
                        <label class="form-check-label" for="checkIssue">
                          Issue
                        </label>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="return" id="checkReturn" />
                        <label class="form-check-label" for="checkReturn">
                          Return
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="button" id="report" onclick="generateReport()" class="btn btn-info" data-dismiss="modal">
                      Generate Report
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="container">
       <div id="reportDIV"></div>
    </div>
   
  </section>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  <script src="jsPDF-master/dist/jspdf.min.js"></script>
  <script src="jsPDF-AutoTable-master/dist/jspdf.plugin.autotable.min.js"></script>
  <script src="./assets/js/common.js"></script>
  <script src="report/report.js"></script>
</body>

</html>