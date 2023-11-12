<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap"
      rel="stylesheet"
    />
	<link rel="stylesheet" type="text/css" href="profile_page_style.css">
  </head>
  <body>
</body>
<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ctf_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


$query='SELECT username,completed FROM users ORDER BY completed DESC';
$res=mysqli_query($con,$query);
$data=array();
while($row=mysqli_fetch_assoc($res))
{
	array_push($data,$row["username"]);
	
	
}
echo '
  
    <main>
      <div id="header">
        <h1>Ranking</h1>
        <button class="back"  onclick="window.history.back()">
		<i class="ph ph-arrow-u-up-left"></i>
        </button>
      </div>
      <div id="leaderboard">
        <div class="ribbon"></div>
        <table>';
$i=0;

for ($i=0;$i<count($data);$i++){

	if($_SESSION['name']==$data[$i]){
		echo '<tr>
		<td class="number"style="color:blue">'.($i+1).'</td>
		
		<td class="name" style="color:blue">
		<b>'.$data[$i].'</b>
		</td>
		
		<td class="points">
		
		</td>
	</tr>
	<tr>';
	}
	else{
	echo '<tr>
	<td class="number">'.($i+1).'</td>
	<td class="name">'.$data[$i].'</td>
	<td class="points">
	  
	</td>
  </tr>
  <tr>';}
}

#print_r($data);
$con->close();
?>

