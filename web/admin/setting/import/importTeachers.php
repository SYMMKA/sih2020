<?php
include('../../../session.php');
include('../../../database.php');

if (isset($_FILES['teachersCSV'])) {

	// Allowed mime types
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

	// Validate whether selected file is a CSV file
	if (!empty($_FILES['teachersCSV']['name']) && in_array($_FILES['teachersCSV']['type'], $csvMimes)) {

		// If the file is uploaded
		if (is_uploaded_file($_FILES['teachersCSV']['tmp_name'])) {

			// Open uploaded CSV file with read-only mode
			$csvFile = fopen($_FILES['teachersCSV']['tmp_name'], 'r');

			// get the first line
			$line = fgetcsv($csvFile);
			$numcols = count($line); // number of columns
			$line[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $line[0]); //removes hidden characters from 1st column
			for ($i = 0; $i < $numcols; $i++) {
				$column[$line[$i]] = $i;
			}

			try {
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// Parse data from CSV file line by line
				while (($line = fgetcsv($csvFile)) !== FALSE) {
					// Get row data
					$stud_ID = $line[$column['stud_ID']];
					$name = $line[$column['name']];
					if (isset($column['email']))
						$email = $line[$column['email']];
					else
						$email = '';
					if (isset($column['mobile']))
						$mobile = $line[$column['mobile']];
					else
						$mobile = '';

					$conn->beginTransaction();
					// add teachers

					$sqlteachers = "INSERT INTO `students` (`stud_ID`, `name`, `email`, `mobile`, `type`) VALUES (:stud_ID, :studName, :email, :mobile, 'teacher')";
					$stmtteachers = $conn->prepare($sqlteachers);
					$stmtteachers->bindParam(':stud_ID', $stud_ID);
					$stmtteachers->bindParam(':studName', $name);
					$stmtteachers->bindParam(':email', $email);
					$stmtteachers->bindParam(':mobile', $mobile);
					$stmtteachers->execute();
					$conn->commit();
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
	echo $qstring;
}

$conn = null;

?>