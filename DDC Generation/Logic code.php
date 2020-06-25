<html>
  <?php
  $ip=$_GET['ip'];
  $title=$_GET['title'];
  $author=$_GET['author'];
  $title = rawurlencode($title);
  $author = rawurlencode($author);
  $url = "http://classify.oclc.org/classify2/Classify?author=$author&title=$title&summary=true";
  $response = simplexml_load_file($url);
  $code = $response->response['code'];
  echo $code;
  echo "     ";
  if ($code == 0 || $code == 2 || $code == 4)
    {
      $haa = $response->works->work[1]['owi'];
      echo "Owi1: ";
      echo ($haa);
      #echo "\n";
      if(isset($response->recommendations->ddc))
      {
        echo $response->recommendations->ddc->mostPopular['sfa'];
      }
      else
      {
        $url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
        $response = simplexml_load_file($url);
        if(isset($response->recommendations->ddc))
        {
          echo $response->recommendations->ddc->mostPopular['sfa'];
        }
        else
        {
          $haa = $response->works->work[2]['owi'];
          echo "Owi2: ";
          echo ($haa);
          #echo "\n";
          $url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
          $response = simplexml_load_file($url);
          if(isset($response->recommendations->ddc))
          {
            echo "DDC: ";
            echo $response->recommendations->ddc->mostPopular['sfa'];
          }
          else
          {
            echo "NO DDC";
          }
        }
      }
    }
  else{
    echo "No DDC";
  }
  ?>
</html>
