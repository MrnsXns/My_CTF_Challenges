<?php
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

if ($stmt = $con->prepare('SELECT RE,WEB,CRYPTO,PWN FROM users WHERE username = "marinos"')) {
    #$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($RE,$WEB,$CRYPTO,$PWN);
    $stmt->fetch();
    echo $RE,$WEB,$CRYPTO;
    
}else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
    echo 'Could not prepare statement!';
}
$stmt->close();   
$con->close();
?>