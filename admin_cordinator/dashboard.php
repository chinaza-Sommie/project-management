<?php 
  require_once("../includes/dbconnection.php");
  require_once("../includes/sessions.php");
  require_once("../includes/functions.php");

  if (isset($_POST['reg_supervisor'])) {
    $fullname    	= $_POST['fullname'];
    $email     		= $_POST['email'];
    $password       = $_POST['password'];
    $passConfirm	= $_POST['passConfirm'];

    if(empty($fullname) || empty($email) || empty($password) || empty($passConfirm)){
      $_SESSION["ErrorMessage"] = "Fields cannot be empty ";
    }elseif($password !== $passConfirm){
      $_SESSION["ErrorMessage"] = "Passwords do not match. Try again";
    }elseif(checkEmail($email)){
      $_SESSION["ErrorMessage"] = "This email already exists. Go ahead and login";
    }else{
        $password   = password_hash($password, PASSWORD_DEFAULT);

        global $ConnectingDB; 
        $sql = "INSERT INTO registertbl(fullname, email, password, status)
        VALUES(:fullName,:emaiL, :passworD, 'supervisor')";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('fullName',$fullname);
        $stmt->bindValue('emaiL',$email);
        $stmt->bindValue('passworD',$password);
        $Execute = $stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]= "Registration was successful. Please login ;)";
          
        }else{
          $_SESSION["ErrorMessage"]= "A problem occured. Please try again.";
          

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
	        	<h4><i> Register Supervisors </i></h4>
	        	<hr>

	        	<form action="dashboard.php" method="POST" class="supervisorsInput px-4">
					<div class="form-group reg-signupform">
                        <label for="name"><i class="fa fa-user"></i></label>
                        <input type="text" name="fullname" placeholder="Your Fullname" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="email"><i class="fa fa-envelope"></i></label>
                        <input type="email" name="email" placeholder="Your Email" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="password" placeholder="Your Password" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="passConfirm"><i class="fa fa-key"></i></label>
                        <input type="password" name="passConfirm" placeholder="Confirm Password"/>
                    </div>

                    <div class="text-right pt-3">
                    	<input type="submit" name="reg_supervisor" value="Sumbit" class="btn p-2 supvisorRegBtn" style="">
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