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
<?php

$type = $_POST["type"];

echo $type; 

if(isset($_POST['proceed'])){

    switch($type){
        case 'student':
            header("location: reg_student.php");
            break;
        case 'teacher':
            header("location: reg_teacher.php");
            break;
        default:
        echo "something???";
        break;
    }

}

?>


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
                                        <h1 class="h2 text-white-900 mb-4 text-info"> Select <br> User type to register</h1>
                                        
                                    </div>                                    
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                        <div class="col-sm-12 text-secondary">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>User Type</label>
                                                <select class="form-control" id="inputState" name="type">
                                                <option value="teacher">Teacher</option>
                                                <option value="student"> Student</option>
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="proceed" class="btn btn-success btn-user btn-block"><i class="fas fa-sign-in-alt"></i>
                                            Proceed to Create Account
                                            </button>
                                        
                                    </form>
                                    <hr>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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