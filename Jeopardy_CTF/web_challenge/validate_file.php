<?php
if (isset($_POST["submit"])) {
     // Directory to store uploaded files
    $targetFile = basename($_FILES["fileToUpload"]["name"]);
    
    $username=$_SESSION['name'];
    $proper_file_name=(string)$username.'show_m3_the_P@sS.2gd';
    
    if ($targetFile===$proper_file_name){
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            #echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
            #echo $fileContents;

        
            
            $fileContents = file_get_contents($targetFile);
            if (preg_match("/<\?php|eval\(|system\(|shell_exec\(|passthru\(|exec\(/i", $fileContents)) {
                echo "The uploaded file appears to contain PHP code, which is not allowed.<br>";
                
               

                if (file_exists($targetFile)) {
                    if (unlink($targetFile)) {
                        echo "File '$targetFile' has been successfully deleted.";
                    } 
                    else {
                        echo "Failed to delete the file '$targetFile'.";
                    }
                } 
                else {
                    echo "File '$targetFile' does not exist.";
                }
            } 
            else {
                echo "The uploaded file does not contain PHP code.<br>";
                //secret key
                echo "Secret key: 40d18115acf930fc2bef4ae7bd115765";

            }

        }
        else{
            echo "A problem occurs during file uploading!";
        }
    }   

        
    else {
        echo "Wrong file name. Try again!";
    }
}
    

?>
