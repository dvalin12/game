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

  if ($type == 2){

    //Save the full name of the username to variable. 
    $resulted = mysqli_query($conn, "SELECT tbl_section.section,tbl_acc_student.age,
    tbl_acc_student.gender,tbl_acc_teacher.school, tbl_acc.id, tbl_acc.fname,tbl_acc.lname FROM tbl_acc 
    INNER JOIN tbl_acc_student ON tbl_acc.id = tbl_acc_student.id
    INNER JOIN tbl_section on tbl_acc_student.section = tbl_section.id
    INNER JOIN tbl_acc_teacher ON tbl_acc_student.teacher = tbl_acc_teacher.id
    WHERE tbl_acc.username ='$username'");
    if(mysqli_num_rows($resulted) > 0) {
    $row = mysqli_fetch_assoc($resulted);

    $id = $row['id'];
    $fname = $row['fname'];   
    $lname = $row['lname'];
    $section = $row['section'];
    $age = $row['age'];
    $gender = $row['gender'];
    $school = $row['school'];

    }
  }
  else {
    //Head to appropriate landing page if account type is wrong. 
    header ("location: teacher_dashboard.php");
  }

  }

  ?>