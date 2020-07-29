<?php
if (isset($_GET['shelfID'])) {
	$shelfID = $_GET['shelfID'];
}

include("../session.php");
include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
	<link rel="stylesheet" href="../assets/node_modules/shards-ui/dist/css/shards.min.css" />
	<link rel="stylesheet" href="../assets/node_modules/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../assets/css/common.css" />
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
	<section>
		<div class="container pt-4 mb-4" style="margin-top: 10vh;">
			<div class="jumbotron shadow bg-green">
				<div class="row justify-content-center">
					<div class="row col-12 col-lg-8">
						<h2 class="heading font-weight-bold">
							Add Copy
						</h2>
						<p class="lead">
							Add Copies of books to <?= $shelfID ?> by searching books from Library
						</p>
						<div class="col-12 ">
							<form class="row no-gutters" method="post">
								<div class="col-12 col-sm-7 col-md-9">
									<div class="search-form mr-sm-2">
										<input class="form-control mb-2" type="search" name="searchByVoice" id="searchByVoice" placeholder="Search" aria-label="Search" />
									</div>
								</div>
								<div class="col-sm-5 col-md-3 row no-gutters">
									<div class="col-auto">
										<button type="submit" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit">
											search
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-4 d-none d-lg-block">
						<img class="img" src="../assets/FINAL MEDIA/undraw_reading_0re1.svg" alt="" style="
                                    height: auto;
                                    width: 100%;
                                    max-width: 340px;
                                " />
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	$search = '';
	if (isset($_POST['searchByVoice'])) {
		$search = $_POST['searchByVoice'];
		$search = "%$search%";
	?>
		<section class="container">
			<div class="pt-5 mb-5">
				<h1>Your Books<a href="../shelf.php" class="btn btn-blue btn-lg float-right">Back to shelf</a></h1>

			</div>
			<div class="row row-cols-1 row-cols-sm-3 row-cols-lg-6 filter">
				<div class="col mb-4">
					<select class="custom-select" size="1" name="mainCategorySelect1" id="mainCategorySelect1">
						<option value="">-- Category 1--</option>
					</select>
				</div>
				<div class="col mb-4">
					<select class="custom-select" size="1" name="mainCategorySelect2" id="mainCategorySelect2">
						<option value="">-- Category 2--</option>
					</select>
				</div>
				<div class="col mb-4">
					<select class="custom-select" size="1" name="mainCategorySelect3" id="mainCategorySelect3">
						<option value="">-- Category 3--</option>
					</select>
				</div>
				<div class="col mb-4">
					<select class="custom-select" size="1" name="mainCategorySelect4" id="mainCategorySelect4">
						<option value="">-- Category 4--</option>
					</select>
				</div>
				<div class="col mb-4">
					<select class="custom-select" name="book_audio" id="book_audio">
						<option value="">All</option>
						<option value="1">Book</option>
						<option value="0">Audio</option>
					</select>
				</div>
				<div class="col mb-4">
					<select class="custom-select" name="dig_phy" id="dig_phy">
						<option value="">All</option>
						<option value="0">Physical</option>
						<option value="1">Digital</option>
					</select>
				</div>
			</div>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="result">
				<?php
				$sql1 = "SELECT * FROM main Where title LIKE :search";
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':search', $search);
				$stmt1->execute();

				$sql2 = "SELECT AVG(star) AS 'STAR' FROM `issued` WHERE `issued`.`star` IS NOT NULL AND `issued`.`bookID` = :bookID";
				$stmt2 = $conn->prepare($sql2);

				$i = 0;
				while ($row1 = $stmt1->fetchObject()) {
					$bookID[$i] = $row1->bookID;
					$title[$i] = $row1->title;
					$author[$i] = $row1->author;
					$quantity[$i] = $row1->quantity;
					$Category1[$i] = $row1->Category1;
					$Category2[$i] = $row1->Category2;
					$Category3[$i] = $row1->Category3;
					$Category4[$i] = $row1->Category4;
					$publisher[$i] = $row1->publisher;
					$pages[$i] = $row1->pages;
					if ($row1->imgLink == "")
						$imgLink[$i] = "https://placehold.co/200x255";
					else
						$imgLink[$i] = $row1->imgLink;
					$date_of_publication[$i] = $row1->date_of_publication;
					$isbn[$i] = $row1->isbn;
					$digital[$i] = $row1->digital;
					$book[$i] = $row1->book;
					$digitalLink[$i] = $row1->digitalLink;

					$stmt2->bindParam(':bookID', $bookID[$i]);
					$stmt2->execute();
					$row2 = $stmt2->fetchObject();
					$star[$i] = $row2->STAR;

					$conn = null;
				?>
					<div class="col mb-4">
						<div class="card h-100">
							<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="Card image cap" style="height:200px;" />
							<div class=" card-body" style="padding: 1rem;">
								<div class="card-text">
									<div class="row no-gutters">
										<div class="col-4 font-weight-bold">Title:</div>
										<div class="col-8 font-weight-bolder">
											<?= $title[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4 font-weight-bold">Author:</div>
										<div class="col-8 font-weight-bolder">
											<?= $author[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4 font-weight-bold">ISBN:</div>
										<div class="col-8 font-weight-bolder">
											<?= $isbn[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4 font-weight-bold">BookID:</div>
										<div class="col-8 font-weight-bolder">
											<?= $bookID[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4 font-weight-bold">Rating:</div>
										<div class="col-8 font-weight-bolder">
											<?= $star[$i] ?>
										</div>
									</div>
									<input type="hidden" class="Category1" value="<?= $Category1[$i] ?>" />
									<input type="hidden" class="Category2" value="<?= $Category2[$i] ?>" />
									<input type="hidden" class="Category3" value="<?= $Category3[$i] ?>" />
									<input type="hidden" class="Category4" value="<?= $Category4[$i] ?>" />
									<input type="hidden" class="digital" value="<?= $digital[$i] ?>" />
									<input type="hidden" class="book" value="<?= $book[$i] ?>" />
								</div>
							</div>
							<div class="card-footer bg-white">
								<div class="row text-center">
									<div class="col-12">
										<button type="button" class="btn btn-orange" name="add-copy" id="<?= $i; ?>" onclick="addCopyFill(this.id)" data-toggle="modal" data-target="#addCopy">
											Add Copy
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
	<div name="addCopy" id="addCopy" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" id="displayBookCopies" style="max-height:100vh !important; max-width:90vw !important;">
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script src="../assets/node_modules/popper.js/dist/umd/popper-utils.min.js"></script>
		<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
		<script src="../assets/js/common.js"></script>
		<script src="changeCred/changeCred.js"></script>
		<script src="../assets/js/voice-search.js"></script>
		<script src="addCopy/addCopyFill.js"></script>
		<script src="../catName.js"></script>
		<script src="../filter.js"></script>
		<script>
			$(document).ready(function() {
				$("#savePass").on("click", changePass);
			});

			function changePass() {
				password = $("#inputPass1").val();
				password2 = $("#inputPass2").val();
				if (password == password2) {
					$.ajax({
						type: "POST",
						url: "changeCred/account.php",
						data: {
							password: password,
						},
						success: function(data) {
							if (data != "success") alert(data);
							location.reload();
						},
						error: function(data) {
							alert(data);
						},
					});
				} else {
					alert("password not matching");
				}
			}
		</script>
		<script>
			title = <?php echo json_encode($title); ?>;
			author = <?php echo json_encode($author); ?>;
			isbn = <?php echo json_encode($isbn); ?>;
			imgLink = <?php echo json_encode($imgLink); ?>;
			bookID = <?php echo json_encode($bookID); ?>;
			shelfID = <?php echo json_encode($shelfID); ?>;
		</script>

		<script>
			window.onload = function() {
				var mainCategorySelect1 = document.getElementById("mainCategorySelect1");
				var mainCategorySelect2 = document.getElementById("mainCategorySelect2");
				var mainCategorySelect3 = document.getElementById("mainCategorySelect3");
				var mainCategorySelect4 = document.getElementById("mainCategorySelect4");
				$.getJSON("../category.json", function(json) {
					DDCjson = json;
					loadCategory1(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4);
				});
			}
		</script>
</body>

</html>