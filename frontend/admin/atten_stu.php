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

$qry="SELECT * FROM `department` WHERE `d_id` = '$d_id'"; //selecting the department name from department table
  $res=mysqli_query($con,$qry);
  $rr=mysqli_fetch_assoc($res);
  $d_name=$rr['d_name'];


$qry1="SELECT * FROM `s_info` WHERE `d_id` = '$d_id'";
$re=mysqli_query($con,$qry1);
$row=mysqli_fetch_assoc($re);

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
        <div class="row justify-content-center">
             
          <div class="col-lg-10 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <div class="row d-flex justify-content-between ">
                  <div class="row-group ml-5">
                  <h3 class="card-title">Students of <span class="text-center text-danger text-lg font-weight-bolder "><b class="text-black">Department:</b> <?= $d_name;?></span></h3>
                  <p class="card-description">
                  All Students of the Department
                  </p>
                  </div>
                  
                  <div class="row-group d-flex col-3 justify-content-end mr-5">
                  <label for="batchID" class="form-group col-5 text-dark d-flex align-self-center">Select Batch</label>
                    <select name="batch" id="batchID" class="form-control btn-inverse-primary" onchange="getBatchInfo()" >
                    <?php 
                      //view departments
                      $sql="SELECT DISTINCT(batch) FROM `s_info` WHERE `d_id` = '$d_id' order by `batch` desc ";
                      $res=mysqli_query($con,$sql);
                      $num=mysqli_num_rows($res);
                      while ($f = mysqli_fetch_assoc($res)) {
                              $a=$f['batch'];
                        ?>
                        <option class="btn-group" value="<?=$a?>"> <?=$a?> </option>
                        <?php 
                        } ?>
                  </select>
                 </div>
                 </div>
                 <hr>
                 
                    <!-- div button to add new department -->
                  <!-- table of subjects  -->
                  <div class="table-responsive mt-3" id="diplay_table">
                  
                  <!-- //reciving data of tables from ajaxfetch.php file  -->

            </div>
            </div>
            </div>
          </div>        
        </div>
      </div>
      
    <!-- MAINBODY ends -->
    <script>
    function getBatchInfo(){

    var b_id = $("#batchID").val();
    var d_id = <?= $d_id; ?>;
    //diplay elmID in diplay table in html
    
    //$('#diplay_table').html("<h1>Loading..."+b_id+"</h1> <br> <h1>Loading..."+d_id+"</h1>");

    $.ajax({
          url:"ajaxfetchmark.php",
          method:"POST",
          data:{batch:b_id, Adept_id:d_id},
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
<script>
  //to calculate the full marks of the subject
  for(let i=0; i< <?=$num;?>; i++){
   //if prac is grater 75 then pass or else fail
   //on document ready
   $(document).ready(function(){
    var f = $('#prac'+i).val();
    //if percentage is greater than  75 then stat pass or else fail
    
   $('#stat'+i).text('OK');
    if(f>=75){
      $('#stat'+i).removeClass('bg-gradient-danger');
      $('#stat'+i).removeClass('bg-gradient-primary');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-success');
      $('#stat'+i).text('OK');
      
    }
    else if(f>=65 && f<75){
        $('#stat'+i).removeClass('bg-gradient-danger');
      $('#stat'+i).removeClass('bg-gradient-success');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-primary');
      $('#stat'+i).text('NC');
     
    }else{
        $('#stat'+i).removeClass('bg-gradient-success');
      $('#stat'+i).removeClass('bg-gradient-primary');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-danger');
      $('#stat'+i).text('DC');
     
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
