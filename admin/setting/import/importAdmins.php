<?php
include('../../session.php');
include('../../db.php');

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'settingsAdminAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if($access > $adminLevel){
	echo "\nAccess not granted";
	$conn = null;
	exit;
}

if (isset($_FILES['adminsCSV'])) {

	// Allowed mime types
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

	// Validate whether selected file is a CSV file
	if (!empty($_FILES['adminsCSV']['name']) && in_array($_FILES['adminsCSV']['type'], $csvMimes)) {

		// If the file is uploaded
		if (is_uploaded_file($_FILES['adminsCSV']['tmp_name'])) {

			// Open uploaded CSV file with read-only mode
			$csvFile = fopen($_FILES['adminsCSV']['tmp_name'], 'r');

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
					// change
					$adminID = $line[$column['adminID']];
					if (isset($column['fname']))
						$fname = $line[$column['fname']];
					else
						$fname = '';
					if (isset($column['lname']))
						$lname = $line[$column['lname']];
					else
						$lname = '';
					if (isset($column['clearance']))
						$clearance = $line[$column['clearance']];
					else
						$clearance = '1';

					$conn->beginTransaction();
					// add admins

					// change
					$sqladmins = "INSERT INTO `adminlogin` (`userID`, `fname`, `lname`, `clearance`) VALUES (:adminID, :fname, :lname, :clearance)";
					$stmtadmins = $conn->prepare($sqladmins);
					$stmtadmins->bindParam(':adminID', $adminID);
					$stmtadmins->bindParam(':fname', $fname);
					$stmtadmins->bindParam(':lname', $lname);
					$stmtadmins->bindParam(':clearance', $clearance);
					$stmtadmins->execute();
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