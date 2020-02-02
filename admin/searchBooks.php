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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	<!-- The core Firebase JS SDK is always required and must be listed first -->
	<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
	<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
	<script src="https://www.gstatic.com/firebasejs/4.3.0/firebase.js"></script>
	<script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-database.js"></script>
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
					<li><a href="issue.php">Issue Books</a></li>
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
					$servername = "remotemysql.com";
					$username = "2qTzr9mwEz";
					$password = "u931TbHEs5";
					$database = "2qTzr9mwEz";
					// Create connection
					$conn = new mysqli($servername, $username, $password, $database);

					$searchField = $_POST['voice-search'];
					$query = "SELECT * FROM books Where title LIKE '%$searchField%'";
					$returnD = mysqli_query($conn, $query);

					$i = 0;

					while ($result = mysqli_fetch_assoc($returnD)) {
						foreach ($result as $k => $v) {
							if ($k == 'imgLink') {
								$imgLink[$i] = $v;
							}
							if ($k == 'title') {
								$title[$i] = $v;
							}
							if ($k == 'isbn') {
								$isbn[$i] = $v;
							}
							if ($k == 'author') {
								$author[$i] = $v;
							}
							if ($k == 'bookID') {
								$bookID[$i] = $v;
							}
						}
					?>
						<div class="col-sm-3">

							<div class="card text-center" style="border:none;">
								<img class="card-img-top" src="<?= $imgLink[$i] ?>" alt="No Image" style="height:300px;">
								<div class="card-body text-white" style="background-color: #393e46">
									<h5 class="card-title"><?= $title[$i] ?></h5>
									<h6 class="card-subtitle mb-2 text-muted"><?= $author[$i] ?></h6>
									<p class="card-text"><?= $isbn[$i] ?></p>
									<p class="card-text"><?= $bookID[$i] ?></p>
								</div>
								<div class="card-footer" style="border:none; background-color: #393e46 ">
									<div class="col-auto">
										<button type="submit" class="button scrolly" name="issue-book" id="<?= $i; ?>" onclick="autoFillIssue(this.id)" href="#issueBook">
											Issue Book
										</button>
										<button type="submit" class="button scrolly" name="update-book" id="<?= $i; ?>" onclick="autoFillUpdate(this.id)" href="#updateBook">
											Update Book
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

	<!-- issue book -->
	<div class="inner" name="issueBook" id="issueBook" hidden="true">
		</br>
		</br>

		<div class="form-row align-items-center justify-content-center" style="font-size: 50px;">
			<label>Issue Book</label>
		</div>


		<div class="fields">
			<form id="issueBookForm">
				<div class="field half" style="text-align: center;">
					<label>Title: </label>
					<label id="booktitleIssue"></label>
					<input type="hidden" name="issueTitle" id="issueTitle">
				</div>
				<br />
				<div class="field half" style="text-align: center;">
					<label>Author: </label>
					<label id="bookauthorIssue"></label>
					<input type="hidden" name="issueAuthor" id="issueAuthor">
				</div>
				<div class="field half" style="text-align: center;">
					<label>ISBN: </label>
					<label id="bookisbnIssue"></label>
					<input type="hidden" name="issueISBN" id="issueISBN">
				</div>
				<div class="field half" style="text-align: center;">
					<label>BookID: </label>
					<label id="bookIDIssue"></label>
					<input type="hidden" name="issueID" id="issueID">
					<label>CopyID: </label>
					<input type="number" name="copyID" id="copyID" required>
				</div>
				<div class="field half" style="text-align: center;">
					<img src="" id="bookimgLinkIssue">
				</div>
				<div class="field">
					<label>Student Name</label>
					<input type="text" name="stud_name" id="stud_name" placeholder="Name" />
				</div>
				<div class="field">
					<label>Student Email</label>
					<input type="text" name="stud_email" id="stud_email" placeholder="Email address" />
				</div>
				<div class="field">
					<label>Student ID</label>
					<input type="text" name="stud_id" id="stud_id" placeholder="ID" required/>
				</div>
				<div class="field">
					<label>Issue Date</label>
					<input name="issue_date" id="issue_date" placeholder="Date" />
				</div>
				<ul class="actions">
					<li><input type="submit" value="Issue" name="issue" class="primary" /></li>
					<li><input type="reset" value="Clear" /></li>
				</ul>

				</br>
			</form>
		</div>
	</div>

	<!-- update book -->
	<div class="inner" name="updateBook" id="updateBook" hidden="true">
		</br>
		</br>

		<div class="form-row align-items-center justify-content-center" style="font-size: 50px;">
			<label>Update Book</label>
		</div>


		<div class="fields">
			<form id="updateBookForm">
				<div class="field half" style="text-align: center;">
					<label>Title: </label>
					<label id="booktitleUpdate"></label>
				</div>
				<br />
				<div class="field half" style="text-align: center;">
					<label>Author: </label>
					<label id="bookauthorUpdate"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<label>ISBN: </label>
					<label id="bookisbnUpdate"></label>
				</div>
				<div class="field half" style="text-align: center;">
					<label>BookID: </label>
					<label id="bookIDUpdate"></label>	
					<input type="hidden" name="orgupdateID" id="orgupdateID">
				</div>
				<div class="field half" style="text-align: center;">
					<img src="" id="bookimgLinkUpdate">
				</div>

				<div class="field">
					<label>Change Title</label>
					<input type="text" name="updateTitle" id="updateTitle" placeholder="Name" />
				</div>
				<div class="field">
					<label>Change Author</label>
					<input type="text" name="updateAuthor" id="updateAuthor" placeholder="Email address" />
				</div>
				<div class="field">
					<label>Add copies</label>
					<input type="text" name="addcopies" id="addcopies" placeholder="ID" >
				</div>
				<div class="field">
					<label>Remove Copy</label>
					<label>CopyID: </label>
					<input type="number" name="removecopyID" id="removecopyID" >
				</div>
				<ul class="actions">
					<li><input type="submit" value="update" name="update" class="primary" /></li>
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
	<script src="main.js"></script>
	<script>
		title = <?php echo json_encode($title); ?>
	</script>
	<script>
		author = <?php echo json_encode($author); ?>
	</script>
	<script>
		isbn = <?php echo json_encode($isbn); ?>
	</script>
	<script>
		bookID = <?php echo json_encode($bookID); ?>
	</script>
	<script>
		imgLink = <?php echo json_encode($imgLink); ?>
	</script>
	<script>
		function autoFillIssue(i) {
			// donot remove the comments in this method if the id isnt predefined in html form

			document.getElementById('updateBook').hidden = true; //hide update book page
			document.getElementById('issueBook').hidden = false; //shows issue book page
			document.getElementById('booktitleIssue').textContent = title[i];
			document.getElementById('issueTitle').value = title[i];
			document.getElementById('bookauthorIssue').textContent = author[i];
			document.getElementById('issueAuthor').value = author[i];
			document.getElementById('bookisbnIssue').textContent = isbn[i];
			document.getElementById('issueISBN').value = isbn[i];
			document.getElementById('bookIDIssue').textContent = bookID[i];
			document.getElementById('issueID').value = bookID[i];
			if (imgLink[i]) {
				document.getElementById('bookimgLinkIssue').src = imgLink[i];
				document.getElementById('bookimgLinkIssue').hidden = false;
			}
			// current date
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();

			today = mm + '/' + dd + '/' + yyyy;
			document.getElementById('issue_date').value = today;
		}

		function autoFillUpdate(i) {
			// donot remove the comments in this method if the id isnt predefined in html form

			document.getElementById('issueBook').hidden = true; //hide issue book page
			document.getElementById('updateBook').hidden = false; //shows update book page
			document.getElementById('booktitleUpdate').textContent = title[i];
			console.log(title[i]);
			document.getElementById('bookauthorUpdate').textContent = author[i];
			document.getElementById('bookisbnUpdate').textContent = isbn[i];
			document.getElementById('bookIDUpdate').textContent = bookID[i];
			document.getElementById('orgupdateID').value = bookID[i];
			if (imgLink[i]) {
				document.getElementById('bookimgLinkUpdate').src = imgLink[i];
				document.getElementById('bookimgLinkUpdate').hidden = false;
			}
		}
	</script>
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.scrolly.min.js"></script>
	<script src="../assets/js/jquery.scrollex.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="issueBook/fireDB.js"></script>
	<script src="../assets/js/main.js"></script>


</body>

</html>