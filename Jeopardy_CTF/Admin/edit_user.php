



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

