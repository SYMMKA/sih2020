<?php
include('session.php');
$title = $_POST['title'];
$isbn = $_POST['isbn'];
$title = rawurlencode($title);
$isbn = rawurlencode($isbn);

$url1 = "http://classify.oclc.org/classify2/Classify?title=$title&summary=true";
$url2 = "http://classify.oclc.org/classify2/Classify?isbn=$isbn&summary=true";
$response1 = simplexml_load_file($url1);
$response2 = simplexml_load_file($url2);
$code1 = $response1->response['code']; //first preferance given to title 
$code2 = $response2->response['code']; //if want to change , invert 1,2 of res and code and change line 28 and 49

$ddc = searchDDC($url1, $response1, $code1);
if($ddc == "No DDC"){
	$ddc = searchDDC($url2, $response2, $code2);
}
echo $ddc;

function searchDDC($url, $response, $code)
{
	if ($code == 0 || $code == 2 || $code == 4) {
		if (isset($response->recommendations->ddc)) {
			$ddc = $response->recommendations->ddc->mostPopular['sfa'];
			$ddc = (float) $ddc;
			if ($ddc != 0) {
				return $ddc;
			}
		} else {
			for ($i = 0; $i < 10; $i++) {
				if (isset($response->works->work[$i]['owi'])) {
					$haa = $response->works->work[$i]['owi'];
					//echo "owi$i=$haa<br>";
					$url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
					$responseNew = new SimpleXMLElement($url, null, true);
					//$response = simplexml_load_file(file_get_contents($url));
					if (isset($responseNew->recommendations->ddc)) {
						$ddc = $responseNew->recommendations->ddc->mostPopular['sfa'];
						$ddc = (float) $ddc;
						if ($ddc != 0) {
							return $ddc;
						}
					}
				}
			}
			if ($i == 10) {
				return "No DDC";
			}
		}
	} else {
		return "No DDC";
	}
}