<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Add Books</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
	<!--
       <script
      src="https://kit.fontawesome.com/97f3c2998d.js"
      crossorigin="anonymous"
    ></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="./assets/css/common.css" />
	<!--Validation-->
	<script type="text/javascript">
		(function() {
			"use strict";
			window.addEventListener(
				"load",
				function() {
					var form = document.getElementById("needs-validation");
					form.addEventListener(
						"submit",
						function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add("was-validated");
						},
						false
					);
				},
				false
			);
		})();
	</script>
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
					<li class="nav-item active">
						<a class="nav-link" href="#">Add<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Manage</a>
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
					<h1 class="display-2">SEARCH BOOKS</h1>
					<h4>Find books and material to add to your library</h4>
				</div>

				<form id="needs-validation" novalidate class="row search-form mb-2 align-self-center justify-content-center" method="post">
					<div class="col-sm-6 search-box mb-2">
						<input class="form-control ml-sm-4" type="search" name="search" placeholder="Search" aria-label="Search" title="Required Field" required />
						<div class="invalid-feedback">
							Required Field
						</div>
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
	<section class="container">
		<?php
		$search = '';
		if (isset($_POST['search']))
			$search = $_POST['search'];
		?>


		<?php
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
					$isbn[$i] = "";
					if (isset($item['volumeInfo']['industryIdentifiers'])) {
						for ($n = 0; $n < count($item['volumeInfo']['industryIdentifiers']); $n++) {
							$isbn[$i] = $isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " ";
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
									<?php if ($imgLink[$i]) { ?>
										<img src="<?= $imgLink[$i] ?>" class="card-img" alt="..." style="max-height: 300px; width: 100%" />
									<?php } ?>

								</div>
								<div class="col-md-6">
									<div class="card-body">
										<h5 class="card-title">
											<?php echo $title[$i] ? "Author: " . $title[$i] : null ?>
										</h5>
										<P><?php echo isset($author[$i]) ? "Author: " . $author[$i] : null ?>
											<?php echo isset($category[$i]) ? "<br>Category: " . $category[$i] : null ?>
											<?php echo isset($publisher[$i]) ? "<br>Publisher: " . $publisher[$i] : null ?>
											<?php echo isset($publishedDate[$i]) ? "<br>Published Date: " . $publishedDate[$i] : null ?>
											<?php echo $isbn[$i] ? "<br>ISBN: " . $isbn[$i] : null ?>
											<?php echo isset($pageCount[$i]) ? "<br>Page Count: " . $pageCount[$i] : null ?>
											<?php echo isset($country[$i]) ? "<br>Country: " . $country[$i] : null ?>
											<?php echo isset($money[$i]) ? "<br>Amount: " . $money[$i] : null ?></P>

									</div>
								</div>
								<div class="col-md-2 align-self-center justify-content-center p-3">
									<button type="button" class="btn btn-info btn-block mb-4" id="<?= $i; ?>" onclick="autoFill(this.id)">
										Add
									</button>

									<button type="button" class="btn btn-info btn-block" onclick="window.open('<?= $preview[$i] ?>', '_blank')">
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
	<section>
		<div class="container mb-5 mt-5 pt-5 pb-5">
			<h1 class="text-center mb-5">Details</h1>
			<form id="addBookForm" novalidate>
				<fieldset class="form-group">
					<div class="row">
						<legend class="col-form-label col-sm-2 pt-0">Radios</legend>
						<div class="col-sm-10">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked />
								<label class="form-check-label" for="gridRadios1">
									First radio
								</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" />
								<label class="form-check-label" for="gridRadios2">
									Second radio
								</label>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row justify-content-center mb-4">
					<div class="col-md-8">
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" id="title" required />
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
								<input type="text" class="form-control" name="isbn" id="isbn" required />
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
							<label for="" class="col-sm-2 col-form-label">Old ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="oldID" id="oldID" />
								<div class="invalid-feedback">
									Required Field
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">DDC No.</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="testDDC" id="testDDC" />
								<div class="invalid-feedback">
									Required Field
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">Cover Image</label>
							<div class="col-sm-10">
								<img name="imgLink" id="imgLink" hidden="true" src="" alt="your image" width="100" height="100" />
								<input type="file" class="form-control-file" id="imgFile" onchange="document.getElementById('imgLink').src = window.URL.createObjectURL(this.files[0]), document.getElementById('imgValue').value = '', document.getElementById('imgLink').hidden= false" />
								<input type="hidden" name="imgValue" id="imgValue" value="" />
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">1</label>
							<div class="col-sm-10">
								<select class="form-control" size="1" name="mainCategorySelect1" id="mainCategorySelect1" required>
									<option value="">-- Select Category--</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">2</label>
							<div class="col-sm-10">
								<select class="form-control" size="1" name="mainCategorySelect2" id="mainCategorySelect2" required>
									<option value="">-- Select Category--</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">3</label>
							<div class="col-sm-10">
								<select class="form-control" size="1" name="mainCategorySelect3" id="mainCategorySelect3" required>
									<option value="">-- Select Category--</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">4</label>
							<div class="col-sm-10">
								<select class="form-control" size="1" name="mainCategorySelect4" id="mainCategorySelect4" required>
									<option value="">-- Select Category--</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">Price</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="money" id="money" />
								<div class="invalid-feedback">
									Must be a non negative number
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">Page Count</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="pageCount" id="pageCount" placeholder="" min="0" />
								<div class="invalid-feedback">
									Must be a non negative number
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-2 col-form-label">Quantity</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" name="quantity" id="quantity" placeholder="" min="1" required />
								<div class="invalid-feedback">
									Must be a positive number
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-sm-6 text-right">
							<button type="submit" value="Add Book" name="addBook" class="btn btn-info">ADD</button>
						</div>
						<div class="col-sm-6 text-left">
							<button type="reset" class="btn btn-info">CLEAR</button>
						</div>
					</div>
				</div>
			</form>
			<!--Validation-->
			<script type="text/javascript">
				(function() {
					"use strict";
					window.addEventListener(
						"load",
						function() {
							var form = document.getElementById("addBookForm");
							form.addEventListener(
								"submit",
								function(event) {
									if (form.checkValidity() === false) {
										event.preventDefault();
										event.stopPropagation();
									}
									form.classList.add("was-validated");
								},
								false
							);
						},
						false
					);
				})();
			</script>
		</div>
	</section>

	<!-- variables declared without var are global
          I removed var because of warnings-->
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

	<script src="category.js"></script>
	<script src="catName.js"></script>
	<script src="addBook/autoFill.js"></script>
	<script src="addBook/autoDDC.js"></script>
	<script src="addBook/uploadDB.js"></script>

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