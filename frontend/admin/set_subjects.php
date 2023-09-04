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
$sql = "SELECT * FROM department";
$result = mysqli_query($con, $sql);

//updating subjects
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
                            //alert("Subject Updated Successfully");
                            window.location.href="set_subjects.php";
                        </script>
                        <?php
                    }
                    else
                    {
                        ?>
                        <script>
                           // alert("Subject Not Updated");
                            //window.location.href="subjects.php";
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
          <!-- form to set subjects -->
            <div class="row">
                <div class="col-11 grid-margin m-auto">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Set Subjects </h4>
                    <p class="card-description border-bottom mb-5 pb-3">
                        Enter Subjects details to add
                        </p>
                    <form class="form-sample" action="add_subs.php" method="GET">
                        
                      <div class="row">
                      <div class="col-md-3">
                        <div class="form-group row m-0 p-0">
                          <label class="col-sm-4 col-form-label">Department</label>
                          <div class="col-sm-8">
                            <!-- select departments from results  -->
                            <select required class="form-control font-weight-bolder" name="d_id" id="department" onclick="fetchem(this.value)">
                            <?php 
                            while($f = mysqli_fetch_assoc($result)){
                          ?>
                                <option  hidden value="">Select Departmet</option>
                                <option value="<?=$f['d_id'];?>"><?=$f['d_name'];?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-5 col-form-label">Which Semester</label>
                          <div class="col-sm-6 m-0 p-0">
                          <select required class="form-control" name="sem" id="sem" >
                          
                          </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-6 col-form-label">Total papers to add</label>
                          <div class="col-sm-4 m-0 p-0">
                            <input required type="number" name="np" class="form-control" />
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-12 d-flex justify-content-end">
                        
                
                       
                        <button type="submit" class="btn btn-primary mr-2">Next</button>
                        
                      </div>
                    </form>

                    </div>
                </div>
            </div>
            </div>
            <div class="row justify-content-center mt-3">
            <div class="col-11 grid-margin stretch-card ">
              <div class="card">
              
             <!-- //auto closing alert show in the top left corner of the screen -->
              
                <div class="card-body">
                  <h1 class="card-title text-center">All Subjects</h1>
                  <p class="card-description text-center">
                    View All Info of subjects
                  </p>

                  <!-- end model to add batch -->

                  <div class="table-responsive table-sm">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">Sub ID</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Code</th>
                        <th class="text-center font-weight-bolder text-info px-0">Name</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Sem</th>
                        <th class="text-center font-weight-bolder text-info px-0">Theory Mark</th>
                        <th class="text-center font-weight-bolder text-info px-0">Internal Mark</th>
                        
                        <th class="text-center font-weight-bolder text-info px-0">Full Mark</th>
                        <th class="text-center font-weight-bolder text-info px-0">Pass Mark</th>
                        
                        <th class="text-danger text-center font-weight-bolder">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                      <?php 
                    // fetching data form subjects tables
                    $sql = "SELECT * FROM subjects";
                    $result = mysqli_query($con, $sql);
                    if($num=mysqli_num_rows($result)>0){
                      while($f = mysqli_fetch_assoc($result)){
                        
                        ?>

                      <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_id']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?= $f['sub_code'];  ?></p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_name']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_sem'];  ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_mtheory']; ?> </span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_minternal']; ?></span>
                    </td>
                    
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_fmark'];?></span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_passmrk'];?></span>
                    </td>
                    
    
                    <td class="project-actions align-middle text-center">
                    
                        <div class="text-center ">
                        
                        <button type="button" class="btn  btn-sm btn-danger btn-icon-text mr-3" onclick="delete_sub('<?= $f['sub_id']; ?>')">
                            <i class="ti-trash btn-icon-prepend"></i>
                            Delete
                          </button>

                          <!-- delete button to delete subject from semester using javascript -->

                        <script>
                          function delete_sub(sub_id){
                            var r = confirm("Are you sure you want to delete this subject?");
                            if (r == true) {
                              window.location.href = "delete_sub.php?sub_id="+sub_id+"&d_id=0";
                            } else {
                              return false;
                            }
                          }
                        </script>
                        <button class="btn btn-inverse-info btn-fw" data-toggle="modal" data-target="#editSub<?= $f['sub_id']; ?>">Edit</button>
                          </div>
                          

                          <div class="modal fade" id="editSub<?= $f['sub_id']; ?>" oninput="cal(<?=$f['sub_id']?>)"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                               
                                <h5 class="modal-title text-danger font-weight-bolder" id="exampleModalLabel">Update Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-left">
                                <form action="" method="POST">
                                <?php 
                                    $sql3 = "SELECT * FROM `subjects` where sub_id='$f[sub_id]'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while($row3 = mysqli_fetch_assoc($result3))
                                    { ?>
                                  <div class="form-group">
                                    <label for="a">Subject Code</label>
                                    <input type="text" class="form-control" id="a" name="sub_code" value="<?=$row3['sub_code'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="b">Subject Name</label>
                                    <input type="text" class="form-control" id="b" name="s_name" value="<?=$row3['sub_name'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="c">Theory Mark</label>
                                    <input type="number" class="cal form-control" id="try<?=$f['sub_id']?>" name="s_tmark" value="<?=$row3['sub_mtheory'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="d">Internal Mark</label>
                                    <input type="number" class="cal form-control" id="intr<?=$f['sub_id']?>" name="s_inmark" value="<?=$row3['sub_minternal'];?>">
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                    <label for="e">Full Mark</label>
                                    <input type="number" class="form-control" id="full<?=$f['sub_id']?>" name="s_fmark" value="<?=$row3['sub_fmark'];?>" readonly>
                                  </div>
                                
                                  
                                 
                              </div>
                              <div class="modal-footer">
                              <input type="hidden" name="sub_id" value="<?= $f['sub_id']; ?>">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="updateSub" class="btn btn-primary">Update</button>
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
    <!-- MAINBODY ends -->
    <!-- script to fetch data from ajaxfetch using ajaxfetch.php -->
    <script type="text/javascript">
      // function fetch(id){
      //   $('#batch').html("<option value=''>Select Batch</option>");
      //   $.ajax({
      //     url:"ajaxfetch.php",
      //     method:"POST",
      //     data:{d_id:id},
      //     success:function(data){
      //       $('#batch').html(data);
      //       $('#sem').html("<option value=''>Select sem</option>");
      //     }
      //   });
      // }
      function fetchem(id){
        $('#sem').html("<option value=''>Select semester</option>");
        $.ajax({
          url:"ajaxfetch.php",
          method:"POST",
          data:{d_id:id},
          success:function(data){
            $('#sem').html(data);
            
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
      function cal(sub){
        var subid=sub;
        
      var x =parseInt($('#try'+subid).val());
      var y =parseInt ($('#intr'+subid).val());
      var z = parseInt ($('#prac'+subid).val());
      
    if(Number.isNaN(x))
    {
      x = 0;
    } 
    if(Number.isNaN(y))
    {
      y = 0;
    }
    if(Number.isNaN(z))
    {
      z = 0;
    }
    var f = x+y+z;
    
    $('#full'+subid).val(f);
        }
</script>
  <script src="../../assets2/vendors/js/vendor.bundle.base.js"></script>
 
  <script src="../../assets2/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../assets2/vendors/select2/select2.min.js"></script>
  
  <script src="../../assets2/js/off-canvas.js"></script>
  <script src="../../assets2/js/hoverable-collapse.js"></script>
  <script src="../../assets2/js/template.js"></script>
  <script src="../../assets2/js/settings.js"></script>
  <script src="../../assets2/js/todolist.js"></script>

  <script src="../../assets2/js/file-upload.js"></script>
  <script src="../../assets2/js/typeahead.js"></script>
  <script src="../../assets2/js/select2.js"></script>
  
</body>

</html>
