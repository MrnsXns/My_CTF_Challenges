<?php
session_start();

$_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link href="registration_form_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<div class="register">
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" value="Register">
			</form>
		</div>

		<div class="login_page_link" style="text-align:center">
			<a href='http://<?=$_SESSION["server_ip"]?>/Jeopardy_CTF/login/login.php' style="color:blue" ><b>Login Page!</b></a>.</p>
		</div>
	</body>
</html>
