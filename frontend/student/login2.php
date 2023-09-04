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

    header('location:../admin/admin_dash.php');
    

}elseif($unum>0)
{
    
    $_SESSION['name']= $nm['u_name'];
    $_SESSION['id']= $nm['u_id'];
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
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
   Sign In
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <!-- container -->
    <section class="min-vh-120 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-12 m-3 border-radius-lg" 
        style="background-image: url('../../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center mx-auto">
                        <h1 class="text-white mb-3 mt-6">Welcome Back</h1>
                        <p class="text-lead text-white">Enter your Unique Id and password to sign in</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-6 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-5">
                            <h5>Login Here</h5>
                        </div>
                        <div class="card-body">
                            <!-- form making-->
                            <form role="form text-left" action="" method="POST">
                            <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter User_id" name="u_id">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                <div class="text-center">
                                    <button type="submit" name="sub" class="btn bg-gradient-dark w-100 my-4 mb-2">Log In</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Don't have an account? <a href="register.php" class="text-dark font-weight-bolder">Register here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
    <div class="container">
      <div class="row">
       
        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
          <a href="javascript:;" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-dribbble"></span>
          </a>
          <a href="#" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-twitter"></span>
          </a>
          <a href="#" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-instagram"></span>
          </a>
          <a href="#" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-pinterest"></span>
          </a>
          <a href="#" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-github"></span>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> by Abhishek & Jyotim
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>