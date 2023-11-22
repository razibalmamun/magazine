<?php
   date_default_timezone_set('Asia/Dhaka');
   //date_default_timezone_set('UTC');
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $ses_sql    = mysqli_query($db,"select id,username from user_list where username = '$user_check' ");  
   $row 	   = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $LoginUsername = $row['username'];
   $userId 		  = $row['id'];
   
   $ses_sqll = mysqli_query($db,"select * from attendance_record where u_id = '$userId' ORDER BY rid DESC LIMIT 0,1");  
   $rows 	 = mysqli_fetch_array($ses_sqll,MYSQLI_ASSOC);
   
   $ridd = $rows['rid'];
   $in   = $rows['signIn'];
   $out  = $rows['signOut'];
   $outt  = date("H:i:s"); 
   
   $date1 = strtotime($in);  
   $date2 = strtotime($outt);  
   $diff  = abs($date2 - $date1);
	
   $years 	= floor($diff / (365*60*60*24));  
   
   $months 	= floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
   $days 	= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));    
   $hours	= floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
   
   //echo $outt;exit;
   $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);  
   $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
   
   if(!isset($_SESSION['login_user'])){ header("location:index.php"); die(); }
?>