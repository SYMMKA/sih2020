  <?php
	include("session.php");
	?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
  	<title>Shelf</title>
  	<!-- Required meta tags -->
  	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  	<!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  	<link rel="stylesheet" href="assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
  	<link rel="stylesheet" href="assets/node_modules/shards-ui/dist/css/shards.min.css" />
  	<link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
  	<link rel="stylesheet" href="assets/css/common.css" />
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
  	<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
  		<div class="container">
  			<a class="navbar-brand" href="#">Library Management System</a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
  				<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
  					<li class="nav-item active">
  						<a class="nav-link" href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a>
  					</li>
  					<li class="nav-item dropdown active">
  						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  							<i class="fa fa-book" aria-hidden="true"></i>
  						</a>
  						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
  							<a class="dropdown-item" href="manageBooks.php">Manage Books</a>
  							<a class="dropdown-item" href="addBooks.php">Add Books</a>
  							<a class="dropdown-item" href="shelf.php">Shelf</a>
  							<a class="dropdown-item" href="report.php">Report</a>
  							<a class="dropdown-item" href="due.php">Due Page</a>
  							<a class="dropdown-item" href="recommend.php">Syllabus</a>
  						</div>
  					</li>
  					<li class="nav-item active">
  						<a class="nav-link" href="#"><i class="fa fa-comment" aria-hidden="true"></i></a>
  					</li>
  					<li class="nav-item active">
  						<a class="nav-link" href="settings.html"><i class="fa fa-cog" aria-hidden="true"></i></a>
  					</li>
  					<li class="nav-item dropdown active">
  						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  							<i class="fa fa-user-circle" aria-hidden="true"></i>
  						</a>
  						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
  							<a class="dropdown-item" href="#"><?= $adminID ?>
  							</a>
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
  	<section>
  		<div class="container pt-4 mb-4" style="margin-top: 10vh;">
  			<div class="jumbotron shadow bg-green">
  				<div class="row justify-content-center">
  					<div class="row col-12 col-lg-8">
  						<h2 class="heading font-weight-bold">
  							Manage Shelf
  						</h2>
  						<p class="lead">
  							This is a simple hero unit, a simple
  							jumbotron-style component for calling extra
  							attention to featured content or information.
  						</p>
  						<div class="col-12 row no-gutters">
  							<div class="col-12 col-sm-7 col-md-9">
  								<div class="search-form mr-sm-2">
  									<input class="form-control mb-2" type="search" name="searchByVoice" id="searchByVoice" placeholder="Search" aria-label="Search" />
  								</div>
  							</div>
  							<div class="col-sm-5 col-md-3 row no-gutters">
  								<div class="col-auto">
  									<button type="button" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit">
  										search
  									</button>
  								</div>
  								<div class="col-auto">
  									<button type="button" class="btn btn-blue" data-toggle="modal" data-target="#shelf">
  										<i class="fa fa-plus" aria-hidden="true"></i>
  									</button>
  								</div>
  							</div>
  						</div>
						<div id="reader" style="width:500px"></div>
						<div class="col-sm-5 col-md-3">
							<button type="button" value="stop" class="btn btn-orange btn-block" id="qrread">Scan</button>
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
  		<div class="container" id="resultBox"></div>
  	</section>
  	<!-- Shelf Modal-->
  	<div name="shelf" id="shelf" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg" id="displayShelfCopies" style="
                    max-height: 100vh !important;
                    max-width: 90vw !important;
                " />
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title">Add a new shelf</h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<div class="container-fluid">
  					<div class="row justify-content-center">
  						<div class="form-group row col-sm-6">
  							<label for="shelfnamme" class="col-sm-2 col-form-label text-center">Name</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="shelfName" name="shelfName" placeholder="Name of the shelf" required />
  								<div class="invalid-feedback">
  									Required Field
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">
  					Close
  				</button>
  				<button type="button" class="btn btn-info" id="addShelfButton" data-dismiss="modal">
  					Add shelf
  				</button>
  			</div>
  		</div>
  	</div>
  	<!-- Optional JavaScript -->
  	<!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
  	<script>
  		shelfID = [];
  		count = [];
  	</script>
  	<script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
  	<script src="assets/node_modules/popper.js/dist/umd/popper-utils.min.js"></script>
  	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  	<script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  	<script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  	<script src="jsPDF-master/dist/jspdf.min.js"></script>
  	<script src="jsPDF-AutoTable-master/dist/jspdf.plugin.autotable.min.js"></script>
  	<script src="assets/js/common.js"></script>
  	<script src="assets/js/voice-search.js"></script>
  	<script src="shelf/shelfFill.js"></script>
  	<script src="assets/node_modules/html5-qrcode/minified/html5-qrcode.min.js"></script>
  	<script src="qrCodeReader.js"></script>
  </body>

  </html>