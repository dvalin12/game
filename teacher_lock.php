<?php
  
  //Redirect to login page if a session doesnt exist.
  if(empty($_SESSION['username' ])) {
    header("location: login.php");
  }
  else{
    //Save the existing username from current session. 
    $username = $_SESSION["username"];
  }
  //Save the account type of the username to variable. 
  $resulted = mysqli_query($conn, "SELECT acc_type FROM tbl_acc WHERE username ='$username'");
  if(mysqli_num_rows($resulted) > 0) {
   $row = mysqli_fetch_assoc($resulted);

      $type = $row['acc_type'];

  if ($type == 1){

    //Save the full name of the username to variable. 
    $resulted = mysqli_query($conn, "SELECT * FROM tbl_acc WHERE username ='$username'");
    if(mysqli_num_rows($resulted) > 0) {
    $row = mysqli_fetch_assoc($resulted);

    $id = $row['id'];
    $fname = $row['fname'];   
    $lname = $row['lname'];

    }
  }
  else {
    //Head to appropriate landing page if account type is wrong. 
    header ("location: student_dashboard.php");
  }

  }

  ?>