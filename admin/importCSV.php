<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "trial";
// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

if (isset($_POST['importSubmit'])) {

	// Allowed mime types
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

	// Validate whether selected file is a CSV file
	if (!empty($_FILES['bookCSV']['name']) && in_array($_FILES['bookCSV']['type'], $csvMimes)) {

		// If the file is uploaded
		if (is_uploaded_file($_FILES['bookCSV']['tmp_name'])) {

			// Open uploaded CSV file with read-only mode
			$csvFile = fopen($_FILES['bookCSV']['tmp_name'], 'r');

			// Skip the first line
			fgetcsv($csvFile);

			try {
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql1 = "INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `price`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`) VALUES (:title, :author, '', '', '', '', '', '', '', '', '', '', :isbn, '', '', '1')";
				$stmt1 = $conn->prepare($sql1);

				// Parse data from CSV file line by line
				while (($line = fgetcsv($csvFile)) !== FALSE) {
					// Get row data				
					$stmt1->bindParam(':title', $line[0]);
					$stmt1->bindParam(':author', $line[1]);
					$stmt1->bindParam(':isbn', $line[2]);


					// Insert member data in the database
					$stmt1->execute();
				}

				// Close opened CSV file
				fclose($csvFile);

				$qstring = '?status=succ';
			} catch (PDOException $e) {
				$conn->rollBack();
				echo "Failed " . $e->getMessage();
			}
		} else {
			$qstring = '?status=err';
		}
	} else {
		$qstring = '?status=invalid_file';
	}
	// Redirect to the listing page
	header("Location: importCSV.php" . $qstring);
}


?>
<div class="row">
	<!-- CSV file upload form -->
	<div class="col-md-12" id="importFrm">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="bookCSV" />
			<input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
		</form>
	</div>
	<script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>