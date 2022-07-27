<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Supervisor Dashboard</title>
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
	        <div class="container p-4"  id="storeItems" style="border: 1px solid grey">
	          <div class="d-flex justify-content-between">
              <h4><i>Projects Added</i></h4>
              <a href="addtopic.php" class="plus-sign" style=""> <i class="fa fa-plus"></i></a>
            </div>
	        	<hr>

            <?php 
              if(!displayTopics($supervisoruserId)){
            ?>
              <div class="text-center py-3" style="font-style: italic;">
                Looks like you have not uploaded any topic yet...
              </div>
            <?php
              }else{



                global $ConnectingDB;
                  $sql = "SELECT * FROM approvedprojects WHERE supervisorId = '$supervisoruserId' ";
                  $stmt = $ConnectingDB->query($sql);
                  $SN = 0;
                  while ($DataRows = $stmt->fetch()) {
                  $topic    = $DataRows['topic'];
                  $status   = $DataRows['topicstatus'];
                  $date     = $DataRows['dateuploaded'];
                  $SN++;
            ?>
            <div class="d-flex justify-content-between p-3"style="border-bottom: 1px solid grey">
              <div><b><span><?php echo $SN;?>. </span> <?= $topic;?></b> |<i style="font-size: 14px;"> <?=$status;?></i></div>
              
              <div>
                <?php  $date = strtotime($date);
                                $date = date('d M, Y', $date); 
                                echo $date; ?>
              </div>
            </div>
          <?php }}?>
		   	  </div>
		</div>

   <!-- JAVASCRIPT -->
	<script type="text/javascript" src="../popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../popper/docs/js/main.js"></script>
    <script src="../js/myscript.js"></script>
  </body>
</html>