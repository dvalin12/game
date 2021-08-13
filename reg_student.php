<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "db.php";

    if(isset($_POST['submit'])){

        $user = $_POST["user"];
        $pass1 = $_POST["password1"];
        $pass2 = $_POST["password2"];
        $email = $_POST["email"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $gender = $_POST["gender"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $code = $_POST["code"];

        $sql = "SELECT * FROM tbl_acc WHERE username = '$user'";
        $result = $conn->query($sql);
        $result_numrows = $result->num_rows;

        if($result_numrows != 1){

            $sql = "SELECT * FROM tbl_acc WHERE email = '$email' AND active_acc = 1";
            $resultem = $conn->query($sql);
            $result_email = $resultem->num_rows;

            if($result_email == 0){

                if($pass1 == $pass2){
                    if(isset($_POST['check'])){
                        $resulted = mysqli_query($conn, "SELECT tbl_section.id, tbl_code.code,
                        tbl_code.times_allowed, tbl_section.section, tbl_section.teacher FROM tbl_code 
                        INNER JOIN tbl_section ON tbl_code.section = tbl_section.id
                        WHERE tbl_code.code = '$code' AND tbl_section.active = 1");
                        if(mysqli_num_rows($resulted) > 0) {
                        $row = mysqli_fetch_assoc($resulted);
                                
                                $secid = $row['id'];
                                $code = $row['code'];
                                $count = $row['times_allowed'];
                                $section = $row['section'];
                                $teacher = $row['teacher'];

                            if($count != 0){

                                $sql = "INSERT INTO tbl_acc (username, password, email, acc_type, fname, mname, lname, phone, active_acc,active) 
                                VALUES ('$user', '$pass1', '$email', (SELECT id FROM tbl_acc_type WHERE type = 'student'), '$fname',
                                '$mname', '$lname', '$phone', 0,1)";
                                if ($conn->query($sql) === FALSE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }

                                $sql = "INSERT INTO tbl_acc_student (id, age, gender, section, teacher, e_verified,pending) VALUES ((SELECT id FROM tbl_acc WHERE username = '$user'), 
                                '$age', '$gender', (SELECT id FROM tbl_section WHERE section = '$section'), (SELECT id FROM tbl_acc WHERE id = '$teacher'),0,1)";
                                if ($conn->query($sql) === FALSE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }

                                $sql = "UPDATE tbl_code SET times_allowed = times_allowed - 1 WHERE code = '$code'";
                                if ($conn->query($sql) === FALSE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }

                                $success = true;

                                $token = md5($email).rand(10,9999);
    
                            $expFormat = mktime(
                            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                            );
                        
                        $expDate = date("Y-m-d H:i:s",$expFormat);
                        
                        $update = mysqli_query($conn,"UPDATE tbl_acc SET reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $email . "' AND active_acc = 0 AND active = 1");
                        
                        $link = "<a href='localhost/game/ver_success.php?key=".$email."&token=".$token."'>verify now</a>";
                
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
                            else{
                                $notusable = true;
                            }
                        }
                        else{
                            $nocode = true;
                        }
                    }
                    else{
                        $nocheck = true; 
                    }
                }
                else{
                    $passnomatch = true;
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
                    
                            <form class="user" method="POST">
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="text" class="form-control form-control-user" id="user" name="user"
                                        placeholder="Username" required>
                                </div>
                                 <?php
                                    if(isset($existing)){
                                        if($existing == true){
                                            echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            username already exists, please enter another username.
                                             </div>';
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
                                    if(isset($passnomatch)){
                                        if($passnomatch == true){
                                            echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            passwords do not match, please enter again.
                                             </div>';
                                        }
                                    }
                                    ?>
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="text" class="form-control form-control-user" id="user" name="email"
                                        placeholder="Email" required>
                                </div>
                                <?php
                                if(isset($emailex)){
                                    if($emailex == true){
                                        echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        email already exists, please enter another email.
                                         </div>';
                                    }
                                }
                                ?>
                                <br>

                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-3"> <!---first name-->
                                        <input type="text" class="form-control form-control-user" id="FirstName" name="fname"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-3"> <!---last name-->
                                        <input type="text" class="form-control form-control-user" id="MiddleName" name="mname"
                                            placeholder="Middle Name" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-3"> <!---last name-->
                                        <input type="text" class="form-control form-control-user" id="LastName" name="lname"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-3 text-secondary">
                                    <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" id="inputState" name="gender" required>
                                                <option value = "Male">Male</option>
                                                <option value = "Female">Female</option>
                                                </select>
                                            </div>
                                </div>
                                <div class="col-sm-6 mb-3 my-2 text-secondary"> 
                                <label for="inputState" class="form-label"></label>
                                        <input type="text" class="form-control form-control-user" id="age"
                                            name="age" placeholder="Age" required>
                                </div>
                                </div>
                                <div class="input-group mb-3" > <!--- username-->
                                    <input type="tel" class="form-control form-control-user" id="user" name="phone"
                                        placeholder="Phone" required>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-3 text-secondary">
                                    <input type="text" class="form-control form-control-user" id="code" name="code" placeholder="Code" required>
                                </div>
                                <?php
                                    if(isset($nocode)){
                                        if($nocode == true){
                                            echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            this code doesnt exist, please enter again.
                                             </div>';
                                        }
                                    }
                                    ?>
                                </div>
                               
                                
                                
                                <br>
                                <div class="form-check mb-3 text-white">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" name="check">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        I agree to the <a href="#">Terms & Condition</a>
                                     </label>
                                </div>
                                <?php
                                    if(isset($nocheck)){
                                        if($nocheck == true){
                                            echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            please agree to terms and conditions.
                                             </div>';
                                        }
                                    }

                                    if(isset($notusable)){
                                        if($notusable == true){
                                            echo '<div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            this code is expired, please request a new code from your teacher.
                                             </div>';
                                        }
                                    }
                                    ?>
                                </form>
                                <button type="submit" name="submit" class="btn btn-primary">
                                Register Account
                                </button>
                                <hr>
                                </form>
                                <?php
                                if (isset($success)) {
                                        if ($success == true) {
                                            echo'
                                            <div class="alert with-close alert-success alert-dismissible fade show alert-successcolor">
                                                <span class="badge badge-pill badge-success">Success</span>
                                                account created successfully. 
                                            </div>
                                          ';
                                        }
                                      }
                                ?>
                                
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
    <<!-- jQuery -->
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
