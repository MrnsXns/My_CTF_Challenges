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

if ($stmt = $con->prepare('SELECT RE,WEB,CRYPTO,PWN FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $_SESSION['name']);
	$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($RE,$WEB,$CRYPTO,$PWN);
    $stmt->fetch();
   
    /*if ($CRYPTO==1){
        echo "<script>document.getElementById('CRYPTO').disabled=true;</script>";
    }*/
    
}else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
    echo 'Could not prepare statement!';
}
$stmt->close();   
$con->close();


/*the above code will check if the user is logged in. If they are not, they will be redirected to the login page.*/

// We need to use sessions, so you should always start sessions using the below code.

#session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: http://localhost/Jeopardy_CTF/login/login.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

   
    
    <link rel="stylesheet" type="text/css" href="challenges_style.css">
    <link rel="stylesheet" type="text/css" href="navbar_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> <!--may not be necessary-->
    
</head>

<script>
    
    



    // Function to toggle/remove the modal dialog
    function showChallenge(clickedButton) {
        var modal = document.getElementById('myModal');
        

        var challenge_descr="";

        const elementToBlur = document.getElementById("container");  

        if (clickedButton.id=='RE'){
            
            
            challenge_descr=`<h1>This is the first line.</h1>
            <h2>This is the second line.</h2>
            And this is the third line.`;

            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').setAttribute("download","re_challenge_binary");
            document.getElementById('anchor').href='http://STATIC_IP_OF_SERVER/Jeopardy_CTF/re_challenge/feelLucky.c';//enter path of binary
            document.getElementById('anchor').textContent="Download binary";
            document.getElementById('flagForm')[0].name=  'REflag';
            

            
                              
        }
        if (clickedButton.id=='WEB'){
           
            challenge_descr="Web challenge description";
            
            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').href='web_challenge/index.php';//enter path of webpage
            document.getElementById('anchor').textContent="URL";
            document.getElementById('flagForm')[0].name= 'WEBflag';

        }
        if (clickedButton.id=='Crypto'){
            
            challenge_descr=`<p>In this challenge you are asking to find the key (or part of it) in order to obtain the flag.<p>
            <p>An information leakage occured by an insider. The insider confess that he reveals the employee id and password 
            of <b>admin</b> who has access to the server room (<b>eid:43567289,pass:4!25as%8F</b>). I have at my disposal the encrypted 
            messages (<u>ONE TIME PAD</u>) exchanged between the perpetrator and the insider. Can you decoded them and retrieve the flag? 
            All the messages have been encrypted with the same OTP key.</p>
            <p><i><u>Hint 1:</u></i> The flag has the format <i>flag{...}</i></p>
            <p><i><u>Hint 2:</u></i> Every encrypted message and the key have the same length</p>
            <p><i><u>Hint 3:</u></i> The key consist of English words </i></p>`;

            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').href='http://STATIC_IP_OF_SERVER/Jeopardy_CTF/crypto_challenge/messages.txt';//enter path of file(s)
            document.getElementById('anchor').textContent="Download encrypted messages";
            document.getElementById('flagForm')[0].name= 'CRYPTOflag';
        }

        /*to do */
        if (clickedButton.id=='?'){

            challenge_descr="COMING SOON";
        }
        
                
        if (modal.style.display === 'none' || modal.style.display === '') {
            modal.style.display = 'block';
            elementToBlur.classList.toggle("blur"); 
            
                       
      } 
      else {
        modal.style.display = 'none';
        elementToBlur.classList.remove("blur");
        document.getElementById('flagForm')[0].name= 'flag';
        document.getElementById('flagForm')[0].value='';
        document.getElementById('anchor').removeAttribute("download");
      }
      

    }    
  </script>



<body>
    
    
        <div class="navbar">
           <a class="active" href="http://localhost/Jeopardy_CTF/main_/profile_page.php"><i class="fa-solid fa-ranking-star"></i><b><u><?=$_SESSION['name']?></u></b></a>
          
           <a href="http://localhost/Jeopardy_CTF/main_/logout.php"><i class="fas fa-sign-out-alt"></i><b><u>Logout</u></b></a>
        </div>
     

    <div class="container" id="container">
       

        <button class="box" id="RE"  onclick="showChallenge(this) ">
        
            <h1 id="RE_header"> <b> Reverse Engineering </b> </h1>
        </button>
        
        
        <button class="box" id="WEB" onclick="showChallenge(this)">
        
            <h1 id=WEB_header><b>WEB </b></h1>
        
        </button>

        <button class="box" id="Crypto" onclick="showChallenge(this)">
            
            <h1 id="CRYPTO_header"><b>Crypto</b></h1>
            
           
        </button>
        
        
        <button class="box" id="?" onclick="showChallenge(this)"> 
            
            <h1 id="?_header"><b>?</b></h1>

        </button>

        

    </div>

    <div id="myModal">
        
        <article id="modalContent">No description.</article>
        <a id="anchor" href="" title="" >Empty</a>

        <div class="challengeButton"></div>

        <form id="flagForm" action="validate_flag.php" method="post">
            <label id="userInput">Enter flag: </label>
            <input type="text" id="flag" name="flag" value="" autocomplete="off">
            <input type="submit" value="check flag">
          </form>
          
            <button id="chalBut" onclick="showChallenge(this)">Close</button>
        </div>
    </div>

    <!--disable completed challenges -->
    <script>

        var c= "<?php echo $CRYPTO;?>"; 
        var r= "<?php echo $RE;?>";
        var w= "<?php echo $WEB;?>";
        var p= "<?php echo $PWN;?>";
            if (c==1){
                document.getElementById("CRYPTO_header").style.color="blue";
                document.getElementById("CRYPTO_header").innerText="CRYPTO \n\(completed)";
                document.getElementById("Crypto").disabled=true;
             }
             if (r==1){
                document.getElementById("RE_header").style.color="blue";
                document.getElementById("RE_header").innerText="Reverse Engineering \n\(completed)";
                document.getElementById("RE").disabled=true;
             }
             if (w==1){
                document.getElementById("WEB_header").style.color="blue";
                document.getElementById("WEB_header").innerText="WEB \n\(completed)";
                document.getElementById("WEB").disabled=true;
             }
             if (p==1){
                document.getElementById("PWN_header").style.color="blue";
                document.getElementById("PWN_header").innerText="PWN \n\(completed)";
                document.getElementById("PWN").disabled=true;
             }
             

    </script>
   
    
    
    <!--validate with an asynchronous way    
    <script>
        $(document).ready(function() {
            $('#flagForm').on('submit', function(e) {
                e.preventDefault();
                // Validate form data
                var formData = {
                    username: $('#flag').val(),
                    //password: $('#password').val()
                };
                $.ajax({
                    type: 'POST',
                    url: 'validate_flag.php',
                    data: formData,
                    success: function(response) {
                        // Handle the validation response here (e.g., show errors or success message)
                        console.log(response);
                        
                    }
                });
            });
        });
        </script>-->

</body>
</html>


