<?php
//DB CONNECTION====================================
$servername = "remotemysql.com";
$username = "2qTzr9mwEz";
$password = "u931TbHEs5";
$database = "2qTzr9mwEz";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['addBook'])) {
	if ($_POST['title'])
		$title2 = $_POST['title'];
	else
		$title2 = NULL;
	if ($_POST['author'])
		$author2 = $_POST['author'];
	else
		$author2 = NULL;
	//if ($_POST['mainCategorySelect'])
	//$category2 = $_POST['mainCategorySelect'];
	//else
	$category2 = NULL;
	if ($_POST['publisher'])
		$publisher2 = $_POST['publisher'];
	else
		$publisher2 = NULL;
	if ($_POST['publishedDate'])
		$date_of_publication2 = $_POST['publishedDate'];
	else
		$date_of_publication2 = NULL;
	if ($_POST['isbn'])
		$isbn2 = $_POST['isbn'];
	else
		$isbn2 = NULL;
	if ($_POST['pageCount'])
		$pageCount2 = $_POST['pageCount'];
	else
		$pageCount2 = NULL;
	if ($_POST['money'])
		$money2 = $_POST['money'];
	else
		$money2 = NULL;
	if ($_POST['quantity'])
		$quantity2 = $_POST['quantity'];
	else
		$quantity2 = '1';
	if ($_POST['imgValue'])
		$imgValue2 = $_POST['imgValue'] . "&printsec=frontcover&img=1&zoom=1&source=gbs_api";
	else
		$imgValue2 = NULL;
	$issued = 0;
	//if ($_POST['subCategorySelect'])
	//$subCategory = $_POST['subCategorySelect'];
	//else
	$subCategory = NULL;
	//Dont add `id` column
	$sql = "INSERT INTO `books` (`title`, `author`, `category`, `subCategory`, `publisher`, `pages`, `price`, `quantity`, `imgLink`, `date_of_publication`, `isbn`, `issued`) VALUES ('$title2', '$author2', '$category2', '$subCategory', '$publisher2', '$pageCount2', '$money2', '$quantity2', '$imgValue2', '$date_of_publication2', '$isbn2', '$issued')";
	if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>
	<script>
	</script>
<?php

}
?>


<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Search Books</title>
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
			<a href="index.html" class="logo"><strong>Library Management System</strong> <span>by Neon Genesis</span></a>
			<nav>
				<a href="#menu">Menu</a>
			</nav>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<ul class="links">
				<li><a href="index.html">Home</a></li>
				<li><a href="generic.html">Add Books</a></li>
				<li><a href="issue.php">Issue Books</a></li>
				<li><a href="elements.html">Return Books</a></li>
				<li><a href="landing.html">Search Books</a></li>
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
						<h1>Search Books</h1>
					</header>


				</div>
			</section>

		</div>

		<!-- Contact -->
		<section id="contact">
			<div class="inner">
				<section class="split">
					<div class="container-fluid search" style="height:auto; color:powderblue; padding-bottom: 5rem; ">
						<form id="search-form" method="post">
							<div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
								<div class="col-md-4">
									<label class="sr-only " for="inlineFormInput">Name</label>
									<input type="text" class="form-control mb-2 form-control form-control-lg" id="search-input" placeholder="Book Name" name="voice-search" />
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
					</div>
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
	<script src="main.js"></script>

</body>

</html>
