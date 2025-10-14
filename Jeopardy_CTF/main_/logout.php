<?php
session_start();



session_destroy();
session_start();
session_regenerate_id(true);
// Redirect to the login page:
header('Location:/Jeopardy_CTF/login/login.php');
exit();
?>


