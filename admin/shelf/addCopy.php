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
	<title>Add Copy - Shelf</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="./../assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./../assets/node_modules/shards-ui/dist/css/shards.min.css" />
	<!-- <script
      src="https://kit.fontawesome.com/97f3c2998d.js"
      crossorigin="anonymous"
    ></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="./../assets/css/common.css" />
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
						Add books to <?= $shelfID ?>
					</h4>
				</div>

				<form novalidate class="row search-form mb-2 align-self-center justify-content-center" method="post">
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
			<div class="row row-cols-1 row-cols-md-4">
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
					$price[$i] = $row1->price;
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
				?>
					<div class="col mb-4">
						<div class="card h-100">
							<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="Card image cap" style="height: 20vw;" />
							<div class="card-body" style="padding: 1rem;">
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
										<div class="col-4">BookID:</div>
										<div class="col-8">
											<?= $bookID[$i] ?>
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-4">Rating:</div>
										<div class="col-8">
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
										<button type="button" class="btn btn-info" name="add-copy" id="<?= $i; ?>" onclick="addCopyFill(this.id)" data-toggle="modal" data-target="#addCopy">
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
		<script src="./../assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script src="./../assets/node_modules/popper.js/dist/popper.min.js"></script>
		<script src="./../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./../assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
		<script src="./../assets/js/common.js"></script>
		<script src="./../assets/js/voice-search.js"></script>
		<script src="addCopy/addCopyFill.js"></script>
		<script src="../catName.js"></script>
		<script src="../filter.js"></script>

		<script>
			title = <?php echo json_encode($title); ?>;
			author = <?php echo json_encode($author); ?>;
			isbn = <?php echo json_encode($isbn); ?>;
			imgLink = <?php echo json_encode($imgLink); ?>;
			bookID = <?php echo json_encode($bookID); ?>;
			shelfID = <?php echo json_encode($shelfID); ?>;
		</script>

		<script>
			window.onload = function () {
				var mainCategorySelect1 = document.getElementById("mainCategorySelect1");
				var mainCategorySelect2 = document.getElementById("mainCategorySelect2");
				var mainCategorySelect3 = document.getElementById("mainCategorySelect3");
				var mainCategorySelect4 = document.getElementById("mainCategorySelect4");
				$.getJSON("../category.json", function(json){
					DDCjson = json;
					loadCategory1(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4);
				});
			}
		</script>
</body>

</html>