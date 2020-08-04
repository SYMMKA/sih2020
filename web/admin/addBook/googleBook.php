<?php
include("../session.php");
$search = $_POST['search'];
use GuzzleHttp\Exception\GuzzleException;

// API key, future ref
$API_KEY = '';

// donot delete
require_once '../vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("Client_Library_Examples");

$service = new Google_Service_Books($client);
//$optParams = array('filter' => 'free-ebooks');

try {
	$results = $service->volumes->listVolumes($search);
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
				//$isbn[$i]=$isbn[$i] . $item['volumeInfo']['industryIdentifiers'][$n]['identifier'] . " " ;
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
        $i++;
	}
	$return['title'] = $title;
	$return['author'] = $author;
	$return['category'] = $category;
	$return['publisher'] = $publisher;
	$return['publishedDate'] = $publishedDate;
	$return['isbn'] = $isbn;
	$return['pageCount'] = $pageCount;
	$return['country'] = $country;
	$return['money'] = $money;
	$return['imgLink'] = $imgLink;
    $return['preview'] = $preview;

	echo json_encode($return);
    
} catch (GuzzleException $exception) {
	echo "Failed";
	/* echo "
		var search = '" . $search . "'.split(' ');
		var keys = Object.keys(localStorage).filter(key => key.includes('cacheData'));
		keys.forEach( (key) => {
			var cachedSearch = key.slice(10).split(' ');
			if(search.filter((value) => cachedSearch.includes(value)).length) {
				console.log(JSON.parse(localStorage.getItem(key)));
			};
		});
	"; */
}