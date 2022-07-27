<?php
 require_once("includes/dbconnection.php");
  require_once("includes/sessions.php");
  require_once("includes/functions.php");

	if (isset($_POST['login'])) {

	    $email = $_POST['email'];
	    $password = $_POST['password'];

	    $found_Account = Login_Attempt($email);

	    if (empty($email) || empty($password)) {
	      
	      $_SESSION["ErrorMessage"] = "fields cannot be empty";

	    } elseif((!$found_Account) && (!password_verify($password, $found_Account["pass"]))) {
	        $_SESSION["ErrorMessage"] = "incorrect email/password";
	     
	    }else{
	      $_SESSION['status'] = $found_Account["status"];
	      
	      if($found_Account["status"] == 'student'){
	      	$_SESSION['studentuser_ID'] = $found_Account["id"];
	      	$_SESSION['username'] = $found_Account["fullname"];
	      	$_SESSION["SuccessMessage"] = "Welcome to your dashboard ".$_SESSION['username'];
	      	Redirect_to('students/studentdashboard.php');
	      }elseif($found_Account["status"] == 'supervisor'){
	      	$_SESSION['supervisoruser_ID'] = $found_Account["id"];
	      	$_SESSION['username'] = $found_Account["fullname"];
	      	$_SESSION["SuccessMessage"] = "Welcome to your dashboard ".$_SESSION['username'];
	      	Redirect_to('supervisor/dashboard.php');
	      }else{
	      	$_SESSION['user_ID'] = $found_Account["id"];
	      	$_SESSION['username'] = $found_Account["fullname"];
	      	$_SESSION["SuccessMessage"] = "Welcome to your dashboard ".$_SESSION['username'];
	      	Redirect_to('admin_cordinator/dashboard.php');
	      }
	    }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>school projects: LOGIN</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-color:#f4f4f4">

	<div class="container p-3 reg-main" style="position: relative;">
		<div class="row">
			<div class="col-md-6">
				<div style="width: 100%; height: 100%">
					<img src="Images/vrImg.jpg" style="width: 100%; height: 100%">
				</div>
			</div>

			<div class="col-md-6">
				<h2 class="form-title" style="color: #000f3c;">Login</h2>

				<?php
                  echo ErrorMessage();
                  echo SuccessMessage();?>

				<form action="login.php" method="POST" class="pt-3">
					
                    <div class="form-group reg-signupform">
                        <label for="email"><i class="fa fa-key"></i></label>
                        <input type="email" name="email" placeholder="Your Email" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="password" placeholder="Your Password" autocomplete="off"/>
                    </div>

                    <div class="row px-4 fixed-bottom" style="position: absolute;">
                    	<div class="col-md-6">
                    		<p>Don't have an account? <a href="register.php" style="color:#EE4B79;"> Register</a></p>
                    	</div>

                    	<div class="col-md-6 text-right pl-3">
                    		<input type="submit" name="login" value="Login" class="btn btn-primary px-5 py-2">
                    	</div>
                    </div>
				</form>
			</div>
		</div>
	</div>

	
	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="popper/docs/js/main.js"></script>
	<script src="js/js-file.js"></script>
</body>
</html>