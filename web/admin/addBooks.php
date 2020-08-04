<?php
include("session.php");
use GuzzleHttp\Exception\GuzzleException;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Add Books</title>
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
	<style>
		.card {
			background-color: #F6F4F2;
		}

		.modal-content {
			background-color: #001730;
			color: white;
		}

		.modal-title {
			background-color: #001730;
			color: white;
		}

		.form-control,
		.form-control:focus,
		.custom-file-label {
			background-color: #001730;
			color: white;
		}

		#search {
			background-color: #fff;
			color: black;
		}
	</style>
</head>

<body>
	<!-- chatbot code here -->
	<div id="chat-circle" class="btn btn-raised">
		<div id="chat-overlay"></div>
		<i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
	</div>
	<div class="chat-box">
		<div class="chat-box-header">
			<strong class="font-weight-bold">AlphaBot</strong>
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
						<i class="" style="color: black;" id="mic"></i>
						<!-- <i class="material-icons">send</i> -->
					</span>
				</button>
			</form>
		</div>
	</div>
	<!-- navbar -->
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
	<!-- main section -->
	<section>
		<div class="container pt-4 mb-4" style="margin-top: 10vh;">
			<div class="jumbotron shadow bg-green">
				<div class="row justify-content-center">
					<div class="row col-12 col-lg-8">
						<h2 class="heading font-weight-bold">
							Add Books
						</h2>
						<p class="lead">
							Find books and material to add to your library here.
						</p>
						<div class="col-12">
							<form class="row row no-gutters" method="post" action="addBooks.php?chat">
								<div class="col-12 col-sm-7 col-md-9">
									<div class="search-form mr-sm-2">
										<input class="form-control mb-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
									</div>
								</div>
								<div class="col-sm-5 col-md-3 row no-gutters">
									<div class="col-auto">
										<button type="button" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit" required>
											search
										</button>
									</div>
									<div class="col-auto">
										<button type="button" class="btn btn-blue" data-toggle="modal" data-target=".bd-example-modal-xl" id="addBooksModal">
											<i class="fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							</form>
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
	<section class="container" id="searchResults">
			
	</section>

	<!-- add book form modal -->
	<div class="modal fade bd-example-modal-xl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document" style="max-height:100vh !important; max-width:90vw !important;">
			<div class="modal-content">
				<form id="addBookForm">
					<div class="modal-header">
						<h5 class="modal-title">Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="addForm">
						<div class="container-fluid">
							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-sm-2 pt-0">Books/Audio</legend>
									<div class="col-sm-4" id="book_audio">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="book_audio" id="book" value="book" checked />
											<label class="form-check-label" for="book">
												Book
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="book_audio" id="audio" value="audio" />
											<label class="form-check-label" for="audio">
												Audio
											</label>
										</div>
									</div>
									<legend class="col-form-label col-sm-2 pt-0">Digital/Physical</legend>
									<div class="col-sm-4" id="physical_digital">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="physical_digital" id="physical" value="physical" checked />
											<label class="form-check-label" for="physical">
												Physical
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="physical_digital" id="digital" value="digital" />
											<label class="form-check-label" for="digital">
												Digital
											</label>
										</div>
									</div>
								</div>
							</fieldset>
							<div class="row justify-content-center">
								<div class="col-md-7">
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Title</label>
										<div class="col-sm-10">
											<input type="text" class="form-control DDC" name="title" id="title" required />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Author</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="author" id="author" />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">ISBN</label>
										<div class="col-sm-10">
											<input type="text" class="form-control DDC" name="isbn" id="isbn" />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Publisher</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="publisher" id="publisher" />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Publisher Date</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="publishedDate" id="publishedDate" />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">DDC No.</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="ddcNO" id="ddcNO" />
											<div class="invalid-feedback">
												Required Field
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Source</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="source">
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Cover Image</label>
										<div class="col-sm-10">
											<img name="imgLink" class="mb-2" id="imgLink" hidden="true" src="" alt="your image" width="100" height="100" />
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="imgFile">
												<label class="custom-file-label" for="imgFile">Choose file</label>
											</div>
											<input type="hidden" name="imgValue" id="imgValue" value="" />
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-2 col-form-label">Upload Bill</label>
										<div class="col-sm-10">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="receiptFile">
												<label class="custom-file-label" for="receiptFile">Choose file</label>
											</div>
											<div class="invalid-feedback">
												Import File
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Category 1</label>
										<div class="col-sm-9">
											<select class="form-control" size="1" name="mainCategorySelect1" id="mainCategorySelect1" required>
												<option value="">-- Select Category--</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Category 2</label>
										<div class="col-sm-9">
											<select class="form-control" size="1" name="mainCategorySelect2" id="mainCategorySelect2" required>
												<option value="">-- Select Category--</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Category 3</label>
										<div class="col-sm-9">
											<select class="form-control" size="1" name="mainCategorySelect3" id="mainCategorySelect3" required>
												<option value="">-- Select Category--</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Category 4</label>
										<div class="col-sm-9">
											<select class="form-control" size="1" name="mainCategorySelect4" id="mainCategorySelect4" required>
												<option value="">-- Select Category--</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Price</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="money" id="money" />
											<div class="invalid-feedback">
												Must be a non negative number
											</div>
										</div>
									</div>
									<div class="form-group row" id="pageCountGroup">
										<label for="" class="col-sm-3 col-form-label">Page Count</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="pageCount" id="pageCount" placeholder="" min="0" />
											<div class="invalid-feedback">
												Must be a non negative number
											</div>
										</div>
									</div>
									<div class="form-group row" id="quantityGroup">
										<label for="" class="col-sm-3 col-form-label">Quantity</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="quantity" id="quantity" placeholder="" min="1" required />
											<div class="invalid-feedback">
												Must be a positive number
											</div>
										</div>
									</div>
									<div class="form-group row" id="mediaGroup" hidden>
										<label for="" class="col-sm-3 col-form-label">Upload File</label>
										<div class="col-sm-9">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="mediaFile">
												<label class="custom-file-label" for="mediaFile">Choose file</label>
											</div>
											<div class="invalid-feedback">
												Import File
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-3 col-form-label">Date of purchase</label>
										<div class="col-sm-9">
											<input class="form-control" type="datetime-local" id="dop" name="dop">
										</div>
									</div>
								</div>
							</div>
							<div id="copyInfo">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
						<button type="submit" value="Add Book" id="submitAddBookForm" name="addBook" class="btn btn-orange">Add Book</button>
					</div>
				</form>
				<form id="qrForm" method="post" action="genQR.php" target="_blank">
					<input type="hidden" id="typeQR" name="typeQR" />
					<input type="hidden" id="qrIDs" name="qrIDs" />
				</form>
			</div>
		</div>
	</div>
	<div id="QRdiv">
		<canvas id="QR"></canvas>
		<div id="QRpdf"></div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
	<script src="assets/node_modules/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
	<script src="assets/js/common.js"></script>
	<script src="changeCred/changeCred.js"></script>
	<script src="assets/js/voice-search.js"></script>

	<script>
		var title = [];
		var author = [];
		var category = [];
		var publisher = [];
		var publishedDate = [];
		var isbn = [];
		var pageCount = [];
		var money = [];
		var imgLink = [];
		var preview = [];
		var lastID = [];
		var cacheData = {};
		var length = 0;
		var chat = 0;
	</script>

	<script src="catName.js"></script>
	<script src="addBook/autoFill.js"></script>
	<script src="addBook/mediaType.js"></script>
	<script src="autoDDC.js"></script>
	<script src="addBook/uploadDB.js"></script>
	<script src="addBook/navigation.js"></script>
	<script src="addBook/googleBook.js"></script>
	<script src="assets/js/assistant.js"></script>
		
	<?php	
	if (isset($_GET['q'])) {
		$searchq = $_GET['q'];
		echo "<script>
				document.getElementById('search').value = '" . $searchq . "';
				document.getElementById('voiceSearchSubmit').click();
			</script>";
	}
	?>
</body>

</html>