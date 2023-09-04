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

//never gonna give you up - never gonna let you down - never gonna run around and desert you - never gonna make you cry - never gonna say goodbye - never gonna tell a lie and hurt you 
$did=$_GET['did'];
$bid=$_GET['bid'];

$qry1="SELECT * FROM `department` WHERE `d_id` = '$did'";
$re=mysqli_query($con,$qry1);
$row=mysqli_fetch_array($re);

$sem=$row['t_sems'];

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
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="#" class="mr-2" alt="JEC"/></a>
        <!-- jec logo -->
        <a class="navbar-brand brand-logo-mini" href="#"><img src="#" alt="logo"/></a>
      </div>
     <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">#</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    1
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li> -->
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
    <div class="row d-flex ">
                      <!-- <div class="row-group col-md-4">
                      <h3 class="card-title">Semester: <span class="text-danger font-weight-bolder"><?= $i; ?> </span></h3>
                      </div>
                      <div class="row-group">
                        <h5 class="text-right">
                          <a href="javascript:void(0)" class="btn btn-primary" onclick="add_subject('<?php echo $i; ?>','<?php echo $b_id; ?>','<?php echo $d_id; ?>')">Add Subject</a>
                        </h5>
                      </div>
                    </div> -->

    <!-- sidebar starts -->
        <nav class="sidebar" id="sidebar">
        
        <ul class="nav position-fixed" style="width: 203px;">
        <li class="nav-item nav-profile border-bottom">
              <div class="nav-image d-flex mx-3 mb-3 flex-column">
                <img src="#" alt="profile" />
                <!-- profile pic -->
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center"><?= $uid;?></span>
                <span class="text-secondary icon-sm text-center"><?= $id;?></span>
              </div>
          <li class="nav-item my-3">
            <a class="nav-link active" href="admin_dash.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item mb-3">
            <a class="nav-link" href="batch.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Batchs</span>
            </a>
          </li>
          <li class="nav-item active mb-3">
            <a class="nav-link" href="departments.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Department</span>
            </a>
          </li>
          <li class="nav-item mb-3">
            <a class="nav-link" href="set_subjects.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Set subjects</span>
            </a>
          </li>
          <li class="nav-item mb-3">
            <a class="nav-link" href="set_marks.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Set Marks</span>
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
        <div class="row justify-content-center">
          <div class="col-lg-11 grid-margin stretch-card ">
         
          <div class="card">
          <?php 
                  for($i=1;$i<=$sem;$i++){
                    
                  ?>
                <div class="card-body">
                  <h3 class="card-title">Semester: <span class="text-danger font-weight-bolder"><?= $i; ?> </span></h3>

                  
                  <!-- div button to add new department -->
                  
                  <div class="table-responsive table-sm mt-5">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">Sub ID</th>
                        
                        <th class="font-weight-bolder text-info">Code</th>
                        <th class="font-weight-bolder text-info">Name</th>
                      
                        <th class="font-weight-bolder text-info">Sem</th>
                        <th class="font-weight-bolder text-info text-center ">Theory Mark</th>
                        <th class="font-weight-bolder text-info text-center">Internal Mark</th>
                        <th class="font-weight-bolder text-info text-center">Any Practical</th>
                        <th class="font-weight-bolder text-info text-center">Full Mark</th>
                        
                        <th class="text-danger text-center font-weight-bolder">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                      <?php 
                    // fetching data form subjects tables
                    $sql = "SELECT * FROM subjects where d_id = '$did' and b_id = '$bid' and sub_sem = '$i'";
                    $result = mysqli_query($con, $sql);
                    if($num=mysqli_num_rows($result)>0){
                      while($f = mysqli_fetch_assoc($result)){
                        
                        ?>

                      <tr>
                  <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_id']; ?></span>
                    </td>
                    <td class="align-middle">
                        <p class="text-l font-weight-bold text-sm mb-0"><?= $f['sub_code'];  ?></p>
                    </td>
                    <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_name']; ?></span>
                    </td>
                    <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_sem'];  ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_mtheory']; ?> </span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_minternal']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['isPractical'];?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_fmark'];?></span>
                    </td>   
                    <td class="project-actions align-middle text-center">  
                    <button class="btn btn-inverse-info btn-fw">Edit</button>
                          <i class="fa fa-edit"></i><span></span>
                      </button>  
                      </td>
                    </tr>
                    <?php
                }
                }else
                    {
                    ?>
                    <tr>
                    <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <p class="text-xs font-weight-bold mb-0">-empty-</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-danger">none</span>
                        </td>
                        </tr>
                        <?php
                        }
                
                ?>
                      </tbody>
                    </table>
                  </div>
                 
                </div>
                <?php

}

?>
              </div>
              
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
