<?php 
  require_once("includes/dbconnection.php");
  require_once("includes/sessions.php");
  require_once("includes/functions.php");

  if (isset($_POST['register'])) {
    $fullname    	= $_POST['fullname'];
    $email     		= $_POST['email'];
    $password       = $_POST['password'];
    $passConfirm	= $_POST['passConfirm'];

    if(empty($fullname) || empty($email) || empty($password) || empty($passConfirm)){
      $_SESSION["ErrorMessage"] = "Fields cannot be empty ";
    }elseif($password !== $passConfirm){
      $_SESSION["ErrorMessage"] = "Passwords do not match. Try again";
    }elseif(checkEmail($email)){
      $_SESSION["ErrorMessage"] = "This regno already exists. Go ahead and login";
    }else{
        $password   = password_hash($password, PASSWORD_DEFAULT);

        global $ConnectingDB; 
        $sql = "INSERT INTO registertbl(fullname, email, password, status)
        VALUES(:fullName,:emaiL, :passworD, 'student')";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('fullName',$fullname);
        $stmt->bindValue('emaiL',$email);
        $stmt->bindValue('passworD',$password);
        $Execute = $stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]= "Registration was successful. Please login ;)";
          Redirect_to('Login.php');
          
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
	<title>school projects: REGISTER</title>
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

	<div class="container p-3 reg-main" >
		<div class="row">
			<div class="col-md-6">
				<div style="width: 100%; height: 100%">
					<img src="Images/vrImg.jpg" style="width: 100%; height: 100%">
				</div>
			</div>

			<div class="col-md-6">
				<h2 class="form-title" style="color: #000f3c;">Sign up</h2>

				<?php
                  echo ErrorMessage();
                  echo SuccessMessage();?>

				<form action="register.php" method="POST">
					<div class="form-group reg-signupform">
                        <label for="name"><i class="fa fa-user"></i></label>
                        <input type="text" name="fullname" placeholder="Your Fullname" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="email"><i class="fa fa-key"></i></label>
                        <input type="email" name="email" placeholder="Your Email" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="password" placeholder="Your Password" autocomplete="off"/>
                    </div>

                    <div class="form-group reg-signupform">
                        <label for="passConfirm"><i class="fa fa-key"></i></label>
                        <input type="password" name="passConfirm" placeholder="Your Password"/>
                    </div>

                    <div class="row pt-4">
                    	<div class="col-md-6">
                    		<p>already have an account? <a href="login.php" style="color:#EE4B79;"> Login</a></p>
                    	</div>

                    	<div class="col-md-6 text-right">
                    		<input type="submit" name="register" value="Submit" class="btn btn-primary px-5 py-2">
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