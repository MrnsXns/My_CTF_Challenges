<?php

session_start();

$_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="login_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>

		<div class="greeting">	
    		<span>JeopardyCTF <br> <b>Web App</b></span>
  		</div>
		
		<div class="login">
			<h1 id="login_header">Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>

		<div class="registration_link" >
			<p><b> Don't have an account?</b><a href='http://<?=$_SESSION["server_ip"]?>/Jeopardy_CTF/registration/registration_form.php' style="color:blue" ><b>Register!</b></a>.</p>
		</div>
		
	</body>
</html>
