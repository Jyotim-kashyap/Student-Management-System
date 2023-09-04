<?php
require_once '../../backend/db.php';
session_start();
if(isset($_POST['sub']))
{
$uid=$_POST['u_id'];
$pass=$_POST['pass'];

//checking admin or not
$aqry="SELECT * FROM `user_info` WHERE `u_id` = '$uid' AND `u_pass` = '$pass' AND `isAdmin` = 1";
$admin=mysqli_query($con,$aqry);
//for normal student
$uqry="SELECT * FROM `user_info` WHERE `u_id` = '$uid' AND `u_pass` = '$pass'";
$user=mysqli_query($con,$uqry);

$anum= mysqli_num_rows($admin);
$nm1=mysqli_fetch_assoc($admin);

$unum= mysqli_num_rows($user);
$nm=mysqli_fetch_assoc($user);


if($anum>0)
{
    $_SESSION['u_name']= $nm1['u_name'];
    $_SESSION['u_id']= $nm1['u_id'];

    header('location:../admin/admin_dash.php');
    

}elseif($unum>0)
{
    
    $_SESSION['name']= $nm['u_name'];
    $_SESSION['id']= $nm['u_id'];
    $_SESSION['s_id']= $nm['s_id'];
    header('location:dashboard.php');
    session_create_id();
}
else
{
    echo "<script>alert('Invalid User ID or Password')</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets1/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets1/img/favicon.png">
  <title>
    LOGIN
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../../assets1/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../../assets1/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../assets1/demo/demo.css" rel="stylesheet" />
</head>

<body class="register-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="https://demos.creative-tim.com/blk-design-system/index.html" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
          <span>Student</span> Management System
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a>
                JEC.
              </a>
            </div>
            <div class="col-6 collapse-close text-right">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="#" >
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="#" >
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="#" >
              <i class="fab fa-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li>
          <li class="nav-item">
            <p class="nav-link">Jorhat Engineering college</p>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header">
      <div class="page-header-image"></div>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
              <div id="square7" class="square square-7"></div>
              <div id="square8" class="square square-8"></div>
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="../../assets1/img/square1.png" alt="Card image">
                  <h4 class="card-title m-4">Login</h4>
                </div>
                <div class="card-body">
                  <form action="" method="POST" class="form">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-single-02"></i>
                        </div>
                      </div>
                      <input type="text" name="u_id" class="form-control" placeholder="User name">
                    </div>
                    
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <input type="password" name="pass" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-check text-left">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox">
                        <span class="form-check-sign"></span>
                        Remember me
                      </label>
                    </div>
                  <div class="card-footer">
                  <button type="submit" name="sub" class="btn btn-info w-100 my-4 mb-2">Login</button>
                  <p class="text-sm mt-1 mb-0">Don't have an account? <a href="register.php" class="text-pink font-weight-bolder">Register here</a></p>
                </div>
                    
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <div class="register-bg"></div>
          <div id="square1" class="square square-1"></div>
          <div id="square2" class="square square-2"></div>
          <div id="square3" class="square square-3"></div>
          <div id="square4" class="square square-4"></div>
          <div id="square5" class="square square-5"></div>
          <div id="square6" class="square square-6"></div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../../assets1/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../../assets1/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../../assets1/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="../../assets1/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="../../assets1/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../../assets1/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Chart JS -->
  <script src="../../assets1/js/plugins/chartjs.min.js"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="../../assets1/js/plugins/moment.min.js"></script>
  <script src="../../assets1/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../../assets1/demo/demo.js"></script>
  <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="../../assets1/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
</body>
</html>
