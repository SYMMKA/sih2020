<html>
  <?php
  $ip=$_GET['ip'];
  $title=$_GET['title'];
  $author=$_GET['author'];
  $title = rawurlencode($title);
  $author = rawurlencode($author);
  $url1 = "http://classify.oclc.org/classify2/Classify?title=$title&summary=true";
  $url2 = "http://classify.oclc.org/classify2/Classify?isbn=$ip&summary=true";
  $response1 = simplexml_load_file($url1);
  $response2 = simplexml_load_file($url2);
  $code1 = $response1->response['code']; //first preferance given to title 
  $code2 = $response2->response['code']; //if want to change , invert 1,2 of res and code and change line 28 and 49

  if ($code1 == 0 || $code1 == 2 || $code1 == 4 || $code2 == 0 || $code2 == 2 || $code2 == 4)
  {
    if(isset($response1->recommendations->ddc))
    {
      
      $ddc = $response1->recommendations->ddc->mostPopular['sfa'];
      $ddc = (float)$ddc;
          if ($ddc!=0) {
            echo $ddc;
          }
    }
    else
    {
      if (!$title == "") //if changing preferance then $ip
      {
        for ($i=0;$i<10;$i++)
        {
          $haa = $response1->works->work[$i]['owi'];
          echo "$i<br>";
          echo "owi$i of title=$haa<br>";
          $url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
          $response = simplexml_load_file($url);
          if(isset($response->recommendations->ddc))
          {
            $ddc = $response->recommendations->ddc->mostPopular['sfa'];
            $ddc = (float)$ddc;
            if ($ddc!=0) {
              echo "$i = $ddc <br>";
              break;
            }
          }
        }
        echo "final i $i";
      }
      if($title == "") //if changing preferance then $ip
      {
        if ($code2 == 0 || $code2 == 2 || $code2 == 4)
        {
          if(isset($response2->recommendations->ddc))
          {
            $ddc = $response2->recommendations->ddc->mostPopular['sfa'];
            $ddc = (float)$ddc;
            if ($ddc!=0) {
              echo $ddc;
            }
          }
          else
          {
            for ($i=0;$i<10;$i++)
            {
              $haa = $response2->works->work[$i]['owi'];
              echo "owi$i of isbn=$haa<br>";
              $url = "http://classify.oclc.org/classify2/Classify?owi=$haa";
              $response = simplexml_load_file($url);
              if(isset($response->recommendations->ddc))
              {
                $ddc = $response->recommendations->ddc->mostPopular['sfa'];
                $ddc = (float)$ddc;
                if ($ddc!=0) {
                  echo $ddc;
                  break;
                }
              }
            }
            if($i == 10)
            {
              echo "No DDC";
            }
          }
        }
      }
    }
  }
  else{
    echo "No DDC";
  }
  ?>
</html>
