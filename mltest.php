<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.meaningcloud.com/class-1.1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "key=2b70d49f2612c06bc6211dc735c3f801&txt=python&model=test",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$data = json_decode($response, true);
//var_dump($data);
foreach ($data as $k => $v) {
  if ($k == 'category_list') {
    foreach ($v as $c => $d) {
      if ($c == 'label') {
        foreach ($d as $e => $f) {
          if ($e == 'label')
            echo $f;
        }
      }
    }
  }
}
