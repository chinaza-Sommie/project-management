<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  if(isset($_GET['approvedchapter']) && isset($_GET['studentuserid'])){
      $approvedchapter = $_GET['approvedchapter'];
      $studentuserid = $_GET['studentuserid'];

      // global $ConnectingDB;
      // $sql = "SELECT * FROM studentdetails WHERE supervisorid = '$supervisoruserId' ";
      // $stmt = $ConnectingDB->query($sql);
      // $SN = 0;
      // while ($DataRows = $stmt->fetch()) {
      // $studentid  = $DataRows['studentid'];
      // $SN++;
      
      // }

    
  }elseif(isset($_POST['disapprove'])) {
        $remark   = $_POST['remark'];
        $approvedchapter   = $_POST['approvedid'];
        $studentuserid   = $_POST['studentuserid'];
        echo $remark . $approvedchapter;

        if(empty($remark)){
          $_SESSION["ErrorMessage"] = "Fields cannot be empty ";
        }else{
          $sql = "UPDATE chapters SET supervisorremark = '$remark', chapterstatus = 'disapproved' WHERE chapterid='$approvedchapter' AND studentuserId = '$studentuserid' AND chapterstatus = 'awaiting'";
          $Execute = $ConnectingDB->query($sql);
          if($Execute){
              
              $_SESSION["SuccessMessage"]= "Remark submitted successfully ;)";
              Redirect_to('ongoingproject.php');
              
            }else{
              $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
              Redirect_to('ongoingproject.php');

            }
        }

  }else{
    $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
              Redirect_to('dashboard.php');
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
	        <div class="container p-4"  id="storeItems" style="border: 1px solid grey">
	       
              <h4><i>Upload Form ... </i></h4>
              
            
	        	<hr>

	        	<form action="disapproved.php" method="POST" class="supervisorsInput px-4" >
					      <div class="form-group reg-signupform">
                  <label for="name"><i class="fa fa-book"></i></label>
                    <input type="text" name="remark" placeholder="Your Remark..." autocomplete="off"/>
                </div>
                    <div class="text-right pt-3">
                    	<input type="submit" name="disapprove" value="DISAPPROVE" class="btn p-2 supvisorRegBtn" style="">
                    </div>

                    <input type="hidden" name="approvedid" value="<?= $approvedchapter;?>" class="btn p-2 supvisorRegBtn" style="">
                    <input type="hidden" name="studentuserid" value="<?= $studentuserid;?>" class="btn p-2 supvisorRegBtn" style="">
				    </form>

          
		   	  </div>
		</div>

   <!-- JAVASCRIPT -->
	<script type="text/javascript" src="../popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../popper/docs/js/main.js"></script>
    <script src="../js/myscript.js"></script>
  </body>
</html>