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
	<title>Manage Books</title>
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
			<div class="col-12 align-self-end">
				<div class="mb-4 text-center">
					<h1 class="display-2">SEARCH FROM LIBRARY</h1>
					<h4>
						Issue, return, modify and delete books in your library
					</h4>
				</div>

				<form class="row search-form mb-2 align-self-center justify-content-center" method="post" novalidate>
					<div class="col-sm-6 search-box mb-2">
						<input class="form-control ml-sm-4" type="search" name="search" placeholder="Search" aria-label="Search" />
					</div>
					<div class="col-sm-6 col-md-2">
						<button class="btn btn-info btn-block ml-sm-2" type="submit">
							Search
						</button>
					</div>
				</form>
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
	<?php
	$search = '';
	if (isset($_POST['search'])) {
		$search = $_POST['search'];
	?>
		<section class="container">
			<h1 class="text-center p-5">Your Shelves</h1>
			<div class="row row-cols-1 row-cols-md-4">
				<?php
				$query = "SELECT * FROM main Where title LIKE '%$search%'";
				$returnD = mysqli_query($conn, $query);

				$i = 0;

				while ($result = mysqli_fetch_array($returnD)) {
					$imgLink[$i] = $result["imgLink"];
					$title[$i] = $result["title"];
					$isbn[$i] = $result["isbn"];
					$author[$i] = $result["author"];

					$query1 = "SELECT AVG(star) FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`isbn` = '$isbn[$i]'";
					$returnD1 = mysqli_query($conn, $query1);
					$result1 = mysqli_fetch_array($returnD1);
					$star[$i] = $result1["AVG(star)"];
				?>
					<div class="col mb-4">
						<div class="card">
							<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="Card image cap" />
							<div class="card-body">
								<div class="card-text">
									<div class="row no-gutters">
										<div class="col-4">Title:</div>
										<div class="col-8">
											<?= $title[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4">Author:</div>
										<div class="col-8">
											<?= $author[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4">ISBN:</div>
										<div class="col-8">
											<?= $isbn[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4">Rating:</div>
										<div class="col-8">
											<?= $star[$i] ?>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-12">
										<button type="button" class="btn btn-info btn-block btn-sm" name="issue-book" id="<?= $i; ?>" onclick="autoFillBook(this.id)" data-toggle="modal" data-target="#displayCopy">
											Issue/Return Delete Copy
										</button>
										<button type="button" class="btn btn-info btn-block btn-sm" name="update-book" id="<?= $i; ?>" onclick="autoFillUpdateBook(this.id)" data-toggle="modal" data-target="#updateBookForm">
											Update
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
	<?php
	}
	?>

	<!-- display Copy Modal-->
	<div name="displayCopy" id="displayCopy" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" id="displayBookCopies" style="max-height:100vh !important; max-width:90vw !important;">
		</div>
		<form id="issueBookForm">
		</form>
		<form id="returnBookForm">
			<div id='returnBookFormDiv'></div>
		</form>
		<form id="deleteCopyForm">
			<div id='deleteCopyFormDiv'></div>
		</form>
	</div>

	<!-- update Modal-->
	<div name="updateBookForm" id="updateBookForm" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="class="modal-dialog modal-lg" id="displayBookCopies" style="max-height:100vh !important; max-width:90vw !important;"">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update Book</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="fields">
						<form id="updateBookForm">
							<div class="field half" style="text-align: center;">
								<label>Title: </label>
								<label id="booktitleUpdate"></label>
							</div>
							<div class="field half" style="text-align: center;">
								<label>Author: </label>
								<label id="bookauthorUpdate"></label>
							</div>
							<div class="field half" style="text-align: center;">
								<label>ISBN: </label>
								<label id="bookisbnUpdate"></label>
							</div>
							<div class="field half" style="text-align: center;">
								<img src="" type="hidden" id="bookimgLinkUpdate">
							</div>

							<div class="field">
								<label>Change Title</label>
								<input type="text" name="updateTitle" id="updateTitle" placeholder="Name" />
							</div>
							<br />
							<div class="field">
								<label>Change Author</label>
								<input type="text" name="updateAuthor" id="updateAuthor" placeholder="Email address" />
							</div>
							<br />
							<div class="field">
								<button name="updateCategory" id="updateCategory" onclick="showCategory()">Change Category</button>
							</div>
							<div id="category"></div>
							<input type="hidden" value="" id="catDisplay" />
							<br />
							<div class="field half">
								<label for="publisher">Publisher</label>
								<input type="text" name="updatepublisher" id="updatepublisher" />
							</div>
							<br />
							<div class="field half">
								<label for="pageCount">Page Count</label>
								<input type="number" name="updatepageCount" id="updatepageCount" />
							</div>
							<br />
							<div class="field half">
								<label for="publishedDate">Published Date</label>
								<input type="text" name="updatepublishedDate" id="updatepublishedDate" />
							</div>
							<br />
							<div class="field half">
								<label for="money">Price</label>
								<input type="text" name="updatemoney" id="updatemoney" />
							</div>
							<br />
							<div class="field half">
								<label for="updateOldID">Old ID</label>
								<input type="text" name="updateOldID" id="updateOldID" />
							</div>
							<br />
							<div class="field">
								<label for="updateimage">Image</label>
								<img name="updateimgLink" id="updateimgLink" hidden="true" src="" alt="your image" width="100" height="100" />
								<input id="updateimgFile" type="file" onchange="document.getElementById('updateimgLink').src = window.URL.createObjectURL(this.files[0]), document.getElementById('updateimgLink').hidden= false">
							</div>
							<br />
							<div class="field">
								<label>Add copies</label>
								<input type="number" name="updateaddcopies" id="updateaddcopies">
							</div>
							<br />

							<ul class="actions">
								<li><input type="submit" value="update" name="update" class="primary" /></li>
								<li><input type="reset" value="Clear" /></li>
							</ul>

							</br>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Understood</button>
				</div>
			</div>
		</div>
	</div>

	<script src="category.js"></script>
	<script src="catName.js"></script>
	<script>
		title = <?php echo json_encode($title); ?>;
		author = <?php echo json_encode($author); ?>;
		isbn = <?php echo json_encode($isbn); ?>;
		imgLink = <?php echo json_encode($imgLink); ?>
	</script>
	<script src="searchBook/autoFill.js"></script>
	<script src="searchBook/issueBook/autoFill.js"></script>
	<script src="searchBook/returnBook/autoFill.js"></script>
	<script src="searchBook/updateBook/autoFill.js"></script>
	<script src="searchBook/deleteCopy/autoFill.js"></script>

	<script src="searchBook/issueBook/uploadDB.js"></script>
	<script src="searchBook/returnBook/uploadDB.js"></script>
	<script src="searchBook/updateBook/uploadDB.js"></script>
	<script src="searchBook/deleteCopy/uploadDB.js"></script>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
	<script src="./assets/js/common.js"></script>
	<script src="./assets/js/voice-search.js"></script>
</body>

</html>