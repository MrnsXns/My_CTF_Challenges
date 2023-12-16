<?php

#header("Cache-Control: no-cache, must-revalidate");

#header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
#header("Content-Type: application/xml; charset=utf-8");
// Redirect to the login page:
//header('Location: http://'.$_SERVER['SERVER_ADDR'].'/Jeopardy_CTF/login/login.php');
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Registration Confirmation</title>
      <!-- Bootstrap CSS -->    
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
        body {
     font-family: Arial, sans-serif;
}
 #registration-confirmation {
     height: 100vh;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     background-color: #f5f5f5;
}
 #registration-confirmation a {
     margin-top: 20px;
     color: #007bff;
     text-decoration: none;
}
        </style>
   </head>
   <script>
    function redirect(){setTimeout(myURL, 2000);};
    function myURL() {
         document.location.href = "../login/login.php";
      }

   </script>
   <body>
      <!-- Registration Confirmation Section -->    
      <section id="registration-confirmation" class="text-center">
         <h1>Registration Successful!</h1>
         <button onclick = "redirect()">Click to Redirect to <b>Login Page</b></button>  
      </section>
      <!-- Bootstrap & jQuery JS -->    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    <!-- Custom JS -->    <script src="script.js"></script>
   </body>
</html>

