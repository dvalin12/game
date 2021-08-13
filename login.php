<?php
require "db.php";
session_start();

if(isset($_SESSION['username']) == FALSE){


    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $resulted = mysqli_query($conn, "SELECT * FROM tbl_acc WHERE username = '$username'");
        if(mysqli_num_rows($resulted) > 0) {
        $row = mysqli_fetch_assoc($resulted);

        $pass = $row['password'];
        $type = $row['acc_type'];
        $active = $row['active_acc'];

            if($password == $pass){

                if($active == 1){
                
                    switch($type){
                        case 1: 
                            $_SESSION["username"] = $username;

                            header("location: teacher_dashboard.php");
                            break;
                        case 2: 
                            $_SESSION["username"] = $username;

                            header("location: student_dashboard.php");
                            break;
                        default:
                            break;
                    }
                }
                else{
                    $inactive = true; 
                }
            }
            else{
                $xpass = true; 
            }
        }
        else{
            $nonexist = true;
        }

    }
}
else{

    $username = $_SESSION["username"];

    $resulted = mysqli_query($conn, "SELECT * FROM tbl_acc WHERE username = '$username'");
    if(mysqli_num_rows($resulted) > 0) {
    $row = mysqli_fetch_assoc($resulted);

    $type = $row['acc_type'];

    }

    switch($type){
        case 1: 

            header("location: teacher_dashboard.php");
            break;
        case 2: 
    
            header("location: student_dashboard.php");
            break;
        default:
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <title>Sign In</title>
    <style>
body {
  background-image: url('gbg2.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
    <!-- Custom fonts for this template-->
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>


<body>
    <form method="post">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-sm-6 mb-3 mb-sm-3">

                <div class="card o-hidden border-0 shadow-lg my-5 bg-light">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-white-900 mb-4 text-info"> G.A.M.E <br> Gamified Alternative Medium for Education</h1>
                                        
                                    </div>                                    
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="user" placeholder="Username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" name="password" required>
                                        </div>
                                      
                                        <button type="submit" class="btn btn-warning btn-user btn-block" name="login"><i class="fas fa-sign-in-alt"></i>
                                            Login
                                            </button>            
                                    </form>
                                    <hr>
                                    <?php 
                                      if (isset($nonexist)) {
                                        if ($nonexist == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                This username doesnt exist.
                                          </div>
                                          ';
                                        }
                                      }

                                      if (isset($xpass)) {
                                        if ($xpass == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                You have entered the Wrong Password.
                                          </div>
                                          ';
                                        }
                                      }
                                      if (isset($inactive)) {
                                        if ($inactive == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                This Account is inactive, please verify your account through email.
                                          </div>
                                          ';
                                        }
                                      }
                                            ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="password-reset/pass_reset.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="reg_type_select.php">Create an Account!</a>
                                    </div>
                                    <hr>
                                </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>
    <!-- jQuery -->
<script src="jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/pages/dashboard3.js"></script>

</body>

</html>