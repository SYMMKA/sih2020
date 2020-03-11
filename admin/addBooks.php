<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Add Books</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="../assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>

</head>

<body class="is-preload">


	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<a href="../index.php" class="logo"><strong>Library Management System</strong> <span>by Neon Genesis</span></a>
			<nav>
				<a href="#menu">Menu</a>
			</nav>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<ul class="links">
				<li><a href="../index.php">Home</a></li>
				<li><a href="searchBooks.php">Search Books</a></li>
				<li><a href="searchBooks.php">Issue Books</a></li>
				<li><a href="return.php">Return Books</a></li>
			</ul>
			<ul class="actions stacked">
				<li><a href="#" class="button primary fit">Get Started</a></li>
				<li><a href="#" class="button fit">Log In</a></li>
			</ul>
		</nav>


		<!-- Main -->
		<div id="main" class="alt">

			<!-- One -->
			<section id="one">
				<div class="inner">
					<header class="major">
						<h1>Add Books</h1>
					</header>


				</div>
			</section>

		</div>

		<!-- Contact -->
		<section id="contact">
			<div class="inner">
				<section>
					<form id="addBookForm">
						<div class="fields">
							<div class="field">
								<label for="title">Title</label>
								<input type="text" name="title" id="title" required />
							</div>
							<div class="field half">
								<label for="author">Author</label>
								<input type="text" name="author" id="author" />
							</div>
							<div class="field half">
								<label for="category">Category</label>
								<input type="text" name="category" id="category" />
							</div>

							<div class="field half" id="mainCat1">
								<select size="1" name="mainCategorySelect1" id="mainCategorySelect1" class="mainCategorySelect1" required />
								<option value="">-- Select Category--</option>
								</select>
							</div>
							<div class="field half" id="mainCat2">
								<select size="1" name="mainCategorySelect2" id="mainCategorySelect2" class="mainCategorySelect2" required />
								<option value="">-- Select Category--</option>
								</select>
							</div>
							<div class="field half" id="mainCat3">
								<select size="1" name="mainCategorySelect3" id="mainCategorySelect3" class="mainCategorySelect3" required />
								<option value="">-- Select Category--</option>
								</select>
							</div>
							<div class="field half" id="mainCat4">
								<select size="1" name="mainCategorySelect4" id="mainCategorySelect4" class="mainCategorySelect4" required />
								<option value="">-- Select Sub-Category --</option>
								</select>
							</div>

							<div class="field half">
								<label for="isbn">ISBN</label>
								<input type="text" name="isbn" id="isbn" />
							</div>
							<div class="field half">
								<label for="publisher">Publisher</label>
								<input type="text" name="publisher" id="publisher" />
							</div>
							<div class="field half">
								<label for="pageCount">Page Count</label>
								<input type="number" name="pageCount" id="pageCount" />
							</div>
							<div class="field half">
								<label for="publishedDate">Published Date</label>
								<input type="text" name="publishedDate" id="publishedDate" />
							</div>
							<div class="field half">
								<label for="money">Price</label>
								<input type="text" name="money" id="money" />
							</div>

							<div class="field half">
								<label for="oldID">Old ID</label>
								<input type="text" name="oldID" id="oldID" />
							</div>
							<div class="field half">
								<label for="quantity">Quantity</label>
								<input type="number" name="quantity" id="quantity" required />
							</div>
							<div class="field half">
								<label for="testDDC">testDDC</label>
								<input type="text" name="testDDC" id="testDDC" />
							</div>
							<div class="field">
								<label for="image">Image</label>
								<img name="imgLink" id="imgLink" hidden="true" src="" alt="your image" width="100" height="100" />
								<input id="imgFile" type="file" onchange="document.getElementById('imgLink').src = document.getElementById('imgValue').value = window.URL.createObjectURL(this.files[0]), document.getElementById('imgLink').hidden= false">
								<input type="hidden" name="imgValue" id="imgValue" value="" />
							</div>
							<div class="alert">
								<label>The book has been added</label>
							</div>
						</div>
						<ul class="actions">
							<li><input type="submit" value="Add Book" name="addBook" class="primary" /></li>
							<li><input type="reset" value="Clear" /></li>
						</ul>
					</form>
				</section>
				<section class="split">
					<section>
						<div class="container-fluid search" style="height:auto; color:powderblue; padding-bottom: 5rem; ">
							<form id="search-form" method="post">
								<div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
									<div class="col-md-4">
										<label class="sr-only " for="inlineFormInput">Name</label>
										<input type="text" class="form-control mb-2 form-control form-control-lg" id="search-input" placeholder="Book Name" name="voice-search" autocomplete="on" />
										<span id="voice-trigger">
											<svg width="32px" height="32px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="10px" y="10px" viewBox="0 10 58 58" style=" overflow: visible;" xml:space="preserve">
												<g>
													<path d="M44,28c-0.552,0-1,0.447-1,1v6c0,7.72-6.28,14-14,14s-14-6.28-14-14v-6c0-0.553-0.448-1-1-1s-1,0.447-1,1v6   c0,8.485,6.644,15.429,15,15.949V56h-5c-0.552,0-1,0.447-1,1s0.448,1,1,1h12c0.552,0,1-0.447,1-1s-0.448-1-1-1h-5v-5.051   c8.356-0.52,15-7.465,15-15.949v-6C45,28.447,44.552,28,44,28z" />
													<path d="M29,46c6.065,0,11-4.935,11-11V11c0-6.065-4.935-11-11-11S18,4.935,18,11v24C18,41.065,22.935,46,29,46z M20,11   c0-4.963,4.038-9,9-9s9,4.037,9,9v24c0,4.963-4.038,9-9,9s-9-4.037-9-9V11z" />
												</g>
											</svg>
										</span>
										</fieldset>
									</div>
									</br>

									<div class="col-auto">
										<button type="submit" class="btn btn-info mb-2 btn-lg" style="width: 130px;" value="submit">
											Search
										</button>
									</div>
								</div>
							</form>

							<?php
							$search = '';
							if (isset($_POST['voice-search'])) {

								$search = $_POST['voice-search'];
							}
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

								<h3>Results Of Call:</h3>
								<?php
								$i = 0;
								foreach ($results as $item) {
									$title[$i] = $item['volumeInfo']['title'];
									$author[$i] = @implode(",", $item['volumeInfo']['authors']); //implode for array of strings
									$category[$i] = @implode(",", $item['volumeInfo']['categories']); //implode for array of strings
									$publisher[$i] = $item['volumeInfo']['publisher'];
									$publishedDate[$i] = $item['volumeInfo']['publishedDate'];
									//volumeInfo.industryIdentifiers[].type
									$isbn[$i] = "";
									for ($n = 0; $n < count($item['volumeInfo']['industryIdentifiers']); $n++) {
										$isbn[$i] = $isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " ";
									}
									$pageCount[$i] = $item['volumeInfo']['pageCount'];
									$country[$i] = $item['saleInfo']['country'];
									$currencyCode[$i] = $item['saleInfo']['listPrice']['currencyCode'];
									$amount[$i] = $item['saleInfo']['listPrice']['amount'];
									if ($currencyCode[$i] || $amount[$i])
										$money[$i] = $currencyCode[$i] . " " . $amount[$i];
									else
										$money[$i] = NULL;
									$imgLink[$i] = $item['volumeInfo']['imageLinks']['thumbnail'];
									$preview[$i] = $item['accessInfo']['webReaderLink'];
								?>



									<table id="settings" class="table table-bordered table-hover">
										<thead>
											<?php if ($title[$i]) { ?>
												<tr>
													<th>Title</th>
													<td><?= $title[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($author[$i]) { ?>
												<tr>
													<th>Author</th>
													<td><?= $author[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($category[$i]) { ?>
												<tr>
													<th>Category</th>
													<td><?= $category[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($publisher[$i]) { ?>
												<tr>
													<th>Publisher</th>
													<td><?= $publisher[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($publishedDate[$i]) { ?>
												<tr>
													<th>Published Date</th>
													<td><?= $publishedDate[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($isbn[$i]) { ?>
												<tr>
													<th>ISBN</th>
													<td><?= $isbn[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($pageCount[$i]) { ?>
												<tr>
													<th>Page Count</th>
													<td><?= $pageCount[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($country[$i]) { ?>
												<tr>
													<th>Country</th>
													<td><?= $country[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($money[$i]) { ?>
												<tr>
													<th>Amount</th>
													<td><?= $money[$i] ?></td>
												</tr>
											<?php } ?>
											<?php if ($imgLink[$i]) { ?>
												<tr>
													<td colspan="2"><img src="<?= $imgLink[$i] ?>"></td>
												</tr>
											<?php } ?>
											<?php if ($imgLink[$i]) { ?>
												<tr>
													<td colspan="2"><button onclick="window.open('<?= $preview[$i] ?>', '_blank')" class="btn btn-primary">Preview</button></td>
												</tr>
											<?php } ?>
											<tr>
												<td colspan="2"><button class="btn btn-info btn-lg" id="<?= $i; ?>" onclick="autoFill(this.id)">Auto Fill</button></td>
											</tr>

										</thead>
									</table>
							<?php
									$i++;
								}
							}
							?>
						</div>
					</section>

				</section>
			</div>
		</section>
	</div>

	<!-- Scripts -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.scrolly.min.js"></script>
	<script src="../assets/js/jquery.scrollex.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="addBook/category.js"></script>
	<script src="addBook/catName.js"></script>
	<script src="main.js"></script>

	<!-- variables declared without var are global
          I removed var because of warnings-->
	<script>
		title = <?php echo json_encode($title); ?>
	</script>
	<script>
		author = <?php echo json_encode($author); ?>
	</script>
	<script>
		category = <?php echo json_encode($category); ?>
	</script>
	<script>
		publisher = <?php echo json_encode($publisher); ?>
	</script>
	<script>
		publishedDate = <?php echo json_encode($publishedDate); ?>
	</script>
	<script>
		isbn = <?php echo json_encode($isbn); ?>
	</script>
	<script>
		pageCount = <?php echo json_encode($pageCount); ?>
	</script>
	<script>
		money = <?php echo json_encode($money); ?>
	</script>
	<script>
		imgLink = <?php echo json_encode($imgLink); ?>
	</script>
	<script>
		preview = <?php echo json_encode($preview); ?>
	</script>
	<script>
		function autoFill(i) {
			// donot remove the comments in this method if the id isnt predefined in html form

			document.getElementById('title').value = title[i];
			document.getElementById('author').value = author[i];
			document.getElementById('category').value = category[i];
			document.getElementById('publisher').value = publisher[i];
			document.getElementById('publishedDate').value = publishedDate[i];
			document.getElementById('isbn').value = isbn[i];
			document.getElementById('pageCount').value = pageCount[i];
			document.getElementById('money').value = money[i];
			if (imgLink[i]) {
				document.getElementById('imgLink').src = imgLink[i];
				document.getElementById('imgValue').value = imgLink[i];
				document.getElementById('imgLink').hidden = false;
			}
		}
	</script>

	<script>
		// To select category
		window.onload = function() {

			var mainCategorySelect1 = document.getElementById("mainCategorySelect1");
			var mainCategorySelect2 = document.getElementById("mainCategorySelect2");
			var mainCategorySelect3 = document.getElementById("mainCategorySelect3");
			var mainCategorySelect4 = document.getElementById("mainCategorySelect4");
			//Load main categories
			for (var mainCategory = 0; mainCategory < test.length; mainCategory++) {
				mainCategorySelect1.options[mainCategorySelect1.options.length] = new Option(test[mainCategory].description, mainCategory);
			}

			//Main Category1 Changed
			mainCategorySelect1.onchange = function() {

				mainCategorySelect2.length = 1; // remove all options bar first
				mainCategorySelect3.length = 1; // remove all options bar first
				mainCategorySelect4.length = 1; // remove all options bar first
				if (this.selectedIndex < 1) {
					document.getElementById('mainCategorySelect2').hidden = true;
					document.getElementById('mainCategorySelect3').hidden = true;
					document.getElementById('mainCategorySelect4').hidden = true;

					return; // done
				}


				if (!test[this.value].subordinates) { // hides sub category if not available

					document.getElementById('mainCategorySelect2').disabled = true;
					document.getElementById('mainCategorySelect3').disabled = true;
					document.getElementById('mainCategorySelect4').disabled = true;
					var categoryID = test[mainCategorySelect1.value].number;
					var test1 = document.getElementById('title').value;
				} else {

					document.getElementById('mainCategorySelect2').disabled = false;
					document.getElementById('mainCategorySelect3').disabled = false;
					document.getElementById('mainCategorySelect4').disabled = false;

					c1();
				}
			}
			//Main Category2 Changed
			mainCategorySelect2.onchange = function() {
				mainCategorySelect3.length = 1; // remove all options bar first
				mainCategorySelect4.length = 1; // remove all options bar first
				if (this.selectedIndex < 1) {
					document.getElementById('mainCategorySelect3').hidden = true;
					document.getElementById('mainCategorySelect4').hidden = true;

					return; // done
				}


				if (!test[mainCategorySelect1.value].subordinates[this.value].subordinates) { // hides sub category if not available

					document.getElementById('mainCategorySelect3').disabled = true;
					document.getElementById('mainCategorySelect4').disabled = true;
					var categoryID = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].number;
					var test1 = document.getElementById('title').value;
				} else {

					document.getElementById('mainCategorySelect3').disabled = false;
					document.getElementById('mainCategorySelect4').disabled = false;

					c2();
				}
			}
			//Main Category3 Changed
			mainCategorySelect3.onchange = function() {

				
				mainCategorySelect4.length = 1; // remove all options bar first

				if (this.selectedIndex < 1) {
					document.getElementById('mainCategorySelect4').hidden = true;

					return; // done
				}


				if (!test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[this.value].subordinates) { // hides sub category if not available

					document.getElementById('mainCategorySelect4').disabled = true;
					var categoryID = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].number;
					var test1 = document.getElementById('title').value;
				} else {

					document.getElementById('mainCategorySelect4').disabled = false;

					c3();
				}
			}

			mainCategorySelect4.onchange = function() {

				var categoryID = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates[mainCategorySelect4.value].number;
				var test1 = document.getElementById('title').value;
			}

			//testDDC
		var testDDC1 = document.getElementById('testDDC');
		testDDC1.onchange = function() {

			var testDDC = document.getElementById('testDDC').value;

			var d1 = Math.floor(testDDC/100);
			document.getElementById("mainCategorySelect1").value= d1;
			mainCategorySelect2.length = 1; // remove all options bar first
			mainCategorySelect3.length = 1; // remove all options bar first
			mainCategorySelect4.length = 1; // remove all options bar first
			c1();

			var d2 = Math.floor((testDDC % 100) / 10);
			document.getElementById("mainCategorySelect2").value= d2;
			mainCategorySelect3.length = 1; // remove all options bar first
			mainCategorySelect4.length = 1; // remove all options bar first
			c2();

			var d3 = Math.floor(testDDC % 10);
			document.getElementById("mainCategorySelect3").value= d3;
			mainCategorySelect4.length = 1; // remove all options bar first
			c3();

			var d4 = Math.floor(((testDDC % 1) / .1)+0.5);
			document.getElementById("mainCategorySelect4").value= d4;
		}
		}
	</script>

	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.scrolly.min.js"></script>
	<script src="../assets/js/jquery.scrollex.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="addBook/fireDB.js"></script>
	<script src="../assets/js/main.js"></script>

</body>

</html>
