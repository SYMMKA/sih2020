<?php
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];
$title = rawurlencode($title);
$author = rawurlencode($author);
$url = "http://classify.oclc.org/classify2/Classify?author=$author&title=$title&isbn=$isbn&summary=true";
$response1 = new SimpleXMLElement($url, null, true);
$code = $response1->response['code'];

if ($code == 0 || $code == 2 || $code == 4) {
	if (isset($response1->recommendations->ddc)) {
		$ddc = $response1->recommendations->ddc->mostPopular['sfa'];
		$ddc = (float)$ddc;
		if ($ddc!=0) {
			echo $ddc;
		}
	} else {
		for ($i = 0; $i < 10; $i++) {
			$haa = $response1->works->work[$i]['owi'];
			//echo "owi$i=$haa<br>";
			$url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
			$response = new SimpleXMLElement($url, null, true);
			//$response = simplexml_load_file(file_get_contents($url));
			if (isset($response->recommendations->ddc)) {
				$ddc = $response->recommendations->ddc->mostPopular['sfa'];
				$ddc = (float)$ddc;
				if ($ddc!=0) {
					echo $ddc;
					break;
				}
			}
		}
		if ($i == 10) {
			echo "No DDC";
		}
	}
} else {
	echo "No DDC";
}
