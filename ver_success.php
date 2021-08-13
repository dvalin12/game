<?php
require "db.php";

if($_GET['key'] && $_GET['token']){
    include "db.php";
    $email = $_GET['key'];
    $token = $_GET['token'];
    $query = mysqli_query($conn,"SELECT * FROM tbl_acc WHERE reset_link_token='".$token."' and email='".$email."'");
    $curDate = date("Y-m-d H:i:s");
        if (mysqli_num_rows($query) > 0) {
            $row= mysqli_fetch_array($query);
                if($row['exp_date'] >= $curDate && $row['active_acc'] == 0){

                            $id = $row['id'];
                            $acc_type = $row['acc_type'];

                            switch($acc_type){

                                case '1': 
                                    $sql = "UPDATE tbl_acc SET active_acc = 1 WHERE id = '$id'";
                                        if ($conn->query($sql) === FALSE) {
                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                        }

                                        $sql = "UPDATE tbl_acc SET reset_link_token = 0, exp_date = '0000-00-00 00:00:00' WHERE email = '$email'";
                                        if ($conn->query($sql) === FALSE) {
                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                        }

                                        $success_teacher = true;
                                        break;
                                case '2': 
                                    $sql = "UPDATE tbl_acc_student SET e_verified = 1 WHERE id = '$id'";
                                    if ($conn->query($sql) === FALSE) {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }

                                    $sql = "UPDATE tbl_acc SET reset_link_token = 0, exp_date = '0000-00-00 00:00:00' WHERE email = '$email'";
                                    if ($conn->query($sql) === FALSE) {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }

                                    $success_student = true;
                                    break; 

                            }
                }
                else{
                    $lock = true; 
                }
        }
}
else{
    header ("location: reg_type_select.php");
}

?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <title>Email Verification</title>
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
                                        <h1 class="h2 text-white-900 mb-4 text-info"> Email <br> Verification</h1>


                                    <?php 
                                      if (isset($success_teacher)) {
                                        if ($success_teacher == true) {
                                          echo '
                                          <div class="form-group">
                                          <div class="form-group" action="pass_token.php">
                                           <center><h4> Your email has been verified, you may now login. </h4></center>
                                          </div>
                                      </div>                                    
                                      
                                      <hr>
                                          ';
                                        }
                                      }
                                      if (isset($success_student)) {
                                        if ($success_student == true) {
                                          echo '
                                          <div class="form-group">
                                          <div class="form-group" action="pass_token.php">
                                           <center><h4> Your email has been verified, please refer to your teacher for the final validation. </h4></center>
                                          </div>
                                      </div>                                    
                                      
                                      <hr>
                                          ';
                                        }
                                      }
                                      if (isset($lock)) {
                                        if ($lock == true) {
                                          echo '
                                          <div class="form-group">
                                          <div class="form-group" action="pass_token.php">
                                           <center><h4> Sorry, This link is now expired. </h4></center>
                                          </div>
                                      </div>                                    
                                      
                                      <hr>
                                          ';
                                        }
                                      }
                                            ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Login</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="password-reset/forgot_pass.html">Forgot Password?</a>
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