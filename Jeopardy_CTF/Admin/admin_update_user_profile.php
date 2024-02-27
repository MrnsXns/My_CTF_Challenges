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

    //echo $_GET['f_userid'];
    //if (isset($_GET['Update'])){

        if (isset($_GET['f_username']) && isset($_GET['l_email'])){

            if ($stmt = $con->prepare('UPDATE users SET username=?, email=? WHERE userId=?')) {
            
    
                $stmt->bind_param('ssi', $_GET['f_username'],$_GET['l_email'],$_GET['f_userid']);
                $stmt->execute();
                
                header('Location: http://localhost/Jeopardy_CTF/Admin/admin_page.php');
                
            } else {
                // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
                echo 'Could not prepare statement!';
            }
            
        
        }
        else {echo '1';}
        if (isset($_GET['f_username'])){

            if ($stmt = $con->prepare('UPDATE users SET username=? WHERE userId=?')) {
            
    
                $stmt->bind_param('si', $_GET['f_username'],$_GET['f_userid']);
                $stmt->execute();
                
                header('Location: http://localhost/Jeopardy_CTF/Admin/admin_page.php');
            
            }
        }else {echo '2';}

        if (isset($_GET['l_email'])){

            if ($stmt = $con->prepare('UPDATE users SET email=? WHERE userId=?')) {
            
    
                $stmt->bind_param('si',$_GET['l_email'],$_GET['f_userid']);
                $stmt->execute();
                
                header('Location: http://localhost/Jeopardy_CTF/Admin/admin_page.php');

            }
        
        }
       


    /*else {
        echo "Something went wrong with update!";
    }*/
    
?>