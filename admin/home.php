<?php
include("session.php");
if (isset($_SESSION['AccessError'])) {
	echo "<script type='text/javascript'>
            alert('" . $_SESSION['AccessError'] . "');
          </script>";
	//to not make the error message appear again after refresh:
	unset($_SESSION['AccessError']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Home</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
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
			<strong>Buddy</strong>
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
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-green fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Library Management System</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">

				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="home.php">
							<div class="d-flex">
								<i class="fa fa-home mr-3 mr-lg-0" aria-hidden="true"></i>
								<h6 class="d-block d-lg-none mb-0">Home</h6>
							</div>
						</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="d-flex">
								<i class="fa fa-book mr-3 mr-lg-0" aria-hidden="true"></i>
								<h6 class="d-block d-lg-none mb-0">Library</h6>
							</div>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="manageBooks.php">Manage Books</a>
							<a class="dropdown-item" href="addBooks.php">Add Books</a>
							<a class="dropdown-item" href="shelf.php">Shelf</a>
							<a class="dropdown-item" href="record.php">Record</a>
							<a class="dropdown-item" href="syllabus.php">Syllabus</a>
						</div>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="chatroom.php">
							<div class="d-flex">
								<i class="fa fa-comment mr-3 mr-lg-0" aria-hidden="true"></i>
								<h6 class="d-block d-lg-none mb-0">Chatroom</h6>
							</div>
						</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="settings.php">
							<div class="d-flex">
								<i class="fa fa-cog mr-3 mr-lg-0" aria-hidden="true"></i>
								<h6 class="d-block d-lg-none mb-0">Settings</h6>
							</div>
						</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="d-flex">
								<i class="fa fa-user-circle mr-3 mr-lg-0" aria-hidden="true"></i>
								<h6 class="d-block d-lg-none mb-0">My Profile</h6>
							</div>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
	<!-- landing -->
	<section>
		<div class="landing-section bg-green">
			<div class="container h-100 pb-5">
				<div class="row h-100 align-items-center pb-5">
					<div class="col-12 col-lg-7">
						<h1 class="display-5">Hi <?= $adminID ?>! </h1>
						<hr class="my-4">
						<h1 class="display-3 font-weight-bold heading">AlphaByte</h1>
						<p class="lead">Let's start this new day with our new way of library management.</p>
						<div class="row">
							<div class="col">
								<a class="btn btn-orange btn-lg mr-sm-2" href="#" role="button"><i class="fa fa-question mr-2" aria-hidden="true"></i>Read Docs</a>
								<a class="btn btn-blue btn-lg" href="#" role="button"><i class="fa fa-cog mr-2" aria-hidden="true"></i> Settings</a>
							</div>
						</div>
					</div>
					<div class="col-5 d-none d-lg-block">
						<img src="assets/FINAL MEDIA/undraw_voice_control_ofo1.svg" alt="" style="max-height: 360px; width: 100%;">
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
	<script src="assets/js/common.js"></script>
	<script src="assets/js/voice-search.js"></script>
	<script src="home/navigation.js"></script>
	<script src="assets/js/assistant.js"></script>
	<script src="changeCred/changeCred.js"></script>
</body>

</html>