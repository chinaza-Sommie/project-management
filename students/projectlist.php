<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  global $ConnectingDB;
  $sql = "SELECT * FROM studentdetails WHERE studentid = '$studentuserId' ";
  $stmt = $ConnectingDB->query($sql);
  $SN = 0;
  while ($DataRows = $stmt->fetch()) {
  $supervisoruserId 	= $DataRows['supervisorid'];
  $SN++;
  
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
</head>
<body style="background-color:#eee">
  		
  			<?php require 'sidebar.php'; ?>
	        <!-- Page Content  -->
	  	<div id="content" class="p-4 p-md-5 pt-5">
	  		<?php
                  echo ErrorMessage();
                  echo SuccessMessage();?>
	        <div class="container p-4"  id="storeItems" >
	        	<h4><i> Available Projects </i></h4>
	        	<hr>


	        	<?php 
	        		if(checkstudenttopic($studentuserId)){
	        	?>
	        		<div class="text-center py-3" style="font-style: italic;">
	                  Looks like you already have a project topic...<br>
	                  <i class="fa fa-book pt-3" style="font-size: 35px;"></i>
	                </div>
	        	<?php
	        		}else{
	        			if(!supervisorupload($supervisoruserId)){
	        		

	        	?>
	        		<div class="text-center py-3" style="font-style: italic;">
	                  OOPS!! Projects are not available at the moment...<br>
	                  <i class="fa fa-book pt-3" style="font-size: 35px;"></i>
	                </div>
	        	<?php
	        		}else{
	        		global $ConnectingDB;
                        $sql = "SELECT * FROM studentdetails, approvedprojects WHERE studentdetails.studentId='$studentuserId' AND studentdetails.supervisorid = approvedprojects.supervisorId AND topicstatus = 'available' ";
                        $stmt = $ConnectingDB->query($sql);
                         $SN = 0;
                          while ($DataRows = $stmt->fetch()) {
                            $topicno 	= $DataRows['topicId'];
                            $projectname 	= $DataRows['topic'];
 							$SN++;
	        	?>
	        	<div class="d-flex justify-content-between projlista-cont">
	        		<div><b><span><?= $SN;?>. </span> <?= $projectname;?></b></div>
	        		<div class="">
	        			<a href="projectaction.php?approvedproject=<?= $topicno; ?>&&approvedtopic=<?= $projectname; ?>" class="projlista "> SELECT</a>
	        		</div>
	        	</div>
	        <?php }}}?>
	        
		   	</div>
		</div>

   <!-- JAVASCRIPT -->
	<script type="text/javascript" src="../popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../popper/docs/js/main.js"></script>
    <script src="../js/myscript.js"></script> 
  </body>
</html>