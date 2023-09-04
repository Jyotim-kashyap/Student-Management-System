<?php   
require_once '../../backend/db.php';

if(isset($_POST['dept_id'])){
    $d_id=$_POST['dept_id'];
    $year=$_POST['batch'];

    $qry="SELECT * FROM `s_info` WHERE `d_id` = '$d_id' AND `batch` = '$year' AND `isVarified` = 1";
    $exc=mysqli_query($con,$qry);
    
    
?> 

        <div class="table-responsive mt-3 mb-3" id="diplay_table">
        <div class="table-responsive">
                    <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="font-weight-bolder text-info text-center">Roll-No</th>
                      <th class="font-weight-bolder text-info text-center">Name</th>
                      <th class="font-weight-bolder text-info text-center">Gender</th>
                      <th class="font-weight-bolder text-info text-center">Semester</th>
                      <th class="font-weight-bolder text-info text-center">Status</th>
                      <th class="font-weight-bolder text-info text-center">Attendence</th>
                      
                      <th class="text-danger text-center">Actions</th>
                    </tr>
                  </thead>
                      <tbody>
                      <?php 
                  if ($num = mysqli_num_rows($exc)>0){
                    

                  while ($f=mysqli_fetch_assoc($exc)) {
                    $dc=0;
                    $p=0;
                    $qr1="SELECT AVG(perc) from `attendence` where `s_id` = '$f[s_id]'";
                    $exc1=mysqli_query($con,$qr1);
                    if($atc=mysqli_num_rows($exc1)>0)

                    {$f1=mysqli_fetch_assoc($exc1);
                    $perc=$f1['AVG(perc)'];
                      if($perc<65){
                        $dc=1;
                      }
                      else{
                        $dc=0;
                      }
                    }else{
                        $perc=0;
                        
                    }
                    
                        ?>
               <!-- <a href="view_questions.php?examid="> Exam id is:?></a>-->
                  <tr>
                  <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['s_roll']; ?></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-l font-weight-bold text-sm mb-0"><?php echo $f['s_name']; ?></p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['gender']; ?></span>
                    </td>
                   
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?php echo $f['sem']; ?></span>
                    </td>
                    <?php 
                     
                     
                    
                     $qry2="SELECT * FROM cie WHERE  `s_id` = '$f[s_id]';";
                     $exc2=mysqli_query($con,$qry2);
                     $stat1= mysqli_num_rows($exc2);;
                    $qry4="SELECT * FROM `st_marks` WHERE `s_id` = '$f[s_id]' AND `publish` = '1'";
                    $exc4=mysqli_query($con,$qry4);
                    $stat2= mysqli_num_rows($exc4);

                    
                     $qry1="SELECT * FROM `st_marks` WHERE `s_id` = '$f[s_id]' AND `sem` = '$f[sem]' ";
                      $exs=mysqli_query($con,$qry1);
                      $stat = mysqli_num_rows($exs);
                    ?>
                    <td class="align-middle text-center text-sm">
                        <span class="badge badge-lg bg-gradient-<?php 
                        if($stat>0)
                        {
                            echo "success";
                            }
                            elseif($stat==0){
                                echo "warning";  
                            }
                            ?>"><?php 
                            if($stat>0)
                            {
                                echo "Marks Submitted";
                                }
                                elseif($stat==0){
                                    echo "Not Submitted";  
                                } ?> 
                                </span>
                        
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-l text-sm font-weight-bold"><?= number_format($perc,2)."%" ?></span>
                    </td>
                    
                    <td class="align-middle text-center project-actions">
                            
                    <a class="btn btn-warning btn-sm" href="cie_mark.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-folder">
                              </i>
                              ADD CIE MARKS
                          </a>
                            <a class="btn btn-info btn-sm <?php 
                           
                            if($stat1==0 || $dc==1)
                            {
                                echo "disabled";
                                }
                                elseif($stat1>0 && $dc==0){
                                    echo "";  
                                } ?>" href="add_mark.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-eye">
                              </i>
                              ADD MARKS
                          </a>
                          
                          <a class="btn btn-primary btn-sm" href="view_mark.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-folder">
                              </i>
                              VIEW MARKS
                          </a>
                          <a class="btn btn-danger btn-sm <?php 
                            if($stat>1)
                            {
                                echo "";
                                }
                                elseif($stat==0){
                                    echo "disabled";  
                                } ?>" href="edit_mark.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-eye">
                              </i>
                              EDIT MARKS
                          </a>
                          <a class="btn btn-success btn-sm <?php 
                            if($stat2==0)
                            {
                                echo "";
                                }
                                elseif($stat2>0 ){
                                    echo "disabled";  
                                } ?>" href="publish.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-eye">
                              </i>
                              Publish Result
                          </a>
                          <a class="btn btn-dark btn-sm" href="backlog.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                              <i class="fas fa-eye">
                              </i>
                              Backlogs
                          </a>
                      </td>
                    </tr>
                    <?php
                // $i++;
              }
                }else
                    {
                    ?>
    
                    <tr>
                    <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        <td class="align-middle text-center">
                          <p class="text-secondary text-xs font-weight-bold">-empty-</p>
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
                        <td class="align-middle">
                          <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                        </td>
                        </tr>
                        <?php
                        
                }
                ?>
                  </tbody>

                </table>
              </div>
<?php
    }


    //cie marks column to add
          if(isset($_POST['cie'])){
            $cie_no = $_POST['cie'];
            $d_id = $_POST['d_id'];
            $sem = $_POST['sem'];
          //selecting Subjects from subject table
          $sqry="SELECT * FROM `subjects` WHERE `d_id` = '$d_id' AND `sub_sem` = '$sem'";
          $sexc=mysqli_query($con,$sqry);
          
          ?>
           <table class="table table-hover">
                      <thead>
                        <tr>
                        <th class="font-weight-bolder text-info">No</th>
                        <th class="font-weight-bolder text-info ">Subject Code</th>
                        <th class="font-weight-bolder text-info ">Subject Name</th>
                        <?php for($k=1;$k<=$cie_no;$k++){?>
                        <th class="font-weight-bolder text-info ">Cie <?=$k ?> Mark</th>
                        <?php } ?>
                        <th class="font-weight-bolder text-info ">Obtained Marks</th>
                        <th class="text-center font-weight-bolder text-info">Status</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                      <tbody>
                        
                  
                      <form action="" method="POST">
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
                       <?php for($j=1;$j<=$cie_no;$j++){?>
                        <td class="align-middle">
                        <input type="number" class="cal form-control" placeholder="0"  id="th<?=$i;?>" name="<?= $i .'s_mt';?>"> 
                        </td>
                        <?php } ?>
                       
                        <td class="align-middle">
                        <input type="number" class="form-control" name="<?= $i.'fmark'?>" id="fmark<?=$i;?>" value="" readonly>
                        </td>
                        <input type="hidden" name="<?= $i.'sub_id'?>" value="<?= $f['sub_id']?>">
                        <input type="hidden" name="<?= $i.'c_no'?>" value="<?= $cie_no;?>">
                       
                    </tr>
                    <?php $i++;}  ?>
                        
                      </tbody>
                    </table>
                   
                  </div>
                     <div class="col-md-12 d-flex justify-content-end">
                        
                      </div>
                      <input type="submit" class="btn btn-primary mr-3 mt-5" name="insert" >
                      </form>
               
