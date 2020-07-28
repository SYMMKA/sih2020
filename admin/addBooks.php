<?php
include("session.php");
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
							<a class="dropdown-item" href="record.php">Record</a>
							<a class="dropdown-item" href="syllabus.php">Syllabus</a>
						</div>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="chatroom.php"><i class="fa fa-comment" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user-circle" aria-hidden="true"></i>
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
	<!-- main section -->
	<section>
		<div class="container pt-4 mb-4" style="margin-top: 10vh;">
			<div class="jumbotron shadow bg-green">
				<div class="row justify-content-center">
					<div class="row col-12 col-lg-8">
						<h2 class="heading font-weight-bold">
							Add Assets
						</h2>
						<p class="lead">
							Find books and material to add to your library here.
						</p>
						<div class="col-12">
							<form class="row row no-gutters" method="post" action="addBooks.php">
								<div class="col-12 col-sm-7 col-md-9">
									<div class="search-form mr-sm-2">
										<input class="form-control mb-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
									</div>
								</div>
								<div class="col-sm-5 col-md-3 row no-gutters">
									<div class="col-auto">
										<button type="submit" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit" required>
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
		<?php

		$search = '';
		if (isset($_POST['search']))
			$search = $_POST['search'];


		if ($search) {

			// API key, future ref
			$API_KEY = '';

			// donot delete
			require_once 'vendor/autoload.php';


			$client = new Google_Client();
			$client->setApplicationName("Client_Library_Examples");

			$service = new Google_Service_Books($client);
			//$optParams = array('filter' => 'free-ebooks');
			$results = $service->volumes->listVolumes($search);
		?>
			<h1 class="text-center p-5">Showing Results for '<?= $search ?>'</h1>
			<div class="row row-cols-1">

				<?php
				$i = 0;
				foreach ($results as $item) {
					if (isset($item['volumeInfo']['title']))
						$title[$i] = $item['volumeInfo']['title'];
					if (isset($item['volumeInfo']['authors']))
						$author[$i] = @implode(",", $item['volumeInfo']['authors']); //implode for array of strings
					if (isset($item['volumeInfo']['categories']))
						$category[$i] = @implode(",", $item['volumeInfo']['categories']); //implode for array of strings
					if (isset($item['volumeInfo']['publisher']))
						$publisher[$i] = $item['volumeInfo']['publisher'];
					if (isset($item['volumeInfo']['publishedDate']))
						$publishedDate[$i] = $item['volumeInfo']['publishedDate'];
					//volumeInfo.industryIdentifiers[].type
					//$isbn[$i] = "";
					$isbn13Found = 0;
					if (isset($item['volumeInfo']['industryIdentifiers'])) {
						for ($n = 0; $n < count($item['volumeInfo']['industryIdentifiers']); $n++) {
							if ($item['volumeInfo']['industryIdentifiers'][$n]['type'] == 'ISBN_13') {
								$isbn[$i] = $item['volumeInfo']['industryIdentifiers'][$n]['identifier'];
								$isbn13Found = 1;
								break;
							}
							//$isbn[$i] = $isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " ";
						}
						// if isbn 13 not found
						if ($isbn13Found == 0) {
							$isbn[$i] = $item['volumeInfo']['industryIdentifiers'][0]['identifier'];
						}
					}
					$pageCount[$i] = $item['volumeInfo']['pageCount'];
					if (isset($item['saleInfo']['country']))
						$country[$i] = $item['saleInfo']['country'];
					if (isset($item['saleInfo']['listPrice']['currencyCode']))
						$currencyCode[$i] = $item['saleInfo']['listPrice']['currencyCode'];
					if (isset($item['saleInfo']['listPrice']['amount']))
						$amount[$i] = $item['saleInfo']['listPrice']['amount'];
					if (isset($currencyCode[$i]) || isset($amount[$i]))
						$money[$i] = $currencyCode[$i] . " " . $amount[$i];
					else
						$money[$i] = NULL;
					if (isset($item['volumeInfo']['imageLinks']['thumbnail']))
						$imgLink[$i] = $item['volumeInfo']['imageLinks']['thumbnail'];
					if (isset($item['accessInfo']['webReaderLink']))
						$preview[$i] = $item['accessInfo']['webReaderLink'];
				?>

					<div class="col">
						<div class="card mb-3 ml-auto mr-auto" style="max-width: 950px;">
							<div class="row no-gutters">
								<div class="col-md-4">
									<?php if (isset($imgLink[$i])) { ?>
										<img src="<?= $imgLink[$i] ?>" class="card-img" alt="..." style="max-height: 300px; width: 100%" />
									<?php } ?>

								</div>
								<div class="col-md-6">
									<div class="card-body">
										<h5 class="card-title">
											<?php echo $title[$i] ? "Title: " . $title[$i] : null ?>
										</h5>
										<P><?php echo isset($author[$i]) ? "Author: " . $author[$i] : null ?>
											<?php echo isset($category[$i]) ? "<br>Category: " . $category[$i] : null ?>
											<?php echo isset($publisher[$i]) ? "<br>Publisher: " . $publisher[$i] : null ?>
											<?php echo isset($publishedDate[$i]) ? "<br>Published Date: " . $publishedDate[$i] : null ?>
											<?php echo isset($isbn[$i]) ? "<br>ISBN: " . $isbn[$i] : null ?>
											<?php echo isset($pageCount[$i]) ? "<br>Page Count: " . $pageCount[$i] : null ?>
											<?php echo isset($country[$i]) ? "<br>Country: " . $country[$i] : null ?>
											<?php echo isset($money[$i]) ? "<br>Amount: " . $money[$i] : null ?></P>

									</div>
								</div>
								<div class="col-md-2 align-self-center justify-content-center p-3">
									<button type="button" data-toggle="modal" data-target=".bd-example-modal-xl" class="btn btn-orange btn-block mb-4" id="<?= $i; ?>" onclick="autoFill(this.id)">
										Add
									</button>

									<button type="button" class="btn btn-blue btn-block" onclick="window.open('<?= $preview[$i] ?>', '_blank')">
										Preview
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php
					$i++;
				}
				?>
			</div>
		<?php
		}
		?>

	</section>

	<!-- add book form modal -->
	<div class="modal fade bd-example-modal-xl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document" style="max-height:100vh !important; max-width:90vw !important;">
			<div class="modal-content">
				<form id="addBookForm" novalidate>
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
										<label for="" class="col-sm-2 col-form-label">Upload File</label>
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
						<button type="button" value="Add Book" id="submitAddBookForm" name="addBook" class="btn btn-orange" data-dismiss="modal">Add Book</button>
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
		title = <?php echo json_encode($title); ?>;
		author = <?php echo json_encode($author); ?>;
		category = <?php echo json_encode($category); ?>;
		publisher = <?php echo json_encode($publisher); ?>;
		publishedDate = <?php echo json_encode($publishedDate); ?>;
		isbn = <?php echo json_encode($isbn); ?>;
		pageCount = <?php echo json_encode($pageCount); ?>;
		money = <?php echo json_encode($money); ?>;
		imgLink = <?php echo json_encode($imgLink); ?>;
		preview = <?php echo json_encode($preview); ?>;
	</script>

	<script src="catName.js"></script>
	<script src="addBook/autoFill.js"></script>
	<script src="addBook/mediaType.js"></script>
	<script src="autoDDC.js"></script>
	<script src="addBook/uploadDB.js"></script>
	<script src="addBook/navigation.js"></script>
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