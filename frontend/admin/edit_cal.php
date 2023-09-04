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

$s_id=$_GET['s_id'];
$d_id=$_GET['d_id'];
$sem=$_GET['sem'];
//selecting the department name from department table
$qry="SELECT * FROM `department` WHERE `d_id` = '$d_id'"; 
  $res=mysqli_query($con,$qry);
  $rr=mysqli_fetch_assoc($res);
  $d_name=$rr['d_name'];
//selecting Subjects from subject table
    $sqry="SELECT * FROM `subjects` WHERE `d_id` = '$d_id' AND `sub_sem` = '$sem'";
    $sexc=mysqli_query($con,$sqry);
    $snum=mysqli_num_rows($sexc);
  //prepare query to insert data
  $query="UPDATE `attendence` SET  `total_class`= ?, `attended`= ?, `perc`=? WHERE `sub_id` = ? AND `s_id` = ? AND `sem` = ? ";
 
         
    $stmt=$con->prepare($query);
  //bind parameters
  $stmt-> bind_param("iiiiii",$t_class,$atnd,$perc,$sub_id,$s_id,$sem);

  //execute query
  if(isset($_POST['submit'])){
      
      for($i=0;$i<$snum;$i++){
        $sub_id=$_POST[$i.'sub_id'];
          $t_class=$_POST[$i .'t_class'];
          $atnd=$_POST[$i .'atnd'];
          $perc=$_POST[$i .'perc'];             
          //$nc=$_POST[$i .'nc'];             
          $stmt->execute();  
          
      }
      if($stmt->affected_rows>0){
        // header location to send did and b_id to add_subs.php
        header('location:atten_stu.php?d_id='.$d_id);
       
      }
      else{
        header('location:atten_stu.php?d_id='.$d_id);
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
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
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
        <div class="row justify-content-center">
          <div class="col-lg-12 grid-margin stretch-card ">
              <div class="card">
              
             <!-- //auto closing alert show in the top left corner of the screen -->
              
                <div class="card-body">
                  <h2 class="card-title text-center mb-4 ml-5 pl-3">Edit Attendance</h2>
                  <h4 class="card-description text-center d-flex justify-content-around mb-5" >
                  <span class="text-center text-danger text-lg font-weight-bolder "><b class="text-black">Department:</b> <?= $d_name;?></span>
                <!-- <span class="text-center text-danger text-lg font-weight-bolder"><b class="text-black ">Batch of:</b> <?= $syear.' - '.$eyear;?> </span> -->
                  <span class="text-center text-danger text-lg font-weight-bolder "><b class="text-black">Semester:</b> <?= $sem ;?> </span>
                  </h4>
                  
                  <!-- end model to add batch -->

                  <div class="table-responsive table-bordered">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">No</th>
                        <th class="font-weight-bolder text-info ">Subject Code</th>
                        <th class="font-weight-bolder text-info ">Subject Name</th>
                        <th class="font-weight-bolder text-info ">Total Class</th>
                        <th class="font-weight-bolder text-info ">Attended Class</th>
                        <th class="font-weight-bolder text-info ">Percentage</th>
                        <th class="text-center font-weight-bolder text-info">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                  
                      <form action="" method="post">
                        <?php 
                        $i=0;
                       while($f=mysqli_fetch_assoc($sexc))
                       {
                         $qry23="SELECT * FROM attendence where s_id='$s_id' and sub_id='$f[sub_id]' and sem='$sem'";
                            $exc=mysqli_query($con,$qry23);
                            $ft=mysqli_fetch_assoc($exc);

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
                        <input type="number" class="cal form-control" value="<?=$ft['total_class'] ;?>"  id="th<?=$i;?>" name="<?= $i .'t_class';?>"> 
                        </td>
                                              
                        <td class="align-middle">
                          <input type="number" class="cal form-control" value="<?=$ft['attended'] ;?>" id="a<?=$i;?>" name="<?= $i .'atnd';?>">
                        </td>
                        <td class="align-middle">
                        <input type="number" class="form-control" value="<?=$ft['perc'] ;?>" name="<?= $i.'perc'?>" id="fmark<?=$i;?>" value="" readonly>
                        </td>
                        <input type="hidden" name="<?= $i.'sub_id'?>" value="<?= $f['sub_id']?>">
                        <input type="hidden" name="<?= $i.'nc'?>" value=""  id="stat1<?=$i;?>" >
                        <td class="align-middle text-center text-sm">
                            <!-- TODO add states  -->
                        <span class="btn btn-md font-weight-bolder text-white bg-gradient-warning" id="stat<?=$i;?>"></span>
                    </td>
                       
                    </tr>
                      
                    
                
                    <?php $i++;}  ?>
                        
                      </tbody>
                    </table>
                   
                  </div>
                  <div class="col-md-12 d-flex justify-content-end">
                        
                        <button type="submit" class="btn btn-primary mr-3 mt-5" name="submit">UPDATE</button>
                        
                      </div>
                    </form> 
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
<script>
  //to calculate the full marks of the subject
  for(let i=0; i< <?=$snum;?>; i++){
    $('#stat'+i).text('NA');
    $('#stat1'+i).val('NA');
    $('.cal').on('input', function(){
      var x =parseInt($('#th'+i).val());
      var z = parseInt ($('#a'+i).val());
    
    // restrict the input if the z is greater than x show error message on field in red color
    if(z>x){
      $('#a'+i).val('');
      $('#a'+i).css('border-color','red');
      $('#a'+i).attr('placeholder','Attended class cannot be greater than total class');
    }
    else{
      $('#a'+i).attr('placeholder','0');
      $('#a'+i).css('border-color','#ced4da');
    }
   

    if(Number.isNaN(x))
    {
    
      x = 0;
    } 
    if(Number.isNaN(z))
    {
      z = 0;
    }
    var f = (z*100)/x;
    
    //f>=75 then show green color else show red color in stat id
    if(x>0 && z>0){
    if(f>=75){
      $('#stat'+i).removeClass('bg-gradient-danger');
      $('#stat'+i).removeClass('bg-gradient-primary');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-success');
      $('#stat'+i).text('OK');
      $('#stat1'+i).val('OK');
    }
    else if(f>=65 && f<75){
        $('#stat'+i).removeClass('bg-gradient-danger');
      $('#stat'+i).removeClass('bg-gradient-success');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-primary');
      $('#stat'+i).text('NC');
      $('#stat1'+i).val('NC');
    }else{
        $('#stat'+i).removeClass('bg-gradient-success');
      $('#stat'+i).removeClass('bg-gradient-primary');
      $('#stat'+i).removeClass('bg-gradient-warning');
      $('#stat'+i).addClass('bg-gradient-danger');
      $('#stat'+i).text('DC');
      $('#stat1'+i).val('DC');
    }
    }
    else{
        $('#stat'+i).removeClass('bg-gradient-success');
        $('#stat'+i).removeClass('bg-gradient-primary');
        $('#stat'+i).removeClass('bg-gradient-danger');
        $('#stat'+i).addClass('bg-gradient-warning');
      $('#stat'+i).text('NA');
      $('#stat1'+i).val('NA');
    }
    $('#fmark'+i).val(f.toFixed(2));
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