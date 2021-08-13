<?php 
require "db.php";
session_start();
require "teacher_lock.php";

if(isset($_POST['submit'])){

    $selgame = $_POST['game'];
    $sectionid = $_POST['sect'];
    $attempt = $_POST['attempt'];
    $deadline = $_POST['date'];

    if($selgame != 0){

        $resulted = mysqli_query($conn, "SELECT section FROM tbl_session WHERE active = 1 AND section = '$sectionid'");
            if(mysqli_num_rows($resulted) == 0) {

                $sql = "INSERT INTO tbl_session (game, attempts, teacher, section, end, active) VALUES ('$selgame',
                '$attempt',(SELECT id FROM tbl_acc WHERE id = $id), (SELECT id FROM tbl_section WHERE id = '$sectionid'), 
                '$deadline', 1)";
                if ($conn->query($sql) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    $fail = true; 
                }
                else{
                    $success = true;
                    $sql = "UPDATE tbl_games SET active_sessions = active_sessions + 1 WHERE id= $selgame";
                    if ($conn->query($sql) === FALSE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;}

                    $sql = "UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = $selgame) WHERE id = $sectionid";
                    if ($conn->query($sql) === FALSE) {
                      echo "Error: " . $sql . "<br>" . $conn->error;}


                        $resulted = mysqli_query($conn, "SELECT MAX(id) FROM tbl_session");
                        if(mysqli_num_rows($resulted) > 0) {
                          while($row = mysqli_fetch_assoc($resulted)){

                            $session = $row['MAX(id)'];
                                
                          }

                          $sql = " CREATE EVENT disable_session_$session
                                ON SCHEDULE AT '$deadline'
                                ON COMPLETION PRESERVE
                                DO
                                BEGIN

                                UPDATE tbl_session SET active = 0 WHERE id = $session;

                                UPDATE tbl_games SET active_sessions = active_sessions - 1 WHERE id = $selgame;

                                UPDATE tbl_section SET assigned = (SELECT game FROM tbl_games WHERE id = 0) WHERE id = $sectionid;

                                UPDATE tbl_section SET completed = completed + 1 WHERE id = $sectionid;

                                END;";
                                if ($conn->query($sql) === FALSE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;}
                        


                        }
                }
            }
            else{
                $match = true;
            }

      }
      else{
        $gameErr = true;
      }
    
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher | Code Generator</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="bootstrap.min.css" rel="stylesheet"/>
  <link rel= "icon" href="dist/img/O.png">
</head>
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
        <a href="index3.html" class="nav-link">Home</a>
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
            <a href="teacher_dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Classes
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="teacher_game.php" class="nav-link active">
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

    <!-- Main content -->

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
          <div class="card">
                
                <br><br><br><br>
              <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-8" style="margin:auto; height: 600px;">
                    <div class="card">
                      <div class="card-header bg-info">
                        <h3 class="card-title">In here, you can assign a game to a specific section.</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                      <form method="POST">
                        <table id="example2" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th> 
                            </th>
                            
                          </tr>
                          
                            <tr>
                                <td style="height: 400px;"> 
                                  <h3 class="profile-username text-center">Assign a Game </h3>
                              
                                          <br>
                                          
                                          <label for="game">Choose a game:</label>

                                            <select name="game" id="game">
                                            <?php
                                            $resulted = mysqli_query($conn, "SELECT * FROM tbl_games");
                                            if(mysqli_num_rows($resulted) > 0) {
                                              while($row = mysqli_fetch_assoc($resulted)){

                                                $gameid = $row['id'];
                                                $game = $row['game'];


                                                echo"<option value='$gameid'>$game</option>";

                                              }
                                            }
                                            ?>
                                            </select>
                                            <br>
                                            <br>
                                            <label for="game">Choose a Section:</label>

                                            <select name="sect" id="sect">
                                            <?php
                                            $resulted = mysqli_query($conn, "SELECT * FROM tbl_section WHERE teacher = $id");
                                            if(mysqli_num_rows($resulted) > 0) {
                                              while($row = mysqli_fetch_assoc($resulted)){

                                                $sectid = $row['id'];
                                                $section = $row['section'];


                                                echo"<option value='$sectid'>$section</option>";

                                              }
                                            }
                                            ?>
                                            </select>
                                            <br>
                                            <br>
                                            <label for="attempt">Enter number of Attempts:</label>
                                            <select name="attempt" id="game">
                                            <option value='1'>1</option>
                                            <option value='2'>2</option>
                                            <option value='3'>3</option>
                                            <option value='5'>4</option>
                                            <option value='5'>5</option>
                                            </select>
                                            <br>
                                            <br>
                                            <label>Enter a Deadline:
                                            <input type='datetime-local' name='date' required>
                                            </label>
                                            <br>
                                            <br>

                                            <button type="submit" name="submit" id=goback class="btn btn-info">Assign</button>
                                            <br>
                                            <br>

                                            <?php 
                                                if (isset($success)) {
                                                    if ($success == true) {
                                                    echo '
                                                    <div class="alert with-close alert-success alert-dismissible fade show alert-lightcolor">
                                                            <span class="badge badge-pill badge-success">success</span>
                                                            Game has been assigned successfully.
                                                    </div>
                                                    ';
                                                    }
                                                }
                                                if (isset($fail)) {
                                                    if ($fail == true) {
                                                    echo '
                                                    <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                            <span class="badge badge-pill badge-danger">error</span>
                                                            There was an error assigning a game, please try again. 
                                                    </div>
                                                    ';
                                                    }
                                                }
                                                if (isset($match)) {
                                                    if ($match == true) {
                                                    echo '
                                                    <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                            <span class="badge badge-pill badge-danger">error</span>
                                                            This section already has an active session on this game. 
                                                    </div>
                                                    ';
                                                    }
                                                }
                                                if (isset($gameErr)) {
                                                  if ($gameErr == true) {
                                                  echo '
                                                  <div class="alert with-close alert-danger alert-dismissible fade show alert-lightcolor">
                                                          <span class="badge badge-pill badge-danger">error</span>
                                                          please choose a game. 
                                                  </div>
                                                  ';
                                                  }
                                              }
                                            ?>

                                            
                
                                </td>
                              </tr>                         
                          </thead>
                          <tbody>
                                        </section>
                                        </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
  </div>
</div>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->








<!-- jQuery -->


<script type= "text/javascript">
    function copy(value) {
        var cashiercode = document.getElementById('cashiercode');
        cashiercode.select();
        if(value == 'cut') {
            document.exeCommand ('cut');
        } else {
            document.execCommand('copy');
            
        }
    }

</script>

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }

  // DropzoneJS Demo Code End
</script>
</body>
</html>
