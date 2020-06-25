<?php
include("session.php");
include("db.php");
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
		$search = "%$search%";
	?>
		<section class="container">
			<h1 class="text-center p-5">Your Shelves</h1>
			<div class="row row-cols-1 row-cols-md-4">
				<?php
				$sql = "SELECT * FROM main Where title LIKE :search";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':search', $search);
				$stmt->execute();

				$sql1 = "SELECT AVG(star) AS `STAR` FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
				$stmt1 = $conn->prepare($sql1);
				$i = 0;

				while ($row = $stmt->fetchObject()) {
					$imgLink[$i] = $row->imgLink;
					$title[$i] = $row->title;
					$isbn[$i] = $row->isbn;
					$author[$i] = $row->author;
					$bookID[$i] = $row->bookID;


					$stmt1->bindParam(':bookID', $bookID[$i]);
					$stmt1->execute();
					$row1 = $stmt1->fetchObject();
					$star[$i] = $row1->STAR;
				?>
					<div class="col mb-4">
						<div class="card h-100">
							<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="Card image cap" style="height:20vw;" />
							<div class=" card-body">
								<div class="row no-gutters">
									<div class="col-4"><strong>Title:</strong></div>
									<div class="col-8">
										<?= $title[$i] ?>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-4"><Strong>Author:</Strong></div>
									<div class="col-8">
										<?= $author[$i] ?>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-4"><Strong>ISBN:</Strong></div>
									<div class="col-8">
										<?= $isbn[$i] ?>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-4"><Strong>Rating:</Strong></div>
									<div class="col-8">
										<?= $star[$i] ?>
									</div>
								</div>
							</div>
							<div class="card-footer bg-white">
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
		<div class="modal-dialog modal-lg" id="displayBookCopies" style="max-height:100vh !important; max-width:90vw !important;">
			<div class=" modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update Book</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="updateBookForm">
						<div class="row" style="height: 500px; overflow-y: scroll;">
							<div class="col-sm-4">
								<div class="card">
									<img class="card-img-top" src="" type="hidden" id="bookimgLinkUpdate" style="height: 20vw;">
									<div class="card-body ">
										<h4 class="card-title text-center" id="booktitleUpdate"></h4>
										<div class="card-text">
											<div class="row">
												<div class="col-4"><strong></strong></div>
												<div class="col-8"></div>
											</div>
											<div class="row">
												<div class="col-4"><strong>Author:</strong></div>
												<div class="col-8" id="bookauthorUpdate"></div>
											</div>
											<div class="row">
												<div class="col-4"><strong>BookID:</strong></div>
												<div class="col-8" id="bookIDUpdate"></div>
											</div>
											<div class="row">
												<div class="col-4"><strong>ISBN:</strong></div>
												<div class="col-8" id="bookisbnUpdate"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-8">

								<div class="form-group row">
									<label for="updateTitle" class="col-sm-2 col-form-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updateTitle" id="updateTitle" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateAuthor" class="col-sm-2 col-form-label">Author</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updateAuthor" id="updateAuthor" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateISBN" class="col-sm-2 col-form-label">ISBN</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updateISBN" id="updateISBN" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateCategory" class="col-sm-2 col-form-label">Category</label>
									<div class="col-sm-10">
										<button type="button" class="btn btn-info" name="updateCategory" id="updateCategory" onclick="showCategory()">
											click here
										</button>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10" id="category"></div>
								</div>
								<input type="hidden" value="" id="catDisplay" />
								<div class="form-group row">
									<label for="updatepublisher" class="col-sm-2 col-form-label">Publisher</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updatepublisher" id="updatepublisher" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updatepageCount" class="col-sm-2 col-form-label">Page Count</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="updatepageCount" id="updatepageCount" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updatepublishedDate" class="col-sm-2 col-form-label">Publisher Date</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="updatepublishedDate" id="updatepublishedDate" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updatemoney" class="col-sm-2 col-form-label">Price</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updatemoney" id="updatemoney" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateOldID" class="col-sm-2 col-form-label">Old ID</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="updateOldID" id="updateOldID" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateimageFile" class="col-sm-2 col-form-label">Image</label>
									<img name="updateimgLink" id="updateimgLink" hidden="true" src="" alt="your image" width="100px" height="100px" />
									<div class="col-sm-10">
										<input type="file" class="form-control-file" id="updateimgFile" onchange="document.getElementById('updateimgLink').src = window.URL.createObjectURL(this.files[0]), document.getElementById('updateimgLink').hidden= false" />
									</div>
								</div>
								<div class="form-group row">
									<label for="updateaddcopies" class="col-sm-2 col-form-label">Add Copies</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="updateaddcopies" name="updateaddcopies" placeholder="Number of copies" min="0" />
									</div>
								</div>
								<div class="row text-center">
									<div class="col-12">
										<button type="button" class="btn btn-secondary" type="reset" value="Clear">
											clear
										</button>
										<button type="submit" class="btn btn-info" value="update" name="update">Update</button>
									</div>
								</div>

							</div>
						</div>
					</form>
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
		imgLink = <?php echo json_encode($imgLink); ?>;
		bookID = <?php echo json_encode($bookID); ?>;
	</script>
	<script src="searchBook/autoFill.js"></script>
	<script src="searchBook/issueBook/autoFill.js"></script>
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