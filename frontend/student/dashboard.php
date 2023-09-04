<?php
require_once '../../backend/db.php';
session_start();
//TODO redirect if not logged in
if (!isset($_SESSION['id'])) {
  header('location:login.php');
}

$uid=$_SESSION['name'];
$id=$_SESSION['id'];
$isAdmit=0;
$qry="SELECT * FROM `s_info` WHERE `u_id` = '$id'";

$qrr=mysqli_query($con,$qry);
$num= mysqli_num_rows($qrr);
if($num>0)
{
    $isAdmit=1;
}

if(isset($_POST['sub']))
{
    $name=$_POST['name'];
    $sem=$_POST['sem'];
    $dept=$_POST['dept'];
   // $batch=$_POST['batch'];
    $dob=$_POST['dob'];
    $grdnno=$_POST['grdnno'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $adrs=$_POST['adrs'];
    $gender=$_POST['gender'];
    $pin=$_POST['pin'];

    // random 5 digits number generator
    
    $d = mt_rand(1, 1000);
    $i = str_pad($d, 4, 0, STR_PAD_LEFT);
    

    $qry="INSERT INTO `s_info` (`u_id`, `s_name`, `s_roll`, `d_id`, `admsn_date`, `dob`, `fname`, `mname`, `adrs`, `pin`, `sem`, `grdnno`,`gender`) VALUES 
    ('$id', '$name', '$i', '$dept', current_timestamp(), '$dob', '$fname', '$mname', '$adrs', '$pin', '$sem', '$grdnno','$gender');";
    if($isAdmit==0){
    $res=mysqli_query($con,$qry);}
    if($res)
    {  
      //alert and redirect to dashboard
        header('location:dashboard.php');
       
        
    }
    else
    {
        echo "<script>alert('Student Not Added')</script>";
        echo "error".mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets2/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../assets2/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets2/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" type="text/css" href="../../assets2/js/select.dataTables.min.css">

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../assets2/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../assets2/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../assets2/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../assets2/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
    <!-- header portion -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="../../assets1/jec.png" class="mr-2" alt="JEC"/></a> 
        <!-- logo of JEC -->
        <a class="navbar-brand brand-logo-mini" href="#"><img src="../../assets1/jec.png" alt="logo"/><h4>Dashboard</h4></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item ">
            
              <span class="d-none d-md-inline-block ml-1 font-weight-bold">
                <?php echo $_SESSION['name']; ?>
              </span>
          </li>
          <li class="nav-item nav-profile dropdown">
            
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="#" alt="profile"/>    
              <!-- //image of student -->
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
     </nav>
  
     <div class="container-fluid page-body-wrapper">
    <!-- header ends -->
    

    <!-- sidebar starts -->
        <nav class="sidebar" id="sidebar">
        
        <ul class="nav position-fixed" style="width: 203px;">
        <li class="nav-item nav-profile border-bottom">
              <div class="nav-image d-flex mx-3 mb-3 flex-column">
                <img src="#" alt="profile" />
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center"><?= $uid;?></span>
                <span class="text-secondary icon-sm text-center"><?= $id;?></span>
              </div>
            
          </li>
          <li class="nav-item my-3">
            <a class="nav-link" href="dashboard.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item  mb-3">
            <a class="nav-link " href="grade.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Grade Card</span>
            </a>
          </li>
          

        </ul>
        
      </nav>
    <!-- sidebar ends -->


    <!-- MAINBODY STARTs -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
          <?php if( $isAdmit==0) { ?>
        
          <div class="col-11 grid-margin m-auto">
              <div class="card">
                <div class="card-body">
                  <h2 class="font-weight-bold mb-5 border-bottom pb-3 "> Fill your information</h2>

                  <h3 class="font-weight-bold text-red d-flex justidy-content-end"> SESSION: <span id="y11" > ar </span> </h3>
                  
                  <form class="form-sample" action="" method="POST">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Father's Name</label>
                          <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Mother's Name</label>
                          <div class="col-sm-8">
                            <input required type="text" name="mname" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Gender</label>
                          <div class="col-sm-8">
                            <select required name="gender" class="form-control">
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Department</label>
                          <div class="col-sm-8">
                            <!-- select departments from department table  -->
                            <select required  name="dept" id="deprt" class="form-control" onclick="fetch(this.value)">
                              <option hidden>Select Department</option>
                              <?php
                                $sql = "SELECT * FROM department";
                                $result = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                  echo '<option value="'.$row['d_id'].'">'.$row['d_name'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">SEMESTER</label>
                          <div class="col-sm-8">
                            <select required name="sem" class="form-control" id="sem">
                              <option hidden>Select Semester</option>
                             
                            </select>
                          </div>
                        </div>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Guardian Ph.</label>
                          <div class="col-sm-8">
                            <input required type="number" name="grdnno" class="form-control" />
                          </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Date of Birth</label>
                          <div class="col-sm-8">
                            <input type="date" required name="dob" class="form-control" placeholder="dd/mm/yyyy"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <p class="card-description mb-5">
                      Address info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <input required type="text" name="adrs" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pincode</label>
                          <div class="col-sm-9">
                            <input required type="number" name="pin" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                     
                    </div>
                    <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-icon-text mb-4 mx-4" name="sub">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } elseif($isAdmit==1) 
                {
                ?>
                <div class="col-11 grid-margin m-auto">
                <div class="card">
                <div class="card-body">
                <h1 class="font-weight-bold p-5 ">Your details are already submited.</h1>
                <?php } ?>
            
           
            
            
        </div>
      </div>
    <!-- MAINBODY ends -->


    <!-- FOOTTER STARTS -->
      <footer class="footer d-flex-">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. Abhishek & Jyotim. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with hardwork<i class="ti-heart text-danger ml-1"></i></span>
          </div>
          </footer>
          <!-- partial -->
          </div>
          <!-- main-panel ends -->
          </div>
          <!-- page-body-wrapper ends -->
          </div>
    <!-- FOOTERENDS-->

<!-- plugins:js -->
<script>
document.getElementById("y11").innerHTML = new Date().getFullYear();

 // fetch using ajax
  function fetch(id) {
    $('#sem').html("<option value=''>Select Semester</option>");
      $.ajax({
        url: "stu_fetch.php",
        method: "POST",
        data: {sem:id},
        success: function(data){
          $('#sem').html(data);
        }
      });
    
  }
</script>
  <script src="../../assets2/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../assets2/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../assets2/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets2/js/off-canvas.js"></script>
  <script src="../../assets2/js/hoverable-collapse.js"></script>
  <script src="../../assets2/js/template.js"></script>
  <script src="../../assets2/js/settings.js"></script>
  <script src="../../assets2/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../assets2/js/file-upload.js"></script>
  <script src="../../assets2/js/typeahead.js"></script>
  <script src="../../assets2/js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
