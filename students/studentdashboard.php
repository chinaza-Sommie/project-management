<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");
  require_once("logincheck.php");

  if (isset($_POST['updateProfile'])) {
    $superId    	= $_POST['superID'];
    $regno     		= $_POST['regno'];
    $projectname  = ' ';
    $regnoL = strlen($regno);

    if(empty($regno) || $superId == 'choose category'){
      $_SESSION["ErrorMessage"] = "Fields cannot be empty ";
    }elseif($regnoL > 11 || $regnoL < 11){
      $_SESSION["ErrorMessage"] = "Your regno in incorrect. Check and try again ";
    }elseif(checkRegno($regno)){
      $_SESSION["ErrorMessage"] = "This regno already exists";
    }else{

        global $ConnectingDB; 
        $sql = "INSERT INTO studentdetails(studentid, regno, supervisorid, projectname)
        VALUES(:studentiD,:regnO, :supervisoriD, :projectnamE)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('studentiD',$studentuserId);
        $stmt->bindValue('regnO',$regno);
        $stmt->bindValue('supervisoriD',$superId);
        $stmt->bindValue('projectnamE',$projectname);
        $Execute = $stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]= "Profile has updated successfuly. Please login ;)";
          
        }else{
          $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
          

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
	          <div >
              <h4><i>Dashboard... </i></h4>
             
            </div>
	        	<hr>

            <?php 

                if(checkstudent($studentuserId)){
                 
            ?>
                <div class="text-center py-3" style="font-style: italic;">
                  Welcome, Let's get you started on your project<br>
                  <i class="fa fa-book pt-3" style="font-size: 35px;"></i>
                </div>
            <?php

                }else{

            ?>


	        	<form action="studentdashboard.php" method="POST" class="supervisorsInput px-4">
					      <div class="form-group reg-signupform">
                  <label for="name"><i class="fa fa-user"></i></label>
                    <input type="text" name="regno" placeholder="Your RegNo" autocomplete="off"/>
                </div>

                    <div class="form-group reg-signupform" style="background-color: inherit;">
                      <select class="form-control mt-4" name="superID" required="">
                        <option>choose category </option>
                        <?php
                        global $ConnectingDB;
                        $sql = "SELECT * FROM registertbl WHERE status='supervisor'";
                        $stmtgigs = $ConnectingDB->query($sql);
                        while ($DataRows = $stmtgigs->fetch()) {
                          $Id            = $DataRows['id'];
                          $fullname     = $DataRows['fullname'];
                        ?>
                          <option value="<?php echo $Id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="text-right pt-3">
                    	<input type="submit" name="updateProfile" value="Sumbit" class="btn p-2 supvisorRegBtn" style="">
                    </div>
				    </form>

          <?php }?>
		   	  </div>
		</div>

   <!-- JAVASCRIPT -->
	<script type="text/javascript" src="../popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../popper/docs/js/main.js"></script>
    <script src="../js/myscript.js"></script>
  </body>
</html>