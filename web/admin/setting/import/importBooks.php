<?php
include('../../../session.php');
include('../../../database.php');
$adminID = $_SESSION['adminID'];

$DDCstr = file_get_contents("../../category.json");
$DDCjson = json_decode($DDCstr,TRUE);

if (isset($_FILES['bookCSV'])) {

	// Allowed mime types
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

	// Validate whether selected file is a CSV file
	if (!empty($_FILES['bookCSV']['name']) && in_array($_FILES['bookCSV']['type'], $csvMimes)) {

		// If the file is uploaded
		if (is_uploaded_file($_FILES['bookCSV']['tmp_name'])) {

			// Open uploaded CSV file with read-only mode
			$csvFile = fopen($_FILES['bookCSV']['tmp_name'], 'r');

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
					$title = $line[$column['title']];
					$author = $line[$column['author']];
					$isbn = $line[$column['isbn']];
					if (isset($column['publisher']))
						$publisher = $line[$column['publisher']];
					else
						$publisher = '';
					if (isset($column['pages']))
						$pages = $line[$column['pages']];
					else
						$pages = '';
					if (isset($column['date_of_publication']))
						$date_of_publication = $line[$column['date_of_publication']];
					else
						$date_of_publication = '';
					if (isset($column['price']))
						$price = $line[$column['price']];
					else
						$price = '';
					if (isset($column['oldID']))
						$oldID = $line[$column['oldID']];
					else
						$oldID = '';
					if (isset($column['purchaseTime']))
						$purchaseTime = $line[$column['purchaseTime']];
					else
						$purchaseTime = '';
					if (isset($column['purchaseSource']))
						$purchaseSource = $line[$column['purchaseSource']];
					else
						$purchaseSource = '';

					$sqlDuplicate = "SELECT * FROM `main` WHERE CONCAT(`title`,`author`,`isbn`) = CONCAT(:title,:author,:isbn)";
					$stmtDuplicate = $conn->prepare($sqlDuplicate);
					$stmtDuplicate->bindParam(':title', $title);
					$stmtDuplicate->bindParam(':author', $author);
					$stmtDuplicate->bindParam(':isbn', $isbn);
					$stmtDuplicate->execute();
					$duplicate = $stmtDuplicate->fetchObject();

						
					$conn->beginTransaction();
					// add copies
					if (isset($duplicate->bookID)) {
						$bookID = $duplicate->bookID;
						$quantity = $duplicate->quantity + 1;
						$orgQuan = $duplicate->orgQuan + 1;

						$sqlMain = "UPDATE `main` SET `quantity` = :quantity, `orgQuan` = :orgQuan WHERE `main`.`bookID` = :bookID";
						$stmtMain = $conn->prepare($sqlMain);
						$stmtMain->bindParam(':quantity', $quantity);
						$stmtMain->bindParam(':orgQuan', $orgQuan);
						$stmtMain->bindParam(':bookID', $bookID);
						// Insert book in the database
						$stmtMain->execute();

						$sqlCopies = "INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`, `purchaseTime`, `purchaseSource`, `price`) VALUES (:bookID, :copyNO, :oldID, '', NULL, NULL, '', NULL, NULL, :purchaseTime, :purchaseSource, :price)";
						$stmtCopies = $conn->prepare($sqlCopies);
						$stmtCopies->bindParam(':bookID', $bookID);
						$stmtCopies->bindParam(':copyNO', $orgQuan);
						$stmtCopies->bindParam(':oldID', $oldID);
						$stmtCopies->bindParam(':purchaseTime', $purchaseTime);
						$stmtCopies->bindParam(':purchaseSource', $purchaseSource);
						$stmtCopies->bindParam(':price', $price);
						// oldID left
						$stmtCopies->execute();

						$sqlhistory = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, NULL, 'add', UNIX_TIMESTAMP(), :bookID, '')";
						$copyID = $bookID.' - '.$orgQuan;
						$stmthistory = $conn->prepare($sqlhistory);
						$stmthistory->bindParam(':adminID', $adminID);
						$stmthistory->bindParam(':bookID', $bookID);
						//$stmthistory->bindParam(':oldID', $oldID);
						$stmthistory->bindParam(':copyID', $copyID);
						$stmthistory->execute();
					} else {
						// add new book
						$sqlMain = "INSERT INTO `main` (`title`, `author`, `quantity`, `Category1`, `Category2`, `Category3`, `Category4`, `publisher`, `pages`, `imgLink`, `date_of_publication`, `isbn`, `orgQuan`, `digital`, `book`, `digitalLink`, `receiptLink`) VALUES (:title, :author, '1', :Category1, :Category2, :Category3, :Category4, :publisher, :pages, '', :date_of_publication, :isbn, '1', '0', '1', '', '')";
						$stmtMain = $conn->prepare($sqlMain);
						$stmtMain->bindParam(':title', $title);
						$stmtMain->bindParam(':author', $author);
						$stmtMain->bindParam(':isbn', $isbn);
						$stmtMain->bindParam(':publisher', $publisher);
						$stmtMain->bindParam(':pages', $pages);
						$stmtMain->bindParam(':date_of_publication', $date_of_publication);

						$domain = $_SERVER['HTTP_HOST'] . '/sih2020/web';
						$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
						$relative = '/admin/autoDDC.php';
						$url = $prefix . $domain . $relative;
						// what post fields?
						$fields = array(
							'title' => $title,
							'isbn' => $isbn,
						);
						// build the urlencoded data
						$postvars = http_build_query($fields);
						// open connection
						$ch = curl_init();
						// set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, count($fields));
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						// execute post
						$ddc = curl_exec($ch);
						echo "\n".$ddc;
						//$ddc = 839.69341;
						curl_close($ch);
						
						$Category1 = '';
						$Category2 = '';
						$Category3 = '';
						$Category4 = '';
						autoCAT($ddc);
						echo "\n||".$Category1;
						echo "\n||".$Category2;
						echo "\n||".$Category3;
						echo "\n||".$Category4;
						
						$stmtMain->bindParam(':Category1', $Category1);
						$stmtMain->bindParam(':Category2', $Category2);
						$stmtMain->bindParam(':Category3', $Category3);
						$stmtMain->bindParam(':Category4', $Category4);

						// Insert book in the database
						$stmtMain->execute();

						// add copy
						$bookID = $conn->lastInsertId();
						$sqlCopies = "INSERT INTO `copies` (`bookID`, `copyNO`, `oldID`, `copyID`, `stud_ID`, `time`, `status`, `returnTime`, `shelfID`, `purchaseTime`, `purchaseSource`, `price`) VALUES (:bookID, '1', :oldID, '', NULL, NULL, '', NULL, NULL, :purchaseTime, :purchaseSource, :price)";
						$stmtCopies = $conn->prepare($sqlCopies);
						$stmtCopies->bindParam(':bookID', $bookID);
						$stmtCopies->bindParam(':oldID', $oldID);
						$stmtCopies->bindParam(':purchaseTime', $purchaseTime);
						$stmtCopies->bindParam(':purchaseSource', $purchaseSource);
						$stmtCopies->bindParam(':price', $price);
						//oldID left
						$stmtCopies->execute();

						$sqlhistory = "INSERT INTO `history` (`copyID`, `adminID`, `studentID`, `action`, `time`, `bookID`, `oldID`) VALUES (:copyID, :adminID, NULL, 'add', UNIX_TIMESTAMP(), :bookID, :oldID)";
						$copyID = $bookID.' - 1'; // first copy
						$stmthistory = $conn->prepare($sqlhistory);
						$stmthistory->bindParam(':adminID', $adminID);
						$stmthistory->bindParam(':bookID', $bookID);
						$stmthistory->bindParam(':oldID', $oldID);
						$stmthistory->bindParam(':copyID', $copyID);
						$stmthistory->execute();
					}
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
	// Redirect to the listing page
	//header("Location: importCSV.php" . $qstring);
	echo $qstring;
	$conn = null;
}

function autoCAT($ddc){
	global $DDCjson, $Category1, $Category2, $Category3, $Category4;

	$ddc = (float) $ddc;
	if($ddc == 0)
		return;

	$d1 = floor($ddc / 100);
	if(isset($DDCjson[$d1]['description']))
		$Category1 = $DDCjson[$d1]['description'];

	$d2 = floor(($ddc % 100) / 10);
	if(isset($DDCjson[$d1]['subordinates'][$d2]['description']))
		$Category2 = $DDCjson[$d1]['subordinates'][$d2]['description'];

	$d3 = floor($ddc % 10);
	if(isset($DDCjson[$d1]['subordinates'][$d2]['subordinates'][$d3]['description']))
		$Category3 = $DDCjson[$d1]['subordinates'][$d2]['subordinates'][$d3]['description'];

	$d4 = floor((($ddc % 1) / .1) + 0.5);
	if(isset($DDCjson[$d1]['subordinates'][$d2]['subordinates'][$d3]['subordinates'][$d4]['description']))
		$Category4 = $DDCjson[$d1]['subordinates'][$d2]['subordinates'][$d3]['subordinates'][$d4]['description'];
}

?>