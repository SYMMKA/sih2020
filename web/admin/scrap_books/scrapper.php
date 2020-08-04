<?php

include("simple_html_dom.php");

$link = $_POST["link"];
$data = file_get_html($link)->plaintext;

exit($data);
