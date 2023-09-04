<?php 
require_once '../../backend/db.php';

//fetch data from batch where d_id = $_POST['d_id']
//coming from set_subs.php ,ajax call
if(isset($_POST['d_id'])){
    $query = "SELECT * FROM batch WHERE d_id = '".$_POST['d_id']."' ORDER BY `b_start` ASC";
    $result = mysqli_query($con, $query);
    $num=mysqli_num_rows($result);

    if($num>0)
    {
    while($row = mysqli_fetch_assoc($result)){

        //echo as options of b_id and b_start and b_end
        $syear=strtok($row['b_start'],'-');
        $eyear=strtok($row['b_end'],'-');
        $tsem=$row['t_sems'];
        
        echo '<option value="'.$row['b_id'].'">'.$syear.' - '.$eyear.'</option>';
    }  
}else{
        echo '<option value="">No Batch Found. ADD batch to continue</option>';
}
}
//end of set_subs.php ,ajax call

if(isset($_POST['b_id'])){
    //select from deapaerment where d_id = $_POST['d_id']
    $query = "select t_sems from department d JOIN batch b on b.d_id=d.d_id WHERE b.b_id= '".$_POST['b_id']."'"; 
    $result =mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if($num=mysqli_num_rows($result)>0){
    
    $tsem=$row['t_sems'];
    //echo as options of t_sem
    for($i=1;$i<=$tsem;$i++){
        echo '<option value="'.$i.'">'.$i.'</option>';

        //echo '<option value="">'.$row['d_name'].'</option>';
    }}
    else{
        echo '<option value="">Select Semester</option>';
    }

    unset($_POST['b_id']);
}
          
 //displaying data in table of subject view page semester wise
              if(isset($_POST['batch_id']) && isset($_POST['dept_id'])){
              $d_id=$_POST['dept_id'];
              $b_id=$_POST['batch_id'];
              $qry1="SELECT * FROM `department` WHERE `d_id` = '$d_id'";
              $re=mysqli_query($con,$qry1);
              $row=mysqli_fetch_array($re);
              $sem=$row['t_sems'];
              ?>
              <?php 
                  for($i=1;$i<=$sem;$i++){
                  ?>
                  <div class="table-responsive table-bordered table-sm mt-3 mb-3" id="diplay_table">
                  
                      <div class="card-title d-flex justify-content-between"> 
                      <h3 class="ml-5">Semester: <span class="text-danger font-weight-bolder"><?= $i; ?> </span></h3>
                      
                      <!-- button to add subject to semester using link  -->
                      <!-- <a href="add_subject.php?batch_id=<?= $b_id; ?>&d_id=<?= $d_id; ?>&b_id=<?= $b_id; ?>&sem=<?= $i; ?>" class="btn btn-primary ml-5">Add Subject</a> -->
                      <!-- onclick="location.href='add_subs.php?d_id=<?= $d_id; ?>&b_id=<?= $b_id; ?>&sem=<?= $i; ?>&np=1'" -->
                      <button data-toggle="modal" data-target="#addSub<?=$i;?>" type="button" class="btn btn-primary btn-icon-text mr-3" >
                          <i class="ti-file btn-icon-prepend"></i>
                          Add Sub
                        </button>
                      </div>
                      <!-- model to add subject  -->
                      <div class="modal fade" id="addSub<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="add_subs.php" method="GET">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Total Number Of Subject To Add</label>
                                  <input type="text" class="form-control" name="np" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter No of subs">
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <input type="hidden" name="d_id" value="<?= $d_id; ?>">
                                  <input type="hidden" name="b_id" value="<?= $b_id; ?>">
                                  <input type="hidden" name="sem" value="<?= $i; ?>">
                                  <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end  -->




                    <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="text-center font-weight-bolder text-info">Sub ID</th>
                        
                        <th class="font-weight-bolder text-info">Code</th>
                        <th class="font-weight-bolder text-info">Name</th>
                      
                        
                        <th class="font-weight-bolder text-info text-center ">Theory Mark</th>
                        <th class="font-weight-bolder text-info text-center">Internal Mark</th>
                        <th class="font-weight-bolder text-info text-center">Practical</th>
                        <th class="font-weight-bolder text-info text-center">Full Mark</th>
                        
                        <th class="text-danger text-center font-weight-bolder">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                      <?php 
                    // fetching data form subjects tables
                    $sql = "SELECT * FROM subjects where d_id = '$d_id' and b_id = '$b_id' and sub_sem = '$i'";
                    $result = mysqli_query($con, $sql);
                    if($num=mysqli_num_rows($result)>0){
                      while($f = mysqli_fetch_assoc($result)){
                        
                        ?>

                      <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_id']; ?></span>
                    </td>
                    <td class="align-middle">
                        <p class="text-l font-weight-bold text-sm mb-0"><?= $f['sub_code'];  ?></p>
                    </td>
                    <td class="align-middle">
                        <span class="text-l text-sm font-weight-bold"><?= $f['sub_name']; ?></span>
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
                    
                        <div class="text-center">
                         <!-- delete button to delete subject from semester using javascript -->
                          <button type="button" class="btn  btn-sm btn-danger btn-icon-text mr-3" onclick="delete_sub('<?= $f['sub_id']; ?>','<?= $d_id; ?>')">
                            <i class="ti-trash btn-icon-prepend"></i>
                            Delete
                          </button>

                          <!-- delete button to delete subject from semester using javascript -->

                        <script>
                          function delete_sub(sub_id,d_id){
                            var r = confirm("Are you sure you want to delete this subject?");
                            if (r == true) {
                              window.location.href = "delete_sub.php?sub_id="+sub_id+"&d_id="+d_id;
                            } else {
                              return false;
                            }
                          }
                        </script>
                        
                        <button class="btn btn-inverse-info btn-fw" data-toggle="modal" data-target="#editSub<?= $f['sub_id']; ?>">Edit</button>
                          </div>
                          

                          <div class="modal fade" id="editSub<?= $f['sub_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="number" class="form-control" id="c" name="s_tmark" value="<?=$row3['sub_external'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="d">Internal Mark</label>
                                    <input type="number" class="form-control" id="d" name="s_inmark" value="<?=$row3['sub_minternal'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="e">Full Mark</label>
                                    <input type="number" class="form-control" id="e" name="s_fmark" value="<?=$row3['sub_fmark'];?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="f">Practical</label>
                                    <select class="form-control" name="isP" id="f">
                                      <option value="0" <?php if($row3['isPractical']==0){echo "selected";} ?>>No</option>
                                      <option value="1" <?php if($row3['isPractical']==1){echo "selected";} ?>>Yes</option>
                                    </select>
                                      
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
                  <hr>
                <?php
                }
                ?>
                <?php
                }
                unset($_POST['batch_id']);
                unset($_POST['department_id']);
               
 
?>