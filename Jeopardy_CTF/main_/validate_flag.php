<?php
    session_start();

    $_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];
    
   
    function updateDatabase($col,$chal_points){
        // Checking, if post value is 
        // set by user or not 
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
        if ($stmt = $con->prepare('UPDATE users SET '.$col.' =? WHERE username=?')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $value = $chal_points;

            session_start();
            $user=$_SESSION['name'];

            $stmt->bind_param('is', $value,$user);
            $stmt->execute();
            
            header('Location: http://'.$_SERVER['SERVER_ADDR'].'/Jeopardy_CTF/main_/congrats_page.php');
            
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
            echo 'Could not prepare statement!';
        }
        $stmt->close();   
        $con->close();
    }




	if (isset($_POST['REflag']) && hash('sha256',$_POST['REflag'])=="5b29eb6fe26e504e03af6b19876294dadae2866657be85322965cd7041d86b4c"){
     /*$a= "re flag ok";
     echo json_encode($a);*/
     updateDatabase("RE",35);
       
        
        
    }
    elseif (isset($_POST['WEBflag']) && hash('sha256',$_POST['WEBflag'])=="839f6652ffa510044c1e0d99a1f986656854dfab64da2a310593c45d8d932982"){
        echo " WEBflag ok";
        updateDatabase("WEB",30);
        
    }
    elseif (isset($_POST['CRYPTOflag']) &&  hash('sha256',$_POST['CRYPTOflag'])=="e2ee80394d308103abcbc101c3979776b8244cab31016d004c6aa344be7f79f7"){
       #echo "CRYPTOflag ok";
       
        updateDatabase("CRYPTO",15);
       
        
        
    }

    elseif (isset($_POST['STEGOflag']) &&  hash('sha256',$_POST['STEGOflag'])=="a214c05afb09e0bb7ec726e464f76892bb1e7f7313457a03d56fb37fe82d3db9"){
        #echo "CRYPTOflag ok";
        
         updateDatabase("STEGO",20);
        
         
         
     }

    else{
        
        exit("<h1><b> Wrong flag ! Try again.</b></h1>");
         
         
    }
    
?> 

