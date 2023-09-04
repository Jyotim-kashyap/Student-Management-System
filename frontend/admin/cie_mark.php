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
//getting cie_no value from cie_mark table
                $qry1="SELECT MAX(cie_no)
                FROM cie
                where s_id='$s_id'";
                $res1=mysqli_query($con,$qry1);
                $row1=mysqli_fetch_assoc($res1);
                //get the max cie no of the student
                if($row1['MAX(cie_no)']==NULL)
                {
                  $cie_no=1;
                }
                else
                {
                  $cie_no=$row1['MAX(cie_no)']+1;
                }
                //TODO join 3 tables to get the cie_mark of the student
                $sqry="SELECT * FROM `subjects` WHERE `d_id` = '$d_id' AND `sub_sem` = '$sem'";
                $sexc=mysqli_query($con,$sqry);
                $snum=mysqli_num_rows($sexc);
    
                //inserting cier mark into st_marks

                $query1="INSERT INTO `st_marks` (`s_id`,`sub_id`,`st_internal`,sem) 
                VALUES (?,?,?,?) ";
                $stmt1=$con->prepare($query1);
              //bind parameters
                $stmt1-> bind_param("iiii",$s_id,$sub_id,$s_mt,$sem);
                $qes="select * from st_marks where s_id='$s_id'";
                $res1=mysqli_query($con,$qes);
                $num1=mysqli_num_rows($res1);

  
                 //prepare query to insert data
    $query="INSERT INTO `cie` (`sub_id`, `s_id`, `cie_no`,`cie_mark`) VALUES (?,?,?,?) ";
    $stmt=$con->prepare($query);
  //bind parameters
    $stmt-> bind_param("iiii",$sub_id,$s_id,$cno,$s_mt);

  //execute query
  if(isset($_POST['insert'])){
      
      for($i=0;$i<$snum;$i++){
          $sub_id=$_POST[$i.'sub_id'];
         
          $cno=$_POST[$i .'c_no'];
          $s_mt=$_POST[$i .'s_mt'];
                                       
          $stmt->execute();  
          if($num1==0){
          $stmt1->execute(); } 
          
      }
      if($stmt->affected_rows>0){
        // header location to send did and b_id to add_subs.php
        header('location:student_view.php?d_id='.$d_id);
       
      }
      else{
        header('location:dept_sub.php?msg=fail');
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
        <div class="row justify-content-center">
          <div class="col-lg-12 grid-margin stretch-card ">
              <div class="card">
              
             <!-- //auto closing alert show in the top left corner of the screen -->
              
                <div class="card-body">
                  <h2 class=" text-center mb-4">ADD CIE MARKS</h2>
                  <h4 class="card-description text-center d-flex justify-content-around mb-5" >
                  <span class="text-center text-danger text-lg font-weight-bolder "><b class="text-black">Department:</b> <?= $d_name;?></span>
                  <span class="text-center text-danger text-lg font-weight-bolder "><b class="text-black">Semester:</b> <?= $sem ;?> </span>
                
                 
                  </h4>
                  
                  <!-- end model to add batch -->

                  <div class="table-responsive table-bordered" id="diplay_table">
                  <table class="table table-hover text-center">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">No</th>
                        <th class="font-weight-bolder text-info ">Subject Code</th>
                        <th class="font-weight-bolder text-info ">Subject Name</th>
                        <th class="font-weight-bolder text-info ">CIE Total</th>
                        <?php for($k=1;$k<=$cie_no;$k++){?>
                        <th class="font-weight-bolder text-info ">Cie <?=$k ?> Mark</th>
                        <?php } ?>
                        <!-- <th class="font-weight-bolder text-info ">Obtained Marks</th>
                        </tr> -->
                      </thead>
                      <tbody>
                      <tbody>
                        
                  
                      <form action="" method="post">
                        <?php 
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
                            <span class="cal text-l text-sm font-weight-bold" id="x<?= $i; ?>" value="<?= $f['sub_minternal']; ?>"><?= $f['sub_minternal']; ?></span>
                        </td>
                       <?php
                       //selecting cie table
                       //TODO shoud use join 3 tables to get the cie marks
                          
                       for($j=1;$j<=$cie_no;$j++){
                        $qry2="SELECT * FROM `cie` WHERE `s_id` = '$s_id' AND `sub_id` = '$f[sub_id]' AND `cie_no` = '$j'";
                          $exc2=mysqli_query($con,$qry2);
                          if(mysqli_num_rows($exc2)>0){
                            $f2=mysqli_fetch_assoc($exc2);
                            ?>
                            <td class="align-middle">
                            <input readonly type="number" class=" form-control" value="<?=$f2['cie_mark'] ;?>"  id="th<?=$i;?>" name="<?= $i .'s_mt';?>">
                            </td>
                            <?php
                          }
                          else{
                            ?>
                            <td class="align-middle">
                            <input type="text" class="cal form-control" id="a<?= $i ;?>" name="<?= $i .'s_mt';?>" required>
                            </td>
                            <?php
                          }
                        ?>
                        <!-- <td class="align-middle">
                        <input type="number" class="cal form-control" value="<?=$f2['cie_mark'] ;?>"  id="th<?=$i;?>" name="<?= $i .'s_mt';?>"> 
                        </td> -->
                        <?php } ?>
                       
                        <!-- <td class="align-middle">
                        <input type="number" class="form-control" name="<?= $i.'fmark'?>" id="fmark<?=$i;?>" value="" readonly>
                        </td> -->
                        <input type="hidden" name="<?= $i.'sub_id'?>" value="<?= $f['sub_id']?>">
                        <input type="hidden" name="<?= $i.'c_no'?>" value="<?= $cie_no;?>">
                      
                       
                    </tr>
                    <?php $i++;}  ?>
                        
                      </tbody>
                    </table>
                   
                  </div>
                     <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-3 mt-5" name="insert">Insert</button>
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
    function getcie(cieno){
   // var b_id = $("#batchID").val();
    var d_id= <?= $d_id;?>;
    var sem = <?= $sem;?>;
    $.ajax({
          url:"ajaxfetchmark.php",
          method:"POST",
          data:{cie: cieno, d_id: d_id, sem: sem},
          success:function(data){
            $('#diplay_table').html(data);
            
          }
        });
   
  }

    </script>
<script>
  //to calculate the full marks of the subject
  for(let i=0; i< <?=$snum;?>; i++){
    
    $('.cal').on('input', function(){
      var x =parseInt($('#x'+i).val());
      var y =parseInt($('#a'+i).val());
      
      if(y>x){
      $('#a'+i).val('');
      $('#a'+i).css('border-color','red');
      $('#a'+i).attr('placeholder','Attended class cannot be greater than total class');
    }
    else{
      $('#a'+i).attr('placeholder','0');
      $('#a'+i).css('border-color','#ced4da');
    }
    
  });
  }

</script>

    // restrict the input if the z is greater than x show error message on field in red color
    
   
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