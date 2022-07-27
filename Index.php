<!DOCTYPE html>
<html>
<head>
	<title>Project Management App</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-light indexnav">
	    <a href="#" class="navbar-brand ml-4" style="color:#EE4B79; font-weight: bold; font-style: italic;">
	    	Project.io
		</a>

	    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
	        <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarCollapse">
	    	<div class="ml-auto d-flex mr-5" style=" font-weight: bold; font-style: italic;">
		        <div class="navbar-nav homenavlink">
		            <a href="index.php" class="nav-item nav-link text-light" >Home</a>
		            <a href="index.php" class="nav-item nav-link text-light">About Us</a>
		       
		        </div>
		        <div class="navbar-nav">
		            <a href="login.php" class="nav-item nav-link text-light">Login</a>
		            <a href="register.php" class="nav-item nav-link text-light">Register</a>
		        </div>
	    	</div>
	    </div>
	</nav>

	<div class="container d-flex align-items-center hero-cont" style="height: 580px;">
		<div class="row d-flex justify-content-center align-items-center">
			<div class="col-md-6 text-center home-text">
			
				<h1 class="pb-2" > School Project Management Information System</h1>
				<p class="pt-2" > This system helps to manage final year projects in the department of computer science thereby aiding to keep tabs on the projects done by students and their progress.</p>

				<div class=" row pt-3">
					<div class="col-md-6 reg-logBtn">
						<div class="py-2" ><a href="register.php" style="width: 100%;"> REGISTER </a></div>
					</div>

					<div class="col-md-6 reg-logBtn">
						<div class="py-2"><a href="login.php"> LOGIN </a></div>
					</div>
				</div>
			</div>

			<div class="col-md-6 d-flex justify-content-center animated zoomIn">
				<img src="Images/hero-img.png.webp" style=" height:100%; width: 100%">
			</div>
		</div>
		
	</div>

	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="../popper/docs/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../popper/docs/js/main.js"></script>
	<script src="js/js-file.js"></script>
</body>
</html>