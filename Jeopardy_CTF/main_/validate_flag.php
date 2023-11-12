<?php

    #echo $_POST['flag'];
    #echo  hash('sha256', 'flag_RE');
    #$user_hash=hash('sha256', $_POST['WEBflag']);
    #echo $user_hash;
    #$f= $_POST['buttonId'];
    #echo $f;
   
    function updateDatabase($col){
        // Checking, if post value is 
        // set by user or not 
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
        if ($stmt = $con->prepare('UPDATE users SET '.$col.' =? WHERE username=?')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $value = 1 ;

            session_start();
            $user=$_SESSION['name'];

            $stmt->bind_param('ss', $value,$user);
            $stmt->execute();
            
            header('Location:http://localhost/Jeopardy_CTF/main_/congrats_page.html');
            
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
            echo 'Could not prepare statement!';
        }
        $stmt->close();   
        $con->close();
    }




	if (isset($_POST['REflag']) && hash('sha256',$_POST['REflag'])=="9a1fe00199a691f9bbe6bef8ce79b74e0326b2f71e9242ece802f8247bdfe510"){
     echo "re flag ok";
     updateDatabase("RE");
       
       
        
    }
    elseif (isset($_POST['WEBflag']) && hash('sha256',$_POST['WEBflag'])=="839f6652ffa510044c1e0d99a1f986656854dfab64da2a310593c45d8d932982"){
        echo " WEBflag ok";
        updateDatabase("WEB");
        
    }
    elseif (isset($_POST['CRYPTOflag']) && $_POST['CRYPTOflag']=="hash256 CRYPTO flag goes here"){
       #echo "CRYPTOflag ok";
       
        updateDatabase("CRYPTO");
       
        
        
    }
    else{
        echo "no";
    }
    
?> 



