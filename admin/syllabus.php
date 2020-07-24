<!DOCTYPE html>
<html lang="en">

<head>
  <title>Syllabus</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./assets/css/common.css" />
  <style>
    .btn-orange {
      background-color: #fe4a49;
      color: #fff;
    }

    .btn-orange:hover {
      background-color: #b13333;
      color: #fff;
    }

    .btn-blue {
      background-color: #001b58;
      color: #fff;
    }

    .btn-blue:hover {
      background-color: #001546;
      color: #fff;
    }

    .jumbotron {
      background-color: #4ad7d1;
    }

    .text-orange {
      color: #fe4a49;
    }

    .card {
      min-height: 200px;
      min-width: 200px;
      margin-right: 15px;
    }
  </style>
</head>

<body>
  <button type="button" class="btn btn-orange voice-button" style="
                width: 60px;
                height: 60px;
                border-radius: 50%;
                position: fixed;
                bottom: 2rem;
                right: 1.5rem;
                cursor: pointer;
                box-shadow: 0px 2px 5px #666;
                z-index: 9999;
            ">
    <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
  </button>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Library Management System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-book fa-2x" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-comment fa-2x" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item dropdown active">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Amit Ramani</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Change username</a>
              <a class="dropdown-item" href="#">Change password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><button class="btn btn-danger btn-block">
                  Logout
                </button></a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- landing -->
  <section>
    <div class="container pt-4 mb-4" style="margin-top: 10vh;">
      <div class="jumbotron shadow">
        <div class="row justify-content-center">
          <div class="row col-12 col-sm-8">
            <h2 class="display-4 font-weight-bold">
              Syllabus
            </h2>
            <p class="lead">
              This is a simple hero unit, a simple
              jumbotron-style component for calling extra
              attention to featured content or information.
            </p>
            <div class="col-12">
              <select class="selectpicker mb-2" id="branch" title="Branch" data-style="btn-blue">
              </select>
              <select class="selectpicker mb-2" id="semester" title="Sem" data-style="btn-blue">
              </select>
              <button type="button" class="btn btn-orange mb-2" data-toggle="modal" data-target="#addNewSemBranch"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>

          </div>
          <div class="col-sm-4 d-none d-lg-block">
            <img class="img" src="assets/FINAL MEDIA/undraw_reading_0re1.svg" alt="" style="
                                    height: auto;
                                    width: 100%;
                                    max-width: 340px;
                                " />
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container" id="syllabusDiv">
    </div>
  </section>

  <!-- Modal for books -->
  <div class="modal fade" id="modelForBooks" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" style="
                    max-height: 100vh !important;
                    max-width: 90vw !important;
                ">
      <div class="modal-content" id="modalBodyContent">
      </div>
      </div>
    </div>
  </div>
  <!-- Modal for new sem branch -->
  <div class="modal fade" id="addNewSemBranch" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" style="
                    max-height: 100vh !important;
                    max-width: 90vw !important;
                ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="form-group row">
              <label for="newBranch" class="col-sm-4">Branch</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="branchModal" placeholder="Add a new Branch">
              </div>
            </div>
            <div class="form-group row">
              <label for="newSem" class="col-sm-4">Semester</label>
              <div class="col-sm-8">
                <input type="number" min="1" class="form-control" id="semesterModal" placeholder="Add a new Semester">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-orange" onclick="addSemBranch()" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  <script src="./assets/js/common.js"></script>
  <script src="./assets/js/voice-search.js"></script>
  <script src="syllabus/recom.js"></script>
  <script src="syllabus/recom2.js"></script>
</body>

</html>