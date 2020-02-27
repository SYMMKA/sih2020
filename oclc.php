<html>

<head>
</head>

<body>
    <form method="post">
        <div>
            <div style="text-align: center;">
                <label>Title: </label>
                <input type="text" name="title"></label>
            </div>
            <br />
            <div style="text-align: center;">
                <label>AUthor: </label>
                <input type="text" name="author"></label>
            </div>
            <br />
            <div style="text-align: center;">
                <label>ISBN: </label>
                <input type="text" name="isbn"></label>
            </div>
            </br>
            <ul class="actions">
                <li><input type="submit" value="oclc" name="oclc" class="primary" /></li>
            </ul>

        </div>
    </form>
    <?php
    if (isset($_POST['oclc'])) {
        if(isset($_POST['isbn']))
        {
            $isbn = $_POST['isbn'];
            $url = "http://classify.oclc.org/classify2/Classify?isbn=".$isbn."&summary=true";
            $xml = simplexml_load_file($url);
            echo ($xml->recommendations->ddc->mostPopular['sfa']);
        }
    }


    ?>





</body>

</html>