<?php
session_start();

$_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];

session_destroy();

// Redirect to the login page:
header('Location: http://'.$_SERVER['SERVER_ADDR'].'/Jeopardy_CTF/login/login.php');
?>
