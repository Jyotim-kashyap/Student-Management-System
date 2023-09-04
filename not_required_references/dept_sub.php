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


$d_id=$_GET['d_id'];
$qry1="SELECT * FROM `department` WHERE `d_id` = '$d_id'";
$re=mysqli_query($con,$qry1);
$row=mysqli_fetch_array($re);
$sem=$row['t_sems'];

//updatng subjects
if(isset($_POST['updateSub']))
{
   
   
     $sub_id = $_POST['sub_id'];
     $sub_code = $_POST['sub_code'];
     $sub_name = $_POST['s_name'];
     $sub_tmark = $_POST['s_tmark'];
     $sub_inmark = $_POST['s_inmark'];
     $sub_fmark = $_POST['s_fmark'];
     $isP = $_POST['isP'];
     $sql = "UPDATE `subjects` SET `sub_code`='$sub_code',`sub_name`='$sub_name',`sub_mtheory`='$sub_tmark',`sub_minternal`='$sub_inmark',`sub_fmark`='$sub_fmark',`isPractical`='$isP' WHERE `sub_id`='$sub_id'";
     $result = mysqli_query($con, $sql);
     if($result)
     {
         ?>
         <script>
             alert("Subject Updated Successfully");
            
         </script>
         <?php
     }
     else
     {
         ?>
         <script>
             alert("Subject Not Updated");
            
         </script>
         <?php
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

<body onload="getBatchInfo()">
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
             
          <div class="col-lg-12 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <div class="row d-flex justify-content-between ">
                  <div class="row-group ml-5">
                  <h3 class="card-title">All Subjects</h3>
                  <p class="card-description">
                  Semester Wise
                  </p>
                  </div>
                  
                  <div class="row-group d-flex col-3 justify-content-end mr-5">
                  <label for="batchID" class="form-group col-5 text-dark d-flex align-self-center">Select Batch</label>
                    <select name="batch" id="batchID" class="form-control btn-inverse-primary" onchange="getBatchInfo()" >
                    <?php 
                      //view departments
                      $sql="SELECT * FROM `batch` WHERE `d_id` = '$d_id' order by b_start DESC";
                      $res=mysqli_query($con,$sql);
                      $num=mysqli_num_rows($res);
                      while ($f = mysqli_fetch_assoc($res)) {
                              $a=$f['b_start'];
                          $syear = strtok($a, '-');
                        $b=$f['b_end'];
                        $eyear = strtok($b, '-');
                        ?>
                        <option class="btn-group" value="<?=$f['b_id']?>"><?=$syear?> - <?=$eyear?></option>
                        <?php 
                        } ?>
                  </select>
                 </div>
                 </div>
                 <hr>
                 
                    <!-- div button to add new department -->
                  <!-- table of subjects  -->
                  <div class="table-responsive table-sm mt-3" id="diplay_table">
                  
                  <!-- //reciving data of tables from ajaxfetch.php file  -->

            </div>
            </div>
          </div>        
        </div>
      </div>
      
    <!-- MAINBODY ends -->
    <script>
    // $(document).ready(function(){
    //   //get id of the selected batch from dropdown
    //   $('#batchID').ready(function(){
    //     var bid = $(this).val();
    //     $.ajax({
    //       url:"ajaxfetch.php",
    //       method:"POST",
    //       data:{batch_id:bid},
    //       success:function(data){
    //         $('#diplay_table').html(data);
    //       }
    //     });
    //   });
      
        
    //   });

   function getBatchInfo(){

    var b_id = $("#batchID").val();
    var d_id = <?= $d_id; ?>;
    //diplay elmID in diplay table in html
    
    //$('#diplay_table').html("<h1>Loading..."+b_id+"</h1> <br> <h1>Loading..."+d_id+"</h1>");

    $.ajax({
          url:"ajaxfetch.php",
          method:"POST",
          data:{batch_id:b_id, dept_id:d_id},
          success:function(data){
            $('#diplay_table').html(data);
            
          }
        });
   
  }

    </script>

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
