<?php
require_once '../../backend/db.php';
session_start();
//TODO redirect if not logged in
if (!isset($_SESSION['u_id'])) {
    header('location:../student/login.php');
}
$uid=$_SESSION['u_name'];
$id=$_SESSION['u_id'];

//page code here
if(isset($_GET['submit']))
{
$s_roll=$_GET['srch'];
$qry="SELECT * FROM s_info s INNER JOIN department d ON s.d_id = d.d_id WHERE `s_roll` = $s_roll";
$run=mysqli_query($con,$qry);

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
        <!-- jec logo -->
        <a class="navbar-brand brand-logo-mini" href="#"><img src="../../assets1/jec.png" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav mr-lg-2">
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <
          <li class="nav-item ">
            
              <span class="d-none d-md-inline-block ml-1 font-weight-bold">
                <?=$uid ?>
              </span>
          </li>
          <li class="nav-item nav-profile dropdown">
            
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="#" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" >
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="../student/logout.php">
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
               
              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center"><?= $uid;?></span>
                <span class="text-secondary icon-sm text-center"><?= $id;?></span>
              </div>
          <li class="nav-item my-3">
            <a class="nav-link" href="admin_dash.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item mb-3">
            <a class="nav-link" href="departments.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Department</span>
            </a>
          </li>
          <li class="nav-item mb-3">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Subjects</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="set_subjects.php">Set Subjects</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_subs.php">View Subjects</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item mb-3">
          <a class="nav-link" href="set_marks.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Marks</span>
            </a>
          </li>
          <li class="nav-item mb-3">
          <a class="nav-link" href="atten.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Attendece</span>
            </a>
          </li>
          <li class="nav-item mb-3">
            <a class="nav-link" href="student_info.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Verify Student</span>
            </a>
          </li>
          
        </ul>
       
      </nav> 
    <!-- sidebar ends -->

    <!-- MAINBODY STARTs -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
         
                <div class="col-11 grid-margin m-auto">
                <div class="card">
                    <div class="card-body ">
                    <h4 class="card-title">Search Student</h4>
                    <p class="card-description border-bottom mb-5 pb-3">
                        Enter Student Roll No
                        </p>
                    <form class="form-sample" action="" method="GET">
                        
                      
                          <div class="col-md-12 d-flex justify-content-center">
                          <div class="form-group col-sm-6 col-form-label ">
                          <h3 class="d-flex justify-content-center text-weight-bolder" for="navbar-search-input">Search By College Roll</h3>
                          <div class="col-sm-12 d-flex justify-content-center">
                          
                          <input type="text" class="form-control" id="navbar-search-input" name="srch" placeholder="Search now" aria-label="search" aria-describedby="search">
                          </div>
                          </div>
                          </div>
                          
                       
                           
                        <div class="col-12 d-flex justify-content-center">
                        
                        <button type="submit" name="submit" class="btn btn-primary">Search</button>
                        
                      </div>
                    </form>

                    </div>
                </div>
            </div>
            </div>
            <?php if(isset($_GET['submit'])){?>
            <div class="row justify-content-center mt-3">
            <div class="col-11 grid-margin stretch-card ">
              <div class="card">
              
             <!-- //auto closing alert show in the top left corner of the screen -->
              
                <div class="card-body">
                  <h1 class="card-title text-center">Student Info</h1>
                  <p class="card-description text-center">
                    
                  </p>

                  <!-- end model to add batch -->

                  <div class="table-responsive ">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">Student ID</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Name</th>
                        <th class="text-center font-weight-bolder text-info px-0">Gender</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Fathers Name</th>
                        <th class="text-center font-weight-bolder text-info px-0">Mothers Name</th>
                        <th class="text-center font-weight-bolder text-info px-0">Roll no</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Department</th>
                        <th class="text-center font-weight-bolder text-info px-0">Sem</th>
                        
                        <th class="text-info text-center font-weight-bolder ">Gurdian Ph no</th>
                        <th class="text-info text-center font-weight-bolder ">Address</th>
                        <th class="text-info text-center font-weight-bolder">Pin Code</th>
                        <th class="text-info text-center font-weight-bolder">Batch</th>
                        <th class="text-danger text-center font-weight-bolder">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                      <?php 
                    // fetching data form subjects tables
                   
                    if($num=mysqli_num_rows($run)>0){
                      while($f = mysqli_fetch_assoc($run)){
                        
                        ?>

                      <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['s_id']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?= $f['s_name'];  ?></p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['gender']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['fname']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['mname']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['s_roll']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['d_name'];  ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sem'];  ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['grdnno']; ?> </span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['adrs'];?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['pin']; ?> </span>
                    </td>
                    
                    
                    
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['batch'];?></span>
                    </td>
                    <td class="align-middle text-center">
                        <a href="student_view.php?d_id=<?= $f['d_id']; ?>&s_id=<?= $f['s_id']; ?>" class="btn btn-info">GO</a>
                    </td>
                    </tr>
                    <?php
                }
                }else
                    {
                        echo "<tr><td colspan='10' class='text-center text-danger'>No Data Found</td></tr>";
                        }
                
                ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        
      </div>
           <?php }?>
            
          
            

            
            
        </div>
        </div>
      </div>
    <!-- MAINBODY ends -->


    <!-- FOOTTER STARTS -->
      <footer class="footer">
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
