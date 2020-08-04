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
  	<link rel="stylesheet" href="assets/css/chat.css" />

  </head>

  <body>
  	<!-- chatbot code here -->
  	<div id="chat-circle" class="btn btn-raised">
  		<div id="chat-overlay"></div>
  		<i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
  	</div>
  	<div class="chat-box">
  		<div class="chat-box-header">
  			<strong>AlphaBot</strong>
  			<span class="chat-box-toggle">
  				<i class="fa fa-close" title="close" style="margin-top: -12px;"></i>
  			</span>
  			<span class="chat-header-refresh" id="refresh"><i class="fa fa-refresh" title="startover"></i></span>
  		</div>
  		<div class="chat-box-body">
  			<div class="chat-box-overlay"></div>
  			<div class="chat-logs"></div>
  		</div>
  		<div id="loading" style="position: fixed; bottom: 60px; margin-top: 30px; margin-left: 10px">
  			<div class="spinner-border" role="status">
  				<span class="sr-only">Loading...</span>
  			</div>
  		</div>
  		<div class="chat-input">
  			<form id="chatBotForm">
  				<input type="text" id="chat-input" autofocus placeholder="Send a question or response..." />
  				<button type="submit" class="chat-submit" id="chat-submit">
  					<span id="micSpan">
  						<i class="fa fa-microphone" style="color: black;" id="mic"></i>
  						<!-- <i class="material-icons">send</i> -->
  					</span>
  				</button>
  			</form>
  		</div>
  	</div>
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
  	<!-- change password -->
  	<div class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="changePassword">
  		<div class="modal-dialog modal-lg" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Change Password</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">&times;</span>
  					</button>
  				</div>
  				<div class="modal-body">
  					<div class="container">
  						<div class="form-group row">
  							<label for="inputPass1" class="col-sm-3 col-form-label">New Password</label>
  							<div class="col-sm-9">
  								<input type="password" class="form-control" id="inputPass1" required>
  							</div>
  						</div>
  						<div class="form-group row">
  							<label for="inputPass2" class="col-sm-3 col-form-label">Confirm Password</label>
  							<div class="col-sm-9">
  								<input type="password" class="form-control" id="inputPass2" required>
  							</div>
  						</div>
  					</div>
  				</div>
  				<div class="modal-footer">
  					<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
  					<button type="button" class="btn btn-orange" data-dismiss="modal" id="savePass">Save changes</button>
  				</div>
  			</div>
  		</div>
  	</div>
  	<section>
  		<div class="container pt-4 mb-4" style="margin-top: 10vh;">
  			<div class="jumbotron shadow bg-green">
  				<div class="row justify-content-center">
  					<div class="row col-12 col-lg-8">
  						<h2 class="heading font-weight-bold">
  							Shelves
  						</h2>
  						<p class="lead">
  							Create, update and manage all your shelves here.
  						</p>
  						<div class="col-12 row no-gutters">
  							<div class="col-12 col-sm-7 col-md-8">
  								<div class="search-form mr-sm-2">
  									<input class="form-control mb-2" type="search" name="searchByVoice" id="searchByVoice" placeholder="Search" aria-label="Search" />
  									<div id="reader"></div>
  								</div>
  							</div>
  							<div class="col-sm-5 col-md-4 row no-gutters">
  								<div class="col-auto">
  									<button type="button" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit">
  										search
  									</button>
  								</div>
  								<div class="col-auto">
  									<button type="button" class="btn btn-blue mr-2 mb-2" data-toggle="modal" data-target="#shelf">
  										<i class="fa fa-plus" aria-hidden="true"></i>
  									</button>
  								</div>
  								<div class="col-auto">
  									<button type="button" value="stop" class="btn btn-success mb-2" id="qrread">
  										<i class="fa fa-qrcode" aria-hidden="true"></i>
  									</button>
  								</div>
  							</div>
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
  	<script src="changeCred/changeCred.js"></script>
  	<script src="assets/js/voice-search.js"></script>
  	<script src="shelf/navigation.js"></script>
  	<script src="assets/js/assistant.js"></script>
  	<script src="shelf/shelfFill.js"></script>
  	<script src="assets/node_modules/html5-qrcode/minified/html5-qrcode.min.js"></script>
  	<script src="qrCodeReader.js"></script>
  </body>

  </html>