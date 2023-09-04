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
if(isset($_GET['s_id']))
{
$s_id=$_GET['s_id'];
$d_id=$_GET['d_id'];
$sem=$_GET['sem'];

$qry="UPDATE `st_marks` SET `publish` = '1' WHERE s_id = '$s_id' AND sem='$sem'";

$result=mysqli_query($con,$qry);
if($result)
{
    
    
        header('location:student_view.php?d_id='.$d_id);
}
else
{
    echo "Error";
}
}
if(isset($_GET['pro']))
{   
    
    $sid=$_GET['pro'];
    $qry3="select * from s_info s
    join department d on s.d_id=d.d_id where s.s_id='$sid'";
    $result3=mysqli_query($con,$qry3);
    $row3=mysqli_fetch_assoc($result3);
    $tsem=$row3['t_sems'];
    $sem=$_GET['s'];
    $usem=$sem+1;
    if($tsem>=$usem){
    
    $qry2="UPDATE `s_info` SET `sem` = '$usem' WHERE s_id = '$sid';";
    $wx=mysqli_query($con,$qry2);
    if($wx){
        header('location:student_info.php');
    }
    else{
        echo "Error";
    }
}
else{
    //javascript alert student has completed his/her semester
    echo "<script>alert('Student has completed his/her semester');
    window.location.href='student_info.php';
    </script>";
    
}
}
?>