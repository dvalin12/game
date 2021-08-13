<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "db.php";


if(isset($_POST["register"])){

    $user = $_POST["user"];
    $pass1 = $_POST["password1"];
    $pass2 = $_POST["password2"];
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $school = $_POST["school"];
    $phone = $_POST["phone"];
    $sub = $_POST["sub"];

     //Query to check if a username of the value exists in database 
     $sql = "SELECT * FROM tbl_acc WHERE username = '$user' AND active_acc = 1 AND active = 1";
     $result = $conn->query($sql);
     $result_numrows = $result->num_rows;

     if($result_numrows != 1){
         
        $sql = "SELECT * FROM tbl_acc WHERE email = '$email' AND active_acc = 1 AND active = 1";
        $resultem = $conn->query($sql);
        $result_email = $resultem->num_rows;

            if($result_email == 0){

                if($pass1 == $pass2){
                    if (isset($_POST['check'])){

                        $sql = "INSERT INTO tbl_acc (username, password, email, acc_type, fname, mname, lname, phone, active_acc, active) VALUES ('$user', '$pass1', '$email',
                        (SELECT id FROM tbl_acc_type WHERE type = 'teacher'), '$fname', '$mname', '$lname', '$phone', 0,1)";
                            if ($conn->query($sql) === FALSE) {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                            else{

                                $resulted = mysqli_query($conn, "SELECT MAX(id) FROM tbl_acc");
                                if(mysqli_num_rows($resulted) > 0) {
                                $row = mysqli_fetch_assoc($resulted);
                                
                                        $id = $row['MAX(id)'];
                                }
                                $sql = "INSERT INTO tbl_acc_teacher (id, subject, school) VALUES ('$id', '$sub', '$school')";
                                if ($conn->query($sql) === FALSE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                                else{
                                    $success = true; 
                                }

                                $token = md5($email).rand(10,9999);
        
                                $expFormat = mktime(
                                date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                                );
                            
                            $expDate = date("Y-m-d H:i:s",$expFormat);
                            
                            $update = mysqli_query($conn,"UPDATE tbl_acc SET reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $email . "' AND active_acc = 0 AND active = 1");
                            
                            $link = "<a href='localhost/game/ver_success.php?key=".$email."&token=".$token."'>Verify Now</a>";
                    
                                require 'PHPMailer-master/src/Exception.php';
                                require 'PHPMailer-master/src/PHPMailer.php';
                                require 'PHPMailer-master/src/SMTP.php';
                    
                                $mail = new PHPMailer();
                                $mail->IsSMTP();
                                $mail->Mailer = "smtp";
                    
                                $mail->SMTPDebug  = 1;  
                                $mail->SMTPAuth   = TRUE;
                                $mail->SMTPSecure = "tls";
                                $mail->Port       = 587;
                                $mail->Host       = "smtp.gmail.com";
                                $mail->Username   = "educgame70@gmail.com";
                                $mail->Password   = "gameplatform";
                    
                                $mail->IsHTML(true);
                                $mail->AddAddress("$email", "$name");
                                $mail->SetFrom("educgame70@gmail.com", "G.A.M.E Support Team");
                                $mail->Subject = "Email Verification";
                                $content = "Click On This Link to Verify your account: $link ";
                    
                                $mail->MsgHTML($content); 
                                if(!$mail->Send()) {
                                    $error = true;
                                } else {
                                    $success = true; ;
                                }

                                header("location: reg_success.php");


                            }
                    }
                    else{
                        $termserr = true;
                    }
                }
                else{
                    $passerr = true; 
                }
            }
            else{
                $emailex = true;
            }
        }
     else{
         $existing = true;
     }
}





?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<title> Sign-Up </title>
<style>
body {
  background-image: url('gbg2.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
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

        <div class="row justify-content-center">

        <div class="col-sm-6 mb-3 mb-sm-3">

        <div class="card o-hidden border-1 shadow-lg my-5 bg-dark">
            <div class="card-body p-2">
                
                <div class="row" >
                    
                    <div class="col-lg-8-md-4">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h2 text-black-900 mb-5 text-danger">Create an Account!</h1>
                            </div>
                            <hr>
                    
                            <form class="user">
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="text" class="form-control form-control-user" id="user" name="user"
                                        placeholder="Username" required>
                                </div>
                                <?php 
                                      if (isset($existing)) {
                                        if ($existing == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                username already exists, please enter again.
                                          </div>
                                          ';
                                        }
                                      }
                                            ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="Password" name= "password1" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="RepeatPassword" name= "password2"placeholder="Repeat Password" required>
                                    </div>       
                                </div>
                                <?php 
                                      if (isset($passerr)) {
                                        if ($passerr == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                passwords do not match, please anter again.
                                          </div>
                                          ';
                                        }
                                      }
                                            ?>
                                <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email" required>
                                </div>
                                <?php 
                                      if (isset($emailex)) {
                                        if ($emailex == true) {
                                          echo '
                                          <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                <span class="badge badge-pill badge-danger">Error</span>
                                                email already exists, please enter again.
                                          </div>
                                          ';
                                        }
                                      }
                                            ?>
                                    
                                <br>

                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-3"> <!---first name-->
                                        <input type="text" class="form-control form-control-user" id="FirstName" name="fname"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-4"> <!---last name-->
                                        <input type="text" class="form-control form-control-user" id="MiddleName" name="mname"
                                            placeholder="Middle Name" required>
                                    </div>
                                    <div class="col-sm-4"> <!---last name-->
                                        <input type="text" class="form-control form-control-user" id="LastName" name="lname"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="text" class="form-control form-control-user" id="school" name="school"
                                        placeholder="School" required>
                                </div>
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="tel" class="form-control form-control-user" id="school" name="phone"
                                        placeholder="Phone Number" required>
                                </div>
                                        <form method = "POST">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <select class="form-control" id="inputState" name="sub">
                                                <option value="science">Science</option>
                                                <option value="math"> Math</option>
                                                <option value="english"> English</option>
                                                <option value="tle"> TLE</option>
                                                </select>
                                            </div>
                                        </form>
                                
                                
                                
                                
                                
                                <br>
                                <div class="form-check mb-3 text-white">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" name="check">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        I agree to the <a href="#">Terms & Condition</a>
                                     </label>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary">
                                Register Account
                                </button>

                                    <br> <br>
                                <?php 
                                      if (isset($success)) {
                                        if ($success == true) {
                                            echo'
                                            <div class="alert with-close alert-success alert-dismissible fade show alert-successcolor">
                                                <span class="badge badge-pill badge-success">Success</span>
                                                Account Created <a href="login.php">Login Now</a>
                                            </div>
                                          ';
                                        }
                                      }
                                            ?>

                                <!-- Modal -->
                                <!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        You have been registered! Press Proceed to Continue Login
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="login.php" class="registerbtn btn btn-primary">Proceed</a>
                                    </div>
                                    </div>
                                </div>
                                </div>-->
                                <hr>
                                
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
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
</head>
</html>
