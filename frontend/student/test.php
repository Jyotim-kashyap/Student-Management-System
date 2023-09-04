<?php
require_once '../../backend/db.php';
session_start();
$uid=$_SESSION['name'];

$id=$_SESSION['id'];
$isAdmit=0;
$qry="SELECT * FROM `s_info` WHERE `s_id` = '$id'";

$qrr=mysqli_query($con,$qry);
$num= mysqli_num_rows($qrr);
if($num>0)
{
    $isAdmit=1;
}

if(isset($_POST['sub']))
{
    $name=$_POST['name'];
    $sem=$_POST['sem'];
    $dept=$_POST['dept'];
   // $batch=$_POST['batch'];
    $dob=$_POST['dob'];
    $grdnno=$_POST['grdnno'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $adrs=$_POST['adrs'];
    $gender=$_POST['gender'];
    $pin=$_POST['pin'];


    $qry="INSERT INTO `s_info` (`s_id`, `s_name`, `s_roll`, `dept`, `admsn_date`, `dob`, `fname`, `mname`, `adrs`, `pin`, `sem`, `grdnno`,'gender') VALUES 
    ('$id', '$name', '123', '$dept', current_timestamp(), '$dob', '$fname', '$mname', '$adrs', '$pin', '$sem', '$grdnno','$gender');";

    $res=mysqli_query($con,$qry);
    if($res)
    {
        echo "<script>alert('Student Added Successfully')</script>";
    }
    else
    {
        echo "<script>alert('Student Not Added')</script>";
    }
}
?>