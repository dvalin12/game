<?php
require "db.php";
session_start();
require "teacher_lock.php";

$classid = $_SESSION['class'];

$resulted = mysqli_query($conn, "SELECT section FROM tbl_section WHERE id = '$classid'");
if(mysqli_num_rows($resulted) > 0) {
  while($row = mysqli_fetch_assoc($resulted)){

    $section = $row['section'];
   
  }
}


if(isset($_POST['student'])){

  header ("location: student_view.php");
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher | Students</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
            table {
        counter-reset: section;
      }

      .count:before {
        counter-increment: section;
        content: counter(section);
      }
  </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"> Students </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GAME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $fname, " ", $lname ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="teacher_student.php" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                classes/students
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="teacher_game.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Games
                
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="teacher_board.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Leader Boards
              </p>
           </a>
          </li>
          <li class="nav-item">
            <a href="teacher_gen.php" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Add Section</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="teacher_pending.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pending Students
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $section; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Students</a></li>
              <li class="breadcrumb-item active">Teacher  </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Sections</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
              <form method="POST">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $resulted = mysqli_query($conn, "SELECT tbl_acc.id, tbl_acc.fname, tbl_acc.mname, tbl_acc.lname FROM tbl_acc_student 
                      INNER JOIN tbl_acc ON tbl_acc_student.id = tbl_acc.id WHERE tbl_acc_student.section = '$classid' AND tbl_acc.active_acc = 1 AND tbl_acc.active = 1 ORDER BY tbl_acc.lname ASC");
                      if(mysqli_num_rows($resulted) > 0) {
                        while($row = mysqli_fetch_assoc($resulted)){

                          $id = $row['id'];
                          $fname = $row['fname'];
                          $mname = $row['mname'];
                          $lname = $row['lname'];

                          echo"<tr>
                            <td class='count'></td>
                          <td>$lname</td>
                          <td>$fname</td>
                          <td>$mname</td>
                            <td><a href=''><button type='submit' name='student' value='$id' class='btn btn-info btn-block'> View info </button></a></td>
                          </tr>";

                          if(isset($_POST['student'])){

                            $student = $_POST['student'];

                            $_SESSION['student'] = $student;
                            
                          }

                        }
                      }


                    ?>
        
                  </tbody>
                </table>
                    </form>
              </div>
            </div>
            <a href="teacher_dashboard.php"><button type="button" id=goback class="btn btn-secondary">Go back</button></a>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 Group 3</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

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
