<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  if (isset($_POST['uploadtopic'])) {
    $topic    	= $_POST['topic'];

    if(empty($topic)){
      $_SESSION["ErrorMessage"] = "Field cannot be empty ";
    }elseif(checkTopic($topic)){
      $_SESSION["ErrorMessage"] = "This Project Topic already exists";
    }else{

        global $ConnectingDB; 
        $sql = "INSERT INTO approvedprojects(topic, supervisorId)
        VALUES(:topic,:supervisorID)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('topic',$topic);
        $stmt->bindValue('supervisorID',$supervisoruserId);
        $Execute = $stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]= "Project topic added successfuly.Add more if you wish ;)";
          Redirect_to('supprojectlist.php');
          
        }else{
          $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
          // Redirect_to('registration.php');

        }
    }

  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
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
	        	<h4><i> Add Project Topic... </i></h4>
	        	<hr>

	        	<form action="addtopic.php" method="POST" class="supervisorsInput px-4">
					      <div class="form-group reg-signupform">
                  <label for="name"><i class="fa fa-book"></i></label>
                    <input type="text" name="topic" placeholder="Enter Project Topic" autocomplete="off"/>
                </div>

                    <div class="text-right pt-3">
                    	<input type="submit" name="uploadtopic" value="Upload" class="btn p-2 supvisorRegBtn" style="">
                    </div>
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