<?php
       }
        //end of cie marks column to add

        //attendece for students

        if(isset($_POST['Adept_id'])){
          $d_id=$_POST['Adept_id'];
          $year=$_POST['batch'];
      
          $qry="SELECT * FROM `s_info` WHERE `d_id` = '$d_id' AND `batch` = '$year' and `isVarified` = '1'";
          $exc=mysqli_query($con,$qry);
          
          
          
      ?> 
      
              <div class="table-responsive mt-3 mb-3" id="diplay_table">
              <div class="table-responsive">
                          <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="font-weight-bolder text-info text-center">Roll-No</th>
                            <th class="font-weight-bolder text-info text-center">Name</th>
                            <th class="font-weight-bolder text-info text-center">Gender</th>
                            <th class="font-weight-bolder text-info text-center">Semester</th>
                            <th class="font-weight-bolder text-info text-center">Status</th>
                            <th class="font-weight-bolder text-info text-center">Avg Percentage</th>
                            <th class="font-weight-bolder text-info text-center">Result</th>
                            <th class="text-danger text-center">Actions</th>
                          </tr>
                        </thead>
                            <tbody>
                            <?php 
                        if ($num = mysqli_num_rows($exc)>0){
                          
                          $i=0;
                        while ($f=mysqli_fetch_assoc($exc)) {
                              $qr1="SELECT AVG(perc) from `attendence` where `s_id` = '$f[s_id]'";
                              $exc1=mysqli_query($con,$qr1);
                              $f1=mysqli_fetch_assoc($exc1);
                              $perc=$f1['AVG(perc)'];
                              ?>
                     <!-- <a href="view_questions.php?examid="> Exam id is:?></a>-->
                        <tr>
                        <td class="align-middle text-center">
                              <span class="text-l text-sm font-weight-bold"><?php echo $f['s_roll']; ?></span>
                          </td>
                          <td class="align-middle text-center">
                              <p class="text-l font-weight-bold text-sm mb-0"><?php echo $f['s_name']; ?></p>
                          </td>
                          <td class="align-middle text-center">
                              <span class="text-l text-sm font-weight-bold"><?php echo $f['gender']; ?></span>
                          </td>
                         
                          <td class="align-middle text-center">
                              <span class="text-l text-sm font-weight-bold"><?php echo $f['sem']; ?></span>
                          </td>
                          
                          <?php 
                           
                           $qry1="SELECT * FROM `attendence` WHERE `s_id` = '$f[s_id]'";
                           $qry2="SELECT * FROM cie WHERE  `s_id` = '$f[s_id]';";
                           $exc2=mysqli_query($con,$qry2);
                           $stat1= mysqli_num_rows($exc2);;
                           
                            $exs=mysqli_query($con,$qry1);
                            $stat = mysqli_num_rows($exs);
                          ?>
                          <td class="align-middle text-center text-sm">
                              <span class="badge badge-lg bg-gradient-<?php 
                              if($stat>0)
                              {
                                  echo "success";
                                  }
                                  elseif($stat==0){
                                      echo "warning";  
                                  }
                                  ?>"><?php 
                                  if($stat>0)
                                  {
                                      echo "Attendece Submitted";
                                      }
                                      elseif($stat==0){
                                          echo "Not Submitted";  
                                      } ?> 
                                      </span>
                              
                          </td>
                          <td class="align-middle text-center">
                              <span class="cal text-l text-sm font-weight-bold"><?= number_format($perc,2) ?></span>
                          </td>
                          <td class="align-middle text-center">
                            <?php if($perc>=65 && $perc<=74)
                            { ?>
                              <span class="btn btn-md font-weight-bolder text-white bg-gradient-warning" >NC</span>
                              <?php }else if($perc>=75){?>
                              <span class="btn btn-md font-weight-bolder text-white bg-gradient-success" >OK</span>
                              <?php }elseif($perc<65){?>
                              <span class="btn btn-md font-weight-bolder text-white bg-gradient-danger" >DC</span>
                              <?php } ?>
                          </td>
                          <td class="align-middle text-center project-actions">
                          <a class="btn btn-info btn-sm <?php 
                                  if($stat>0)
                                  {
                                      echo "disabled";
                                      }
                                      elseif($stat==0){
                                          echo "";  
                                      } ?>" href="atten_cal.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                                    <i class="fas fa-folder">
                                    </i>
                                    Add Attendece
                                </a>
                                  <a class="btn btn-info btn-sm <?php 
                                  if($stat==0)
                                  {
                                      echo "disabled";
                                      }
                                      elseif($stat>0){
                                          echo "";  
                                      } ?>" href="edit_cal.php?d_id=<?= $d_id;?>&sem=<?= $f['sem']; ?>&s_id=<?= $f['s_id'];?>">
                                    <i class="fas fa-eye">
                                    </i>
                                    Edit Attendece
                                </a>
                                
                            </td>
                          </tr>
                          <?php
                       $i++;
                    }
                      }else
                          {
                          ?>
          
                          <tr>
                          <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-secondary text-xs font-weight-bold">-empty-</p>
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
                              <td class="align-middle">
                                <span class="text-secondary text-xs font-weight-bold">-empty-</span>
                              </td>
                              </tr>
                              <?php
                              
                      }
                      ?>
                        </tbody>
      
                      </table>
                    </div>
      <?php
          }

?>