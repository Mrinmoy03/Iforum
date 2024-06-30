<?php


session_start();
 echo"logging you out. Please wait...";

session_unset();
session_destroy();
header("location:http://localhost/phpt/project/online%20Forum/index.php");
?>