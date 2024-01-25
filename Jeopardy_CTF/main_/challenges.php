<?php
session_start();

$_SESSION["server_ip"]=$_SERVER['SERVER_ADDR'];

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

if ($stmt = $con->prepare('SELECT RE,WEB,CRYPTO,STEGO FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $_SESSION['name']);
	$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($RE,$WEB,$CRYPTO,$STEGO);
    $stmt->fetch();
   
   
    
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
	header('Location: http://'.$_SERVER['SERVER_ADDR'].'/Jeopardy_CTF/login/login.php');
	exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

   
    
    <link rel="stylesheet" type="text/css" href="challenges_style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
</head>

<script>
    
    



    // Function to toggle/remove the modal dialog
    function showChallenge(clickedButton) {
        var modal = document.getElementById('myModal');
        

        var challenge_descr="";

        const elementToBlur = document.getElementById("container");  

        if (clickedButton.id=='RE'){
            
            
            challenge_descr=`<p style="font-size:80px;text-shadow: 4px 4px 4px red;">Fortunate Sam</p>
            <p style="font-size:50px;">35 points</p>
            <p>Sam is a self-proclaimed luck master who believes he can conquer any game of chance.
            Sam recently won a high-stakes game and bagged a grand prize, proudly securing the elusive flag. 
            So confident in his luck, Sam boasts that no one else possesses the skills to find the flag hidden within the game.</p> 
            <p>Use you RE skills to outsmart Sam and prove that luck favors the prepared mind.</p>
            <p> Good luck, challenger!</p>
            <p><i><u>Hint 1:</u></i> The flag has the format <i>flag_{...}.</i></p>
            <p><i><u>Hint 2:</u></i> You can apply any RE method you want.</p>`

            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').setAttribute("download","re_challenge_binary");
            document.getElementById('anchor').href='http://'+'<?=$_SESSION["server_ip"]?>'+'/Jeopardy_CTF/re_challenge/feelLucky.c';
            document.getElementById('anchor').textContent="Download binary";
            document.getElementById("anchor").style.color = "#ff0000";
            document.getElementById('flagForm')[0].name=  'REflag';
            

            
                              
        }
        if (clickedButton.id=='WEB'){
           
            challenge_descr=`<p style="font-size:80px;text-shadow: 4px 4px 4px red;">Site Compromised</p>
            <p style="font-size:50px;">30 points</p>
             <p>A notorious hacking group, known for their unparalleled skills, has compromise the website of CyberCom company.</p>
             <p>Your mission, as a cybersecurity professional, is to <b>find the hidden flag in CyberCom's legit website.</b></p>
             <p><i><u>Hint 1:</u></i> The flag has the format <i>flag{...}.</i></p>
             <p><i><u>Hint 2:</u></i> You must, somehow, gain access to CyberCom's compromised web server.</p>
             <p><i><u>Hint 3:</u></i> Hackers have a message for you.</p>`
            
            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').href='http://'+'<?=$_SESSION["server_ip"]?>'+'/Jeopardy_CTF/web_challenge/web_index.php';//enter path of webpage
            document.getElementById('anchor').textContent="URL";
            document.getElementById("anchor").style.color = "#ff0000";
            document.getElementById('flagForm')[0].name= 'WEBflag';

        }
        if (clickedButton.id=='Crypto'){
            
            challenge_descr=`<p style="font-size:80px;text-shadow: 4px 4px 4px red;">Silent Betrayal</p> 
            <p style="font-size:50px;">15 points</p> 
            <p>In this challenge you are asking to find the key in order to obtain the flag.<p>
            <p>An information leakage occured by an insider. The insider confess that he reveals the employee id and password 
            of <b>admin</b> who has access to the server room (<b>eid:43567289,pass:4!25as%8F</b>). You have access to the encrypted 
            messages (<u>ONE TIME PAD</u>) exchanged between the perpetrator and the insider. Can you decode them and retrieve the flag? 
            All the messages have been encrypted with the <u>same OTP key</u>.</p>
            <p><i><u>Hint 1:</u></i> The flag has the format <i>flag{...}.</i></p>
            <p><i><u>Hint 2:</u></i> Every encrypted message and the key have the same length.</p>
            <p><i><u>Hint 3:</u></i> Encrypted messages have derived from plaintexts that may contain words in bold. </i></p>`;

            document.getElementById('modalContent').innerHTML = challenge_descr;
            document.getElementById('anchor').href='http://'+'<?=$_SESSION["server_ip"]?>'+'/Jeopardy_CTF/crypto_challenge/messages.zip';//enter path of file(s)
            document.getElementById('anchor').textContent="Download encrypted messages";
            document.getElementById("anchor").style.color = "#ff0000";
            document.getElementById('flagForm')[0].name= 'CRYPTOflag';
        }

        
        if (clickedButton.id=='Stego'){

            challenge_descr=`<p style="font-size:80px;text-shadow: 4px 4px 4px red;">Stealthy Snapshots</p> 
            <p style="font-size:50px;">20 points</p> 
            <p>Welcome to the enigmatic realm of "Stealthy Snapshots". Uncover the hidden layers concealed within a seemingly ordinary image.
            The challenge begins with a single  image that harbors a labyrinth of secrets, leading you on a digital treasure hunt.</p>
            <p><i><u>Hint 1:</u></i> The flag has the format <i>flag{...}.</i></p>
            <p><i><u>Hint 2:</u></i> You must find 4 images in total. </p>
            <p><i><u>Hint 3:</u></i> Each image contains 1 or 2 camouflaged words (<b>5 words in total</b>).</p>
            <p><i><u>Hint 4:</u></i> Each image contains extra hints.</p>`

            document.getElementById('modalContent').innerHTML = challenge_descr;
           
            document.getElementById('anchor').href='http://'+'<?=$_SESSION["server_ip"]?>'+'/Jeopardy_CTF/steganography_challenge/init.zip';//doesnt work
            document.getElementById('anchor').textContent="Download image";
            document.getElementById("anchor").style.color = "#ff0000";
            document.getElementById('flagForm')[0].name= 'STEGOflag';
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
        
            
           <a id="username" href='http://<?=$_SESSION["server_ip"]?>/Jeopardy_CTF/main_/profile_page.php'><i class="fa-solid fa-ranking-star"></i><b><u><?=$_SESSION['name']?></u></b></a>
          
           <a href='http://<?=$_SESSION["server_ip"]?>/Jeopardy_CTF/main_/logout.php'><i class="fas fa-sign-out-alt"></i><b><u>Logout</u></b></a>
        
        
       </div>
     

    <div class="container" id="container" >
       
        
            <button class="box" id="RE"  onclick="showChallenge(this) ">
            
                <h1 id="RE_header"> <b> Reverse  Engineering </b></h1>
                
                
            </button>
        
        
            <button class="box" id="WEB" onclick="showChallenge(this)">
            
                <h1 id=WEB_header><b>WEB </b></h1>
            
            </button>
        <!--</div>-->

         <!--<div class="row">-->
            <button class="box" id="Crypto" onclick="showChallenge(this)">
                
                <h1 id="CRYPTO_header"><b>Crypto</b></h1>
                
            
            </button>
            
            
            <button class="box" id="Stego" onclick="showChallenge(this)"> 
                
                <h1 id="STEGO_header"><b>Steganography</b></h1>

            </button>

        </div>   

    

    <div id="myModal">
        
        <article id="modalContent">No description.</article>
        <a id="anchor" href="" title="" >Empty</a>

        <div class="challengeButton"></div>
 
        <form id="flagForm" action="validate_flag.php" method="post">
            <label id="userInput" style="color:white">Enter flag: </label>
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
        var s= "<?php echo $STEGO;?>";
            if (c==15){
                document.getElementById("CRYPTO_header").style.color="blue";
                document.getElementById("CRYPTO_header").innerText="CRYPTO \n\(Done)";
                document.getElementById("Crypto").disabled=true;
             }
             if (r==35){
                document.getElementById("RE_header").style.color="blue";
                document.getElementById("RE_header").innerText="Reverse Engineering \n\(Done)";
                document.getElementById("RE").disabled=true;
             }
             if (w==30){
                document.getElementById("WEB_header").style.color="blue";
                document.getElementById("WEB_header").innerText="WEB \n\(Done)";
                document.getElementById("WEB").disabled=true;
             }
             if (s==20){
                document.getElementById("STEGO_header").style.color="blue";
                document.getElementById("STEGO_header").innerText="Steganography \n\(Done)";
                document.getElementById("Stego").disabled=true;
             }
             

    </script>
   
    
    
    

</body>
</html>
