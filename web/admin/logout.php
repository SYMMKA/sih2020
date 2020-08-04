<?php
session_start();
session_destroy();
//unset($_SESSION["login_admin"]);
header("Location: login.php");
