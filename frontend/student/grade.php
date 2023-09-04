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
$f=mysqli_fetch_assoc($qrr);
$sem=$f['sem'];
$d_id=$f['d_id'];
$s_id=$f['s_id'];
$num= mysqli_num_rows($qrr);
if($num>0)
{
    $isAdmit=1;
}
// $qrr="SELECT * from st_marks WHERE s_id = '$id' AND sem='$sem' and publish=1";
$qrr="SELECT * from department WHERE d_id = '$d_id'";
$qry=mysqli_query($con,$qrr);
$f=mysqli_fetch_assoc($qry);
$dname=$f['d_name'];


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
        <div class="row justify-content-center">
          <div class="col-lg-12 grid-margin stretch-card ">
              <div class="card">
              
             <!-- //auto closing alert show in the top left corner of the screen -->
              
                <div class="card-body">
                  <h2 class="card-title text-center ">Grade Card</h2>
                  <h4 class="card-description text-center d-flex justify-content-around mb-5" >
                  <h3 class="text-center  text-lg font-weight-bolder "><?= $dname ;?></h3>
                  <h4 class="text-center  text-lg font-weight-bolder "><?= $uid ;?></h4>
                  <h3 class=" text-center">Semester: <span class="text-danger font-weight-bolder"><?= $sem; ?> </span></h3>
                  </h4>
                  
                  <!-- end model to add batch -->
                  <?php 
                  
                  ?>
                  <div class="table-responsive table-sm mt-3 mb-3" id="diplay_table">
                  
                      <div class="card-title d-flex justify-content-between"> 
                      

                      </div>
                  <div class="table-responsive table-bordered">
                    <table class="table table-hover text-center">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">No</th>
                        <th class="font-weight-bolder text-info ">Subject Code</th>
                        <th class="font-weight-bolder text-info ">Subject Name</th>
                        <th class="font-weight-bolder text-info ">Total Therory/External Mark</th>
                        <th class="font-weight-bolder text-info ">Obtained Therory/External Mark</th>
                        <th class="font-weight-bolder text-info ">Internal Mark</th>
                        <th class="font-weight-bolder text-info ">Obtained Internal Mark</th>
                        <th class="font-weight-bolder text-info ">Total Marks Obtained</th>
                        <th class="font-weight-bolder text-info ">Pass Marks</th>
                        <th class="text-center font-weight-bolder text-info">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                  
                      
                        <?php 
                         $sqry="SELECT *
                         FROM subjects s
                         JOIN
                         st_marks st
                         ON s.sub_id=st.sub_id
                          WHERE s_id = '$s_id' AND sem= '$sem' and publish=1";
                         $sexc=mysqli_query($con,$sqry);
                         $snum=mysqli_num_rows($sexc);
                        if($snum>0){
                           
                        $i=0;
                       while($f=mysqli_fetch_assoc($sexc))
                       {
                         
                        ?>
                      <tr>
                      <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $i+1 ?></span>
                        
                        </td>
                        
                        <td class="align-middle">
                            <p class="text-l font-weight-bold text-sm mb-0"><?= $f['sub_code'];  ?></p>
                        </td>
                        <td class="align-middle">
                            <span class="text-l text-sm font-weight-bold"><?= $f['sub_name']; ?></span>
                        </td>
                        <td class="align-middle">
                            <span class="text-l text-sm font-weight-bold"><?= $f['sub_mtheory']; ?></span>
                        </td>
                        <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold"><?= $f['st_theory']; ?></span>
                        </td>
                                              
                        <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold" ><?= $f['sub_minternal']; ?></span>
                        </td>
                        <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold" ><?= $f['st_internal']; ?></span>
                        </td>
                        
                        <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold" value="<?= $f['st_total']; ?>" id="total" ><?= $f['st_total']; ?></span>
                        </td>
                        <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold" id="passmark" value="<?= $f['st_total']; ?>"><?= $f['sub_passmrk']; ?></span>
                        </td>
                       
                        <td class="align-middle text-center text-sm">
                            <!-- TODO add states  -->
                            <?php if($f['isPassed']==0){
                              ?>
                        <span class="btn btn-md font-weight-bolder text-white bg-gradient-danger">FAILED</span>
                        <?php }else{ ?>
                        <span class="btn btn-md font-weight-bolder text-white bg-gradient-success">PASSED</span>
                        <?php } ?>
                    </td>
                       
                    </tr>
                    
                    
                
                    <?php $i++;}}else
                    {
                        echo "<tr><td colspan='12' class='text-center text-danger text-weight-bolder'>RESULTS NOT POSTED YET</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  
                 
                  
                
                </div>
              </div>
            </div>
            </div>
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
