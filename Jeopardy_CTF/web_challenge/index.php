<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Unavailable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            text-align: center;

            /*background-image: url('you_ve_been_hacked.jfif');*/
            background-size: 90% 90%;
            background-repeat: no-repeat;
            background-position:center ;
            min-height: 70vh; /* Ensure the page takes at least the full viewport height */
            position: relative;
           
        }

        .container {
            margin: 10% auto;
            max-width: 600px;
            background-color: #ffffff;
            background-position:center top;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            opacity:.5     }

        h1 {
            color: #f70000;
        }

        p {
            color: #333333;
        }

        .info {
            font-size: 16px;
            margin-top: 20px;
        }

        .hacker-logo {
            font-family: 'Brush Script MT', cursive; 
            font-size: 36px;
            letter-spacing: 3px;
            color: #000;
            background-color: #e90c0c;
            padding: 10px 50px;
            text-transform: uppercase;
            text-transform: uppercase;
            text-align: center top;
            text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.2);
            transform: perspective(500px) rotateX(30deg);
            text-decoration: none; /* Remove underline from the link */
            color: #021604; /* Set the default text color */
            transition: color 0.3s, text-shadow 0.3s; /* Add transition for smooth effect */
        }

        /* Define the hover effect */
        .hacker-logo:hover {
            color: rgb(13, 235, 24); /* Change text color to blue on hover */
            text-shadow: 0 0 5px rgb(12, 158, 31); /* Add a text shadow for a glow effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>YOU HAVE BEEN HACKED!</h1>
        <p><b>by the hacker team "CyberNoobs"</b></p>
        <p>click below</p>
            
        <a class="hacker-logo" href="index.php?page=info.html">And now ?</a>
        
    </div>

    <form action="validate_file.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="upload file" name="submit">
    </form>
        
        <?php
        
        $file=$_GET['page'];

        if(isset($file)){
            include($file);
        }
        
    
        ?>
</body>
</html>
