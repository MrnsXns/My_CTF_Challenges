<?php 
session_start();
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
/*if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{*/




// for deleting user
if(isset($_GET['delUserid'])){
    $UserId=$_GET['delUserid'];


    if ($stmt = $con->prepare('delete from users where userid=?')) {

        $stmt->bind_param('i',$UserId);
        $stmt->execute();
        echo "<script>alert('Data deleted');</script>";
        header('location:admin_page.php');
}
}
// Add user
if(isset($_GET['addUser'])){
    $UserId=$_GET['addUser'];
    header('location:../registration/registration_form.php');
}

    if ($stmt = $con->prepare('delete from users where userid=?')) {

        $stmt->bind_param('i',$UserId);
        $stmt->execute();
        echo "<script>alert('Data deleted');</script>";
        header('location:admin_page.php'); /*change the path*/
}
    else{
    echo "<script>alert('Something went wrong. Please try again');</script>";
    header('location:admin_page.php');
}


//CLEAR SET challenge's points 
if (isset($_GET['Userid']) && isset($_GET['chal_type'])){
    //CLEAR
    if (isset($_GET['Clear']))

        
        if ($stmt = $con->prepare('UPDATE users SET '.$_GET['chal_type'].' =0 WHERE userId=?')) {
            
            $c=$_GET['chal_points'];
            $d=$_GET['Userid'];

            

            $stmt->bind_param('i',$_GET['Userid']);
            $stmt->execute();
            
            
        } else {
            
            echo 'Could not prepare statement!';
        }

        //SET
        if (isset($_GET['chal_points']) && isset($_GET['Set']))

        
        if ($stmt = $con->prepare('UPDATE users SET '.$_GET['chal_type'].' =? WHERE userId=?')) {
            
            $c=$_GET['chal_points'];
            $d=$_GET['Userid'];

            

            $stmt->bind_param('ii',$_GET['chal_points'],$_GET['Userid']);
            $stmt->execute();
            
            
            
        } else {
    
            echo 'Could not prepare statement!';
        }
        
    }

if (isset($_GET['userId']) && isset($_GET['usrnm']) && isset($_GET['email'])){

    echo '<label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname" value="John"><br>
    <label for="lname">Last name:</label><br>
    <inpu.t type="text" id="lname" name="lname" value="Doe"><br><br>';
}
    


   ?>