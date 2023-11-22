<?php include('session.php');
//date_default_timezone_set('Asia/Dhaka'); ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Attendance System</title>
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php 
$endDayRunningMonth = date('Y-m-t');
$fromDay 			= date('Y-m-01');
$usrID  			= $_GET['uid'];

//for collect name
$ses_sql    = mysqli_query($db,"select * from user_list where id = '$usrID' ");  
$row 	    = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);						   
$empName = $row['username'];
//end collect name

?>


  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include "include/leftnav.php"; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php include "include/topmenu.php"; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Report >> <span style="color:red;"><?php echo $empName; ?></span></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
					  <th>Date</th>
                      <th>In</th>
                      <th>Out</th>
                      <th>Hours</th>                    
                    </tr>
                  </thead>
				<?php
						//echo $userId;						
						$sql = "SELECT * FROM `attendance_record` WHERE DATE(signIn)>='$fromDay' and DATE(signIn)<='$endDayRunningMonth' and u_id='$usrID' order by signIn DESC";
						$rs = mysqli_query($db,$sql);
				
						//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
						$i=1;
						while($result = mysqli_fetch_array($rs,MYSQLI_ASSOC)){	
						    
							$userID = $result['u_id'];

							//$dif = date(strtotime($result['signIn']));							
							$dt 	= date('j M, Y', strtotime($result['signIn']));
							$tm 	= date('h:i a', strtotime($result['signIn']));
							if($result['signOut']==null){
								$tms = "---";}
							else{
								$tms = date('h:i a', strtotime($result['signOut']));
							} 
					?>				  
				  <tbody>
					<tr>
					  <td><?php echo $i;?> </td>
					  <td><?php echo $dt;?></td>
					  <td><?php echo $tm;?></td>
					  <td><?php echo $tms;?></td>
					  <?php
					  if($userID == 15){
					      if (preg_match("/7hrs/i", $result['tHours']) or preg_match("/8hrs/i", $result['tHours'])) { ?>
							<td><?php echo $result['tHours']; ?></td>
						<?php } elseif(preg_match("/---/i", $result['tHours'])){?>
						    <td><?php echo $result['tHours']; ?></td>
						<?php }else { ?>
							 <td style="background:red; color:#000;"><?php echo $result['tHours']; ?></td>
					    <?php } ?>
					  
					  <?php }
					  else{
					  if (preg_match("/8hrs/i", $result['tHours']) or preg_match("/9hrs/i", $result['tHours']) or preg_match("/10hrs/i", $result['tHours'])) { ?>
							<td><?php echo $result['tHours']; ?></td>
						<?php } elseif(preg_match("/---/i", $result['tHours'])){?>
						    <td><?php echo $result['tHours']; ?></td>
						<?php }else { ?>
							 <td style="background:red; color:#000;"><?php echo $result['tHours']; ?></td>
					<?php }} ?>
					</tr>				   
				  </tbody>
                <?php $i++; } ?> 
	</table>
  </div>
</div>
</div>


        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
     <?php include "include/footer.php"; ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <?php include "include/logmodel.php"; ?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts 
  <script src="js/demo/datatables-demo.js"></script>-->
</body>
</html>