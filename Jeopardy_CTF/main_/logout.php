<?php
session_start();
session_destroy();
#header("Cache-Control: no-cache, must-revalidate");

#header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
#header("Content-Type: application/xml; charset=utf-8");
// Redirect to the login page:
header('Location: http://localhost/Jeopardy_CTF/login/login.html');
?>