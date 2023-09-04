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


//insert form values in department table
if(isset($_POST['submit'])){
$d_name=$_POST['d_name'];
$t_sems=$_POST['t_sems'];
$hod=$_POST['hod'];
$d_established=$_POST['d_established'];
    $sql="INSERT INTO department(d_name,t_sems,hod,d_established) VALUES('$d_name','$t_sems','$hod','$d_established')";
    $res=mysqli_query($con,$sql);
    if($res){
        echo "<script>alert('Department added successfully');</script>";
    }
    else{
        echo "<script>alert('Error adding department');</script>";
    }
}
//update form values in department table
if(isset($_POST['update'])){
    $d_id=$_POST['d_id'];
    $d_name=$_POST['d_name'];
    $t_sems=$_POST['t_sems'];
    $hod=$_POST['hod'];
    $d_established=$_POST['d_established'];
    $sql="UPDATE department SET d_name='$d_name',t_sems='$t_sems',hod='$hod',d_established='$d_established' WHERE d_id='$d_id'";
    $res=mysqli_query($con,$sql);
    if($res){
        echo "<script>alert('Department updated successfully');</script>";
    }
    else{
        echo "<script>alert('Error updating department');</script>";
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
          <div class="col-lg-10 grid-margin stretch-card ">
              <div class="card">
              
                <div class="card-body">
                  <h3 class="card-title text-center">Department Info</h3>
                  <p class="card-description text-center">
                    View All departments
                  </p>
                  <!-- div button to add new department -->
                  <div class="text-center pb-5 border-bottom">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_department">Add Department</button>
                  </div>
                  <!-- end of div button to add new department -->
                  <!-- model to add department -->
                  <div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">New department info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="post">
                            
                            <div class="form-group">
                              <label for="batch_strength">Department Name</label>
                              <input type="text" class="form-control" id="batch_strength" name="d_name" placeholder="Enter Department Name">
                            </div>

                            <div class="form-group">
                              <label for="batch_start_date">Total Semesters</label>
                              <input type="number" class="form-control" id="batch_start_date" name="t_sems" placeholder="Enter Total Semesters">
                            </div>

                            <div class="form-group">
                              <label for="batch_end_date">Head of the Department</label>
                              <input type="text" class="form-control" id="batch_end_date" name="hod" placeholder="Enter HOD Name">
                            </div> 

                            <div class="form-group">
                              <label for="batch_end_date">Date Established</label>
                              <input type="date" class="form-control" id="batch_end_date" name="d_established" placeholder="Enter Date Established">
                            </div> 
                            
                            <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="submit">Add</button>
                        </div>     
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>



                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="text-center font-weight-bolder text-info">Department ID</th>
                        <th class="text-center font-weight-bolder text-info">Name</th>
                        <th class="text-center font-weight-bolder text-info">Total Semesters</th>
                        <th class="text-center font-weight-bolder text-info">HOD</th>
                        <th class="text-center font-weight-bolder text-info">Established</th>
                        <th class="text-danger font-weight-bolder text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        <!-- fetching data for tables  -->
                      <?php 
                      //view departments
                      $sql="SELECT * FROM department";
                      $res=mysqli_query($con,$sql);
                      $num=mysqli_num_rows($res);
                    if ($num>0) {
                  while ($f = mysqli_fetch_assoc($res)) {
                        ?>

                      <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['d_id']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?=  $f['d_name']; ?></p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['t_sems']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?=  $f['hod']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?=  $f['d_established']; ?></span>
                    </td>
                    <td class="project-actions align-middle text-center">  
                                     
                      <button class="btn btn-inverse-danger btn-fw" data-toggle="modal" data-target="#editDept<?= $f['d_id']; ?>">Edit</button>
                          <i class="fa fa-edit"></i><span></span>
                      </button>
                       <!-- model to update department -->
                        <div class="modal fade" id="editDept<?= $f['d_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-danger font-weight-bolder" id="exampleModalLabel">Edit Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-left">
                          <form action="" method="post">
                            <?php $d_id = $f['d_id']; 
                            $sql1="SELECT * FROM `department` WHERE `d_id`='$d_id'";
                            $res1=mysqli_query($con,$sql1);
                           while($f1=mysqli_fetch_assoc($res1)){;

                            ?>
                            <div class="form-group">
                              <label for="batch_strength">Department Name</label>
                              <input type="text" class="form-control" id="batch_strength" name="d_name" placeholder="Enter Department Name" value="<?= $f1['d_name']; ?>">
                            </div>

                            <div class="form-group">
                              <label for="batch_start_date">Total Semesters</label>
                              <input type="number" class="form-control" id="batch_start_date" name="t_sems" placeholder="Enter Total Semesters" value="<?= $f1['t_sems']; ?>">
                            </div>

                            <div class="form-group">
                              <label for="batch_end_date">Head of the Department</label>
                              <input type="text" class="form-control" id="batch_end_date" name="hod" placeholder="Enter HOD Name" value="<?= $f1['hod']; ?>">
                            </div> 

                            <div class="form-group">
                              <label for="batch_end_date">Date Established</label>
                              <input type="date" class="form-control" id="batch_end_date" name="d_established" placeholder="Enter Date Established" value="<?= $f1['d_established']; ?>">
                            </div> 
                            <input type="hidden" name="d_id" value="<?= $f1['d_id']; ?>">
                            <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="update" class="btn btn-primary" name="update">Edit</button>
                        </div>  
                        <?php } ?>   
                          </form>
                        </div>
                        </div>
                      </div>
                    </div>
                            

                                 

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
