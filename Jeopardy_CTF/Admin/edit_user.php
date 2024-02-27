




<?php 


    session_start();
    $_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];
    // Connect to database.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'ctf_db';
    
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }




/*
if ( isset($_GET['usrnm']) && isset($_GET['email'])){

echo '
<!DOCTYPE html>
<html>
<body>
<label for="fname">Username:</label><input type="text" id="f_username" name="f_username" value="'.$_GET['usrnm'].' ">&nbsp <button>Update username</button></a><br><br>
<label for="lname">E-mail:</label><input type="text" id="l_email" name="l_email" value="'.$_GET['email'].'">&nbsp <button onclick="myFest(this)"> Update email of user</button><br><br>
</body> 
</html> 
<scritp>var url = "edit_user.php?update_usrnm=1&new_username=" + document.getElementById("f_username").value;
var element = document.getElementById("update_link");
element.setAttribute("href",url)</script>';

}


if (isset($_GET['update_usrnm'])){echo "ok";}
else{echo "something went wrong with edit_profile page";}
*/
?>

<!DOCTYPE html>
<html>
<body>
<form action="admin_update_user_profile.php" method="GET">
<label for="f_userid">USER ID:</label><input type="text" id="f_userid" name="f_userid" readonly value="<?php echo $_GET['Userid'];?>">&nbsp <br><br>
<label for="fname">Username:</label><input type="text" id="f_username" name="f_username" value="<?php echo $_GET['usrnm'];?>">&nbsp <br><br>

<label for="lname">E-mail:</label><input type="text" id="l_email" name="l_email" value="<?php echo $_GET['email'];?>">&nbsp<br><br>
<input type="submit" value="Update"  onClick="return confirm('Apply change to user with ID =  <?php echo $_GET['Userid'];?>?');">
</form>
</body> 
</html> 