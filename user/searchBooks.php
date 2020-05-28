<html>

<head>
	<title>Search Books</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
</head>

<body class="is-preload">
	<section>

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
					<li><a href="addBooks.php">Add Books</a></li>
					<li><a href="reserve.php">reserve Books</a></li>
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
							<h1>Search Books</h1>
						</header>


					</div>
				</section>

			</div>

			<div class="inner">
				<div class="container-fluid search" style="height:auto; color:powderblue; padding-bottom: 5rem; ">
					<form id="search-form" method="post">
						<div class="form-row align-items-center justify-content-center " style="padding-top: 5rem;">
							<div class="col-md-4">
								<label class="sr-only " for="inlineFormInput">Name</label>
								<input type="text" class="form-control mb-2 form-control form-control-lg" id="search-input" placeholder="Book Name" name="voice-search" />
								<span id="voice-trigger">
									<svg width="32px" height="32px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="10px" y="10px" viewBox="0 35 58 58" style=" overflow: visible;" xml:space="preserve">
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
								<button type="submit" style="width: 130px; margin-top:-10px;" value="submit">
									Search
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			<?php
			if (isset($_POST['voice-search'])) {
			?>
				<div class="row">
					<?php
					//DB CONNECTION====================================
					$servername = "localhost";
					$username = "root";
					$password = "";
					$database = "library";
					// Create connection
					$conn = new mysqli($servername, $username, $password, $database);

					$searchField = $_POST['voice-search'];
					$query = "SELECT * FROM main Where title LIKE '%$searchField%'";
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
						<div class="col-sm-3">
						<div class="card text-center" style="border:none;">
								<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="No Image" style="height:300px;">
								<div class="card-body text-white" style="background-color: #393e46">
									<h5 class="card-title"><?= $title[$i] ?></h5>
									<h6 class="card-subtitle mb-2 text-muted"><?= $author[$i] ?></h6>
									<p class="card-text"><?= $isbn[$i] ?></p>
									<p class="card-text">Star: <?= $star[$i] ?></p>
								</div>
								<div class="card-footer" style="border:none; background-color: #393e46 ">
									<div class="col-auto">
										<button type="submit" class="button scrolly" name="issue-book" id="<?= $i; ?>" onclick="autoFill(this.id)" href="#reserveBook">
											Reserve Book
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
	</div>

	<div class="inner" name="reserveBook" id="reserveBook" hidden="true">
		</br>
		</br>

		<div class="form-row align-items-center justify-content-center" style="font-size: 50px;">
			<label>reserve Book</label>
		</div>


		<div class="fields">
			<form id="searchBookForm">
				<div class="field half" style="text-align: center;">
					<label>Title: </label>
					<label id="booktitle"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<label>Author: </label>
					<label id="bookauthor"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<label>ISBN: </label>
					<label id="bookisbn"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<label>Old ID: </label>
					<label id="oldID"></label>
					<label>CopyID: </label>
					<label id="copyID"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<img src="" id="bookimgLink">
				</div>
				<div class="row" id="copies"></div>
				<div class="field">
					<label>Student ID //No need to ask when student logs in</label>
					<input type="text" name="stud_ID" id="stud_ID" placeholder="ID" required />
				</div>
				<ul class="actions">
					<li><input type="submit" value="reserve" name="reserve" class="primary" /></li>
					<li><input type="reset" value="Clear" /></li>
				</ul>

				</br>
			</form>
		</div>
	</div>

	<!-- Scripts -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="../admin/main.js"></script>
	<script>
		title = <?php echo json_encode($title); ?>;
		author = <?php echo json_encode($author); ?>;
		isbn = <?php echo json_encode($isbn); ?>;
		imgLink = <?php echo json_encode($imgLink); ?>
	</script>
	<script src="reserveBook/autoFill.js"></script>
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.scrolly.min.js"></script>
	<script src="../assets/js/jquery.scrollex.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="reserveBook/uploadDB.js"></script>
	<script src="../assets/js/main.js"></script>


</body>

</html>