<?php
require_once '../../backend/db.php';
session_start();
//TODO redirect if not logged in
if (!isset($_SESSION['u_id'])) {
    header('location:../student/login.php');
}
$uid=$_SESSION['u_name'];

$id=$_SESSION['u_id'];

$qry="SELECT * FROM `s_info`;";

$que=mysqli_query($con,$qry);
//Approved student
if(isset($_GET['Allowed']))
    {
    $pub=$_GET['Allowed'];
    
    $px="UPDATE `s_info` SET `isVarified` = '1' WHERE `s_info`.`s_id` = '$pub' ";
    $pxq=mysqli_query($con,$px);
    if($pxq)
    {
        header('location:student_info.php');
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

<body >
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
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Info</h4>
                  <p class="card-description">
                    Verify Students
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        
                    <tr>
                      <th class="font-weight-bolder text-info">Roll-No</th>
                      <th class="font-weight-bolder text-info  align-middle px-0 text-center">Name</th>
                      <th class="text-center font-weight-bolder text-info px-0">Gender</th>
                      <th class="text-center font-weight-bolder text-info px-0">Department</th>
                      <th class="text-center font-weight-bolder text-info px-0">Semester</th>
                      <th class="text-center font-weight-bolder text-info px-0">Address</th>
                      <th class="text-center font-weight-bolder text-info px-0">Pincode</th>
                      <th class="text-center font-weight-bolder text-info px-0">Admission Date</th>
                      <th class="text-center font-weight-bolder text-info">Status</th>
                      <th class="text-danger">Actions</th>
                    </tr>
                  </thead>
                      <tbody>
                      <?php 
                  if ($que) {
                    $num = mysqli_num_rows($que);
                    if ($num>0) {$i = 1;
                  while ($f = mysqli_fetch_assoc($que)) {
                      $stat=$f['isVarified'];
                        ?>
               <!-- <a href="view_questions.php?examid="> Exam id is:?></a>-->
                  <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['s_roll']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?php echo $f['s_name']; ?></p>
                    </td>
                    <td class="align-middle text-left">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['gender']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['d_id']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['sem']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['adrs']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['pin']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['admsn_date']; ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="badge badge-lg bg-gradient-<?php 
                        if($stat==1)
                        {
                            echo "success";
                            }
                            elseif($stat==0){
                                echo "secondary";  
                            }
                            ?>"><?php 
                            if($stat==1)
                            {
                                echo "Active";
                                }
                                elseif($stat==0){
                                    echo "Inactive";  
                                } ?> 
                                </span>
                        
                    </td>
                    <td class="project-actions">
                          
                          <a class="btn btn-success mb-0 px-2 py-2 <?php 
                            if($stat==1)
                            {
                                echo "disabled";
                                }
                                elseif($stat==0){
                                    echo "";  
                                } ?>" href="student_info.php?Allowed=<?php echo $f['s_id'];?>">
                              <i class="fas fa-eye">
                              </i>
                              Approve
                          </a>
                          <a class="btn btn-info mb-0 px-2 py-2" href="publish.php?pro=<?php echo $f['s_id'];?>&s=<?=$f['sem']; ?>">
                              <i class="fas fa-eye">
                              </i>
                              Promote
                          </a>
                      </td>
                    </tr>
                    <?php
                 $i++;}
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
