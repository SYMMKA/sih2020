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
      $reddc = $response->recommendations->ddc;
      if (isset($reddc->mostPopular))
      {
        echo $reddc->mostPopular['sfa'];
      }
      else
      {
        $owi = $response->works->work['owi'];
        echo $owi;
      }
    }
  else{
    echo "No DDC";
  }

  #if (!isset($reddc->mostPopular))
  ?>
</html>
