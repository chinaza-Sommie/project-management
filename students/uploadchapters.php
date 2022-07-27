<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  global $ConnectingDB;
  $sql = "SELECT * FROM chapters WHERE studentuserId = '$studentuserId' ";
  $stmt = $ConnectingDB->query($sql);
 
  while ($DataRows = $stmt->fetch()) {
  $progress   = $DataRows['progress'];
  
  }

  if(isset($_GET['approvedchapter'])){
    $approvedchapter = $_GET['approvedchapter'];
  }elseif (isset($_POST['uploaddocument'])) {

    $Target = "../projectDocuments/" . basename($_FILES["chapterfile"]["name"]);
    $chapterFile = $_FILES["chapterfile"]["name"];
    $approvedchapter = $_POST['chapterid'];

    if(empty($chapterFile)){
      $_SESSION["ErrorMessage"] = "Fields cannot be empty ";
    }else{
      $sql = "UPDATE chapters SET chapterdocument = '$chapterFile', chapterstatus = 'awaiting' WHERE studentuserId = '$studentuserId' AND chapterid = '$approvedchapter'";
      $Execute = $ConnectingDB->query($sql);
      if($Execute){
          move_uploaded_file($_FILES["chapterfile"]["tmp_name"], $Target);
          $_SESSION["SuccessMessage"]= "Document uploaded successfully ;)";
          Redirect_to('projectchapters.php');
          
        }else{
          $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
          Redirect_to('projectchapters.php');

        }
    }

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

	        	<form action="uploadchapters.php" method="POST" class="supervisorsInput px-4" enctype="multipart/form-data">
					      <div class="form-group reg-signupform">
                  <label for="name"><i class="fa fa-book"></i></label>
                    <input type="file" name="chapterfile" placeholder="Upload document" autocomplete="off"/>
                </div>
                    <div class="text-right pt-3">
                    	<input type="submit" name="uploaddocument" value="Upload" class="btn p-2 supvisorRegBtn" style="">
                    </div>
                    <input type="hidden" name="chapterid" value="<?=$approvedchapter;?>" placeholder="Upload document" autocomplete="off"/>
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