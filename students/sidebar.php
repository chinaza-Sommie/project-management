	
	<div class="dash-header mynavbar px-md-5 py-2 d-flex justify-content-between" style="background-color: #000f3c">
			<div class="pl-3">
				<h4 style="color:#eee">Project.<i>io</i></h4>
			</div>

			<div class="dash-list pr-md-5">
				<p style="color:#eee"><i><?php echo $fullname;?></i></p>
			</div>
		</div>
		
		<div class="wrapper d-flex align-items-stretch" >
				<nav id="sidebar" style="background-color:#000f3c">
					<div class="custom-menu">
						<button type="button" id="sidebarCollapse" class="btn btn-primary">
				          <i class="fa fa-bars"></i>
				          <span class="sr-only">Toggle Menu</span>
				        </button>
			        </div>
					<div class="p-4 pt-5">
			  		<!-- <h1><a href="index.html" class="logo">Splash</a></h1> -->
		        <ul class="list-unstyled components mb-5">
		          <li class="active">
		            <a href="studentdashboard.php">Dashboard</a>
		          </li>
		          
		          <li>
	              <a href="projectchapters.php"> Submit Project</a>
		          </li>

		          <li>
		              <a href="#ordermenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Projects List</a>
		              <ul class="collapse list-unstyled" id="ordermenu">
		                <li>
		                    <a href="projectlist.php"> Available Projects</a>
		                </li>
		                 <li>
		                    <a href="superviseelist.php">Fellow Supervisees</a>
		                </li>
		               
		              </ul>
		          </li>
		          
		          <li>
	              <a href="superviseelist.php"> Supervisees' List</a>
		          </li>
		          <li>
	              <a href="../logout.php">Logout</a>
		          </li>
		          <!-- <li>
	              <a href="#">Contact</a>
		          </li> -->
		        </ul>


		        <div class="footer" style="position:absolute;bottom:0;">
		        	<p>
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
					</p>
		        </div>

		      </div>
	    	</nav>
