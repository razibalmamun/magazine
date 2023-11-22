<?php
date_default_timezone_set('Asia/Dhaka');
include('session.php');
$today = date("Y-m-d H:i:s");


$ttlHours = $hours."hrs"."-".$minutes."min";
$ipaddresOut = $_SERVER['REMOTE_ADDR'];
// echo $hours;exit;
// echo $in-$today;exit;
$sql = mysqli_query($db, "UPDATE attendance_record SET signOut='$today', tHours='$ttlHours', ip_sout='$ipaddresOut' WHERE rid='$ridd'");

   session_start();
   if(session_destroy()) { 
      header("Location: index.php");
   }
?>