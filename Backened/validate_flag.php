<?php
    
	if (isset($_POST['REflag']) && hash('sha256',$_POST['REflag'])=="hash256 RE flag goes here"){
        echo "RE flag ok";
       
        
    }
    elseif (isset($_POST['WEBflag']) && hash('sha256',$_POST['WEBflag'])=="hash256 WEB flag goes here"){
        echo "WEB flag ok";
        
    }
    elseif (isset($_POST['CRYPTOflag']) && hash('sha256',$_POST['CRYPTOflag'])=="hash256 CRYPTO flag goes here"){
        echo "CRYPTO flag ok";
        
    }
    else{
        echo "something went wrong!";
    }
    
?> Scanning
