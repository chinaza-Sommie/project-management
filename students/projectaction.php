<?php
	require_once("../includes/dbconnection.php");
	require_once("../includes/sessions.php");
	require_once("../includes/functions.php");
	require_once("logincheck.php");

	if(isset($_GET['approvedproject'])&&isset($_GET['approvedtopic'])){
		$approvedproject = $_GET['approvedproject'];
		$approvedtopic = $_GET['approvedtopic'];
		$sql = "UPDATE approvedprojects SET topicstatus = 'ongoing' WHERE topicid='$approvedproject'";
		$Execute = $ConnectingDB->query($sql);
		$sqltopic = "UPDATE studentdetails SET projectname = '$approvedtopic' WHERE studentid='$studentuserId'";
		$Executetopic = $ConnectingDB->query($sqltopic);


		 $sql = "INSERT INTO chapters(studentuserId, chapterstatus)
        VALUES(:studentuserId, 'ongoing')";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue('studentuserId',$studentuserId);
      
        $Executechapter = $stmt->execute();

		if ($Execute && $Executetopic && $Executechapter) {

			
				$_SESSION["SuccessMessage"] = "You have selected a project successfuly. Let's get started...";
				Redirect_to("projectchapters.php");
		
		} else {
			$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
			Redirect_to("projectchapters.php");
		}
	}
?>