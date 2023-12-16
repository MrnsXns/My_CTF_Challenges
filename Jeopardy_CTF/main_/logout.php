<?php
session_start();
$_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];
session_destroy();
#header("Cache-Control: no-cache, must-revalidate");

#header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
#header("Content-Type: application/xml; charset=utf-8");
// Redirect to the login page:
header('Location: http://'.$_SERVER['SERVER_ADDR'].'/Jeopardy_CTF/login/login.php');
?>