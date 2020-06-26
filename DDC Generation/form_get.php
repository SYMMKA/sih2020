<html>
  <?php
  $ip=$_GET['ip'];
  $title=$_GET['title'];
  $author=$_GET['author'];
  $title = rawurlencode($title);
  $author = rawurlencode($author);
  $url = "http://classify.oclc.org/classify2/Classify?author=$author&title=$title&isbn=$ip&summary=true";
  $response1 = simplexml_load_file($url);
  $code = $response1->response['code'];
  echo "code:$code<br>";
  if ($code == 0 || $code == 2 || $code == 4)
  {
    if(isset($response1->recommendations->ddc))
    {
      $ddc = $response1->recommendations->ddc->mostPopular['sfa'];
      if(!ctype_alpha($ddc))
      {
        echo $ddc;
      }
    }
    else
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
          if(!ctype_alpha($ddc))
          {
            echo $ddc;
            break;
          }
        }
      }
      if($i == 9)
      {
        echo "No DDC";
      }
    }
  }
  else{
    echo "No DDC";
  }
  ?>
</html>
