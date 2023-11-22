<?php
  date_default_timezone_set('Asia/Dhaka');
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM user_list WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      $userID = $row['id'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
		  //echo $row['id'];exit;
         //session_register("myusername");
		 
		 //condiiton 
		 //1. already sign in
		 //2. today sign in
		 
		  $sqlq = "SELECT rid, u_id, DATE(signIn) as dt FROM attendance_record WHERE u_id = '$userID' ORDER BY rid DESC";
		  $resultq = mysqli_query($db,$sqlq);
		  $rowq = mysqli_fetch_array($resultq,MYSQLI_ASSOC);
		  //$active = $row['active'];
		  $today = date("Y-m-d");
		  $signIn = $rowq['dt'];
		  $todays = date("Y-m-d H:i:s");
		  
		  
	    if($userID == 15 ){
			  //echo "for baki=8 and nirob=15";
				  $sq    = "SELECT * FROM `attendance_record` WHERE u_id=15 ORDER by rid DESC LIMIT 0,1";
				  $rs    = mysqli_query($db,$sq);
				  $rdata = mysqli_fetch_array($rs,MYSQLI_ASSOC);
				  $ipaddress = $_SERVER['REMOTE_ADDR']; 
				 // echo "s-i-g-n-out::".$rdata['signOut'];exit;
					 if(empty($rdata['signOut'])){
					     //echo "empty";exit;
					   //  echo "abc";
						 header("location: welcome.php"); 		 
						
					 }else{
					   //   echo "insert";
					   //   echo  "INSERT INTO attendance_record (u_id,signIn,ip_sign) VALUES ($userID, '$todays', '$ipaddress')";
						  $sql = mysqli_query($db, "INSERT INTO attendance_record (u_id,signIn,ip_sign) VALUES ($userID, '$todays', '$ipaddress')");
					       //print_r($sql);
					     
					 }
			   $_SESSION['login_user'] = $myusername;
			   
		  }
		 
		 if($today != $signIn and $userID != 15){
			 //echo $signIn;exit;
			 //echo "INSERT INTO record (u_id,signIn) VALUES ($userID,$todays)";exit;
			 $ipaddress = $_SERVER['REMOTE_ADDR']; 
			
	       $sql = mysqli_query($db, "INSERT INTO attendance_record (u_id,signIn,ip_sign) VALUES ($userID, '$todays', '$ipaddress')");
		 }
	  
         $_SESSION['login_user'] = $myusername;
         if($myusername == 'admin'){
             header("location: employee.php");
         }else{
             header("location: welcome.php");
         }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Login Page</title>   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!--Fontawesome CDN-->
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 style="font-size:20px;">Sign In [BreakingNews.com.bd]</h3>				
			</div>
			<div class="card-body">
				<form action = "<?php $_SERVER["PHP_SELF"] ?>" method = "post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="text" name = "username" class="form-control" placeholder="username">					
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="password" name = "password" class="form-control" placeholder="password">
					</div>				
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>
</body>
</html>