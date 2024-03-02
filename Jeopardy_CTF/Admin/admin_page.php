


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv='refresh' content='5'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>JeopardyCTF | Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        

    </head>

   
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




?>

    <body class="sb-nav-fixed">
      
        <div id="layoutSidenav">
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage users</h1>
                        <ol class="breadcrumb mb-4">
                            <!--add new user--->
                            <li class="breadcrumb-item"><a href='http://<?=$_SESSION["server_ip"]?>/Jeopardy_CTF/registration/registration_form.php' title='Add new user'><i class="fa fa-user-plus"></i><b>  Add new user </b></a></li>
                            
                        </ol>
            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Registered User Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                    <th>USER ID &nbsp &nbsp</th>    
                                  <th>Username &nbsp </th>
                                  
                                  <th>Email &nbsp  &nbsp</th>
                                  <th>RE challenge &nbsp</th>
                                  <th>WEB challenge &nbsp</th>
                                  <th>CRYPTO challenge &nbsp</th>
                                  <th>STEGO challenge &nbsp</th>
                                  
                                  <th>points &nbsp</th>
                                  <th>challenge_timestamp &nbsp</th>
                                  <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                              <?php $ret=mysqli_query($con,"select * from users");
                              $cnt=1;
                              while($row=mysqli_fetch_array($ret))
                              {?>
                              <tr>
                                  <td><?php echo $row['userId'];?></td>
                                  
                                  <td><?php echo $row['username'];?></td>
                                  
                                  <td onclick='l();'><?php echo $row['email'];?>&nbsp &nbsp</td>

                                  <td><?php $userid=$row['userId'];
                                    $usrname=$row['username'];
                                    if ($row['RE']!=0) {echo '
                                    <i class="fa fa-check"></i>                                    
                                    <a href="manage_user.php?Clear=1&chal_type=RE&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to CLEAR Reverse Engineering challenge for USER='.$usrname.'\')" title="press to CLEAR challenge" >CLEAR</a>';
                                    }
                                    else {echo '
                                    <i class="fa fa-ban"></i> 
                                    <a href="manage_user.php?Set=1&chal_type=RE&chal_points=35&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to SET Reverse Engineering challenge for USER='.$usrname.'\')" title="press to SET challenge" >SET</a>';
                                    };?></td> <!-- display 'tick' icon if challenge has been solved else '0'-->
                                                   
                                  <td><?php $userid=$row['userId'];
                                   $usrname=$row['username'];
                                   if ($row['WEB']!=0) {echo '
                                    <i class="fa fa-check"></i>                                    
                                    <a href="manage_user.php?Clear=1&chal_type=WEB&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to CLEAR Web Exploitation challenge for USER='.$usrname.'\')" title="press to CLEAR challenge" >CLEAR</a>';
                                    }
                                    else {echo '
                                    <i class="fa fa-ban"></i> 
                                    <a href="manage_user.php?Set=1&chal_type=WEB&chal_points=30&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to SET Web Exploitation challenge for USER='.$usrname.'\')" title="press to SET challenge" >SET</a>';
                                    };?></td>

                                  <td><?php $userid=$row['userId']; 
                                    $usrname=$row['username'];
                                    if ($row['CRYPTO']!=0) {echo '
                                    <i class="fa fa-check"></i>                                    
                                    <a href="manage_user.php?Clear=1&chal_type=CRYPTO&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to CLEAR Cryptography challenge for USER='.$usrname.'\')" title="press to CLEAR challenge" >CLEAR</a>';
                                    }
                                    else {echo '
                                    <i class="fa fa-ban"></i> 
                                    <a href="manage_user.php?Set=1&chal_type=CRYPTO&chal_points=15&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to SET Cryptography challenge for USER='.$usrname.'\')" title="press to SET challenge" >SET</a>';
                                    };?></td>
                                  
                                  <td><?php $userid=$row['userId'];
                                    $usrname=$row['username'];
                                    if ($row['STEGO']!=0) {echo '
                                    <i class="fa fa-check"></i>                                    
                                    <a href="manage_user.php?Clear=1&chal_type=STEGO&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to CLEAR Steganography challenge for USER='.$usrname.'\')" title="press to CLEAR challenge" >CLEAR</a>';
                                    }
                                    else {echo '
                                    <i class="fa fa-ban"></i> 
                                    <a href="manage_user.php?Set=1&chal_type=STEGO&chal_points=20&Userid='.$userid.'" onClick="return confirm(\'Are you sure the you want to SET Steganography challenge for USER='.$usrname.'\')" title="press to SET challenge" >SET</a>';
                                    };?></td>
                                  
                                  <td><?php echo $row['points'];?></td>
                                  <td><?php echo $row['challenge_timestamp'];?></td>
                                  <td>
                                  <!--delete user--->                                 
                                  <a href="manage_user.php?delUserid=<?php echo $row['userId'];?>" title='Delete user' onClick="return confirm('Do you really want to delete user <?php echo $row['username'];?>?');"><i class="fa fa-user-minus"></i></a>
                                  <a href="edit_user.php?Userid=<?php echo $row['userId'];?>&usrnm=<?php echo $row['username'];?>&email=<?php echo $row['email'];?>" title='Edit email and/or username of this user'><i class="fa fa-pen"></i></a>
                                  
                                  </td>
                                  <?php $cnt=$cnt+1; }?>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
 
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
        
        
        
    </body>
</html>

