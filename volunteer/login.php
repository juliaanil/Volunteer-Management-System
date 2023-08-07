<?php

session_start();

require "class/db.php";

if($_SERVER['REQUEST_METHOD']=='POST')
{

    if(isset($_POST['login']))
    {
    
        $vemail = $_POST['vemail'];
        $vpswd = $_POST['vpswd'];
    
        if($vemail != "" && $vpswd !="")
        {
                $resultset = $db->query("Select * from tbl_volunteer where vemail='$vemail' ");
    
                if($resultset->num_rows)
                {
                    $row = $resultset->fetch_assoc();
                  
                    if ($row['vpswd'] === $vpswd && $row['vstatus'] === "approved")
                    {
                        $_SESSION['vemail'] = $row['vemail'];
                        $_SESSION['vpswd'] = $row['vpswd'];
            
                        if(isset($_SESSION['vemail']))
                        {
                            header("location: index.php");
                        }
                    }
                    else{
                        echo " 
                        <script> alert('Invalid email id or password! Please try again.')
                        </script> ";
                    }
                }
                else{
                    echo " 
                        <script> alert('Incorrect email id or password! Please try again.')
                        </script> ";
                }
            }
            else{
                echo "
                <script> alert('Some fields are empty. All fields required!')
                </script> ";
            }
        }
       
    }






?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/main.css" rel="stylesheet">

</head>

<body class="bg-gradient-light ">
<form method="POST" action="">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-middle ">

            <div class="col-xl-5 col-lg-10 col-md-9 align-items-center">

                <div class="card o-hidden border-0 shadow-lg p-0 my-5 mt-8">
                    <div class="card-body mb-0 p-0 bg-gray-100">
                        <!--<div class="row"> -->
                            
                           <!-- <div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                    <h2 class="h4 text-black font-bold mb-4 uppercase tracking-wide">Volunteer Login</h2>
                                        <h1 class="h4 text-gray-900 mb-4">Volunteer Management for Non-Profits and Community Groups</h1>
                                        <br>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" name="vemail" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter email-id...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="vpswd" class="form-control form-control-user"
                                     
                                            id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                            </div>
                                        </div>
                                       
                                        <input type='submit' name="login" value="Login" class="btn btn-primary btn-user btn-block"><br>
        <p style="text-align:center;"><a style="color: blue;" href="registervolunteer.php">No account yet! Click Here to register</a></p>
                                    </input>
                                        
                                    </form>
                                    <hr>
                                </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</form>
</body>

</html>