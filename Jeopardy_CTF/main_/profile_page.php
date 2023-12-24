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
$DATABASE_USER = 'ctf_user';
$DATABASE_PASS = 'ctf_user123';
$DATABASE_NAME = 'ctf_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


$query='SELECT username,points, challenge_timestamp FROM users ORDER BY points DESC, challenge_timestamp ASC';
$res=mysqli_query($con,$query);
$username_data=array();
$timestamp_data=array();
$points_data=array();

while($row=mysqli_fetch_assoc($res))
{
  array_push($username_data,$row["username"]);
  array_push($timestamp_data,$row["challenge_timestamp"]);
    array_push($points_data,$row["points"]);
	
	
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

for ($i=0;$i<count($username_data);$i++){
  
	if($_SESSION['name']==$username_data[$i]){
		echo '<tr>
		<td class="number" style="color:white;text-shadow: 2px 2px 2px black;">'.($i+1).'</td>
		
		<td class="name" style="color:white; text-shadow: 2px 2px 2px black;">
		<b><i>'.$username_data[$i].'</i></b>
		</td>
		
		<td class="points" style="color:black">
		<b>'.$points_data[$i].' points</b>
		</td>
		
		<td class="timestamp" style="color:black">
		<b>'.$timestamp_data[$i].'</b>
		</td>
		
		
	</tr>
	<tr>';
	}
	else{
	echo '<tr>
	<td class="number"style="color:rgb(51, 92, 92);">'.($i+1).'</td>
	<td class="name" style="color:rgb(51, 92, 92);"><b>'.$username_data[$i].'</b></td>
	<td class="points" style="color:rgb(51, 92, 92);"><b>'.$points_data[$i].' points</b>  
	<td class="timestamp" style="color:rgb(51, 92, 92);"><b>'.$timestamp_data[$i].'</b>  </td>
	
	</td>
  </tr>
  <tr>';}
}

#print_r($data);
$con->close();
?>
