<?php 
require_once '../../backend/db.php';

if(isset($_POST['sem'])){
    $sem = $_POST['sem'];
    $sql = "SELECT * FROM `department` WHERE `d_id` = '$sem'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $t_sem = $row['t_sems'];
    for($i = 1; $i <= $t_sem; $i++){
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}
?>