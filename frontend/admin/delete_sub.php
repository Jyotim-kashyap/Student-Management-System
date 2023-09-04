<?php
require_once '../../backend/db.php';
session_start();
$sid = $_GET['sub_id'];
$did= $_GET['d_id'];    
    $dd="DELETE FROM subjects WHERE `sub_id` = '$sid'";
    $del_query=mysqli_query($con,$dd);
    if($did>0)
    {
        header('Location:dept_sub.php?d_id=' . $did);
    }
    else
    {
        header("Location:set_subjects.php");
    }
   
    
