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
$qry="SELECT d.d_name,d.hod,d.t_sems,b.b_id,b.b_start,b.b_end,b.t_students FROM department d INNER JOIN batch b ON d.d_id=b.d_id ORDER BY `b`.`b_start` DESC;";
$res=mysqli_query($con,$qry);
$num=mysqli_num_rows($res);

//submit batch into batch database
if(isset($_POST['submit'])){
    $d_id=$_POST['batch_dept'];
    $b_start=$_POST['b_start'];
    $b_end=$_POST['b_end'];
    $b_student=$_POST['b_student'];
    $qry1="INSERT INTO batch(d_id,b_start,b_end,students) VALUES('$d_id','$b_start','$b_end','$b_student');";
    $res1=mysqli_query($con,$qry1);
    if($res1){
        echo "<script>alert('Batch added successfully');</script>";   
    }
    else{
        echo "<script>alert('Batch not added');</script>";
    }
}
//update batch into batch database
$err=0;
if(isset($_POST['update'])){
    $b_id=$_POST['b_id'];
    $d_id=$_POST['batch_dept'];
    $b_start=$_POST['b_start'];
    $b_end=$_POST['b_end'];
    $b_student=$_POST['b_student'];
    $qry5="UPDATE batch SET d_id='$d_id',b_start='$b_start',b_end='$b_end',t_students='$b_student' WHERE b_id='$b_id';";
    $res5=mysqli_query($con,$qry5);
   
    if($res5){
      $err=1;
      echo "<script>alert('Batch updated successfully');
      location.href='batch.php';</script>";
      
    }
    else{
        echo "<script>alert('Batch not updated');</script>";
        //echo errors
        echo mysqli_error($con);
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
            <a class="nav-link " href="admin_dash.php">
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
        <div class="content-wrapper ">
          <div class="row justify-content-center">
          <div class="col-lg-10 grid-margin stretch-card ">
              <div class="card">
              <?php if($err==1){?> 
             <!-- //auto closing alert show in the top left corner of the screen -->
              <?php } ?>
                <div class="card-body">
                  <h3 class="card-title text-center">Batch Info</h3>
                  <p class="card-description text-center">
                    View All depts batches
                  </p>
                 <!-- div button to add batch -->
                    <div class="text-center pb-5 border-bottom ">
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addBatch">Add Batch</button>
                    </div>
                  <!-- end div button to add batch -->
                  <!-- model to add batch -->
                  <div class="modal fade" id="addBatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="batch.php" method="post">
                            <div class="form-group">
                              <label for="batch_dept">Batch Department</label>
                              <select class="form-control" id="batch_dept" name="batch_dept">
                                <option selected disabled >Select Department</option>
                                <?php
                                  $sql = "SELECT * FROM `department`";
                                  $result = mysqli_query($con, $sql);
                                  while($row = mysqli_fetch_assoc($result)){
                                    echo '<option value="'.$row['d_id'].'">'.$row['d_name'].'</option>';
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="batch_strength">Batch Students</label>
                              <input type="text" class="form-control" id="batch_strength" name="b_student" placeholder="Enter Total Batch Students">
                            </div>
                            <div class="form-group">
                              <label for="batch_start_date">Batch Start Date</label>
                              <input type="date" class="form-control" id="batch_start_date" name="b_start" placeholder="Enter Batch Start Date">
                            </div>
                            <div class="form-group">
                              <label for="batch_end_date">Batch End Date</label>
                              <input type="date" class="form-control" id="batch_end_date" name="b_end" placeholder="Enter Batch End Date">
                            </div> 
                            <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="submit">Add Batch</button>
                        </div>     
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <!-- end model to add batch -->

                                  


                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">Batch ID</th>
                        <!-- from department table -->
                        <th class="text-center font-weight-bolder text-info px-0">Department</th>
                        <th class="text-center font-weight-bolder text-info px-0">HOD</th>
                        <!-- from departmet table ends here -->
                        <th class="text-center font-weight-bolder text-info px-0">Total Semesters</th>
                        <th class="text-center font-weight-bolder text-info px-0">Batch Students</th>
                        <th class="text-center font-weight-bolder text-info px-0">Start Date</th>
                        <th class="text-center font-weight-bolder text-info px-0">End Date</th>
                        <th class="text-center font-weight-bolder text-info">Status</th>
                        <th class="text-danger text-center font-weight-bolder">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        <!-- fetching data for tables  -->
                      <?php 
                    if ($res) {
                    if ($num>0) {
                  while ($f = mysqli_fetch_assoc($res)) {
                    $a=$f['b_start'];
                    $syear = strtok($a, '-');
                    $b=$f['b_end'];
                    $eyear = strtok($b, '-');
                        ?>

                      <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['b_id']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?=  $f['d_name']; ?></p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['hod']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?=  $f['t_sems']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?=  $f['t_students']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $syear ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $eyear ?></span>
                    </td>
                    
                    
                    <td class="align-middle text-center text-sm">
                        <span class="badge badge-warning";>in progress</span>
                        
                    </td>
                    <td class="project-actions align-middle text-center">  
                                     
                        <div class="text-center">
                        <button class="btn btn-inverse-info btn-fw" data-toggle="modal" data-target="#editBatch<?= $f['b_id']; ?>">Edit</button>
                          </div>
                          <div class="modal fade" id="editBatch<?= $f['b_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-danger font-weight-bolder" id="exampleModalLabel">Update Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-left">
                            <form action="batch.php" method="post">
                                  <div class="form-group">
                                    <label for="batch_dept">Batch Department</label>
                                    <?php 
                                    $sql3 = "SELECT * FROM `batch` where b_id='$f[b_id]'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while($row3 = mysqli_fetch_assoc($result3))
                                    {
                                    ?>
                                    <select class="form-control" id="batch_dept" name="batch_dept">
                                    <?php
                                        $sql2 = "SELECT * FROM `department` ";
                                        $result2 = mysqli_query($con, $sql2);
                                        while($row = mysqli_fetch_assoc($result2)){
                                          
                                          if($row['d_id']==$row3['d_id']){
                                            echo '<option selected value="'.$row['d_id'].'">'.$row['d_name'].'</option>';
                                          }else
                                          {
                                            echo '<option value="'.$row['d_id'].'">'.$row['d_name'].'</option>';
                                          }
                                          
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="batch_strength">Batch Students</label>
                                    <input type="text" class="form-control" id="batch_strength" name="b_student" value="<?=$row3['t_students'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="batch_start_date">Batch Start Date</label>
                                    <input type="date" class="form-control" id="batch_start_date" name="b_start" value="<?=$row3['b_start'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="batch_end_date">Batch End Date</label>
                                    <input type="date" class="form-control" id="batch_end_date" name="b_end" value="<?=$row3['b_end'];?>">
                                  </div>
                                  
                                  <input type="hidden" name="b_id" value="<?= $f['b_id']; ?>">
                                  <input type="hidden" name="b_update" value="1">
                                  
                                 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                              </div>
                              <?php
                                    }?>
                          </form>
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
