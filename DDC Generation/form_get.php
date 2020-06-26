<html>
  <?php
  $ip=$_GET['ip'];
  $title=$_GET['title'];
  $author=$_GET['author'];
  $title = rawurlencode($title);
  $author = rawurlencode($author);
  $url = "http://classify.oclc.org/classify2/Classify?author=$author&title=$title&summary=false";
  $response1 = simplexml_load_file($url);
  $code = $response1->response['code'];
  echo "code:$code<br>";
  $i = 0;
  if ($code == 0 || $code == 2 || $code == 4)
    {
      for ($i=0;$i<10;$i++)
      {
        $haa = $response1->works->work[$i]['owi'];
        echo "owi$i=$haa<br>";
        $url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
        $response = simplexml_load_file($url);
        if(isset($response->recommendations->ddc))
        {
          $ddc = $response->recommendations->ddc->mostPopular['sfa'];
          #can use is_numeric($ddc) to remove FIC wale code
          echo $ddc;
          break;
        }
      }
      if($i == 9)
      {
        echo "No DDC";
      }
    }
  else{
    echo "No DDC";
  }
  ?>
</html>
