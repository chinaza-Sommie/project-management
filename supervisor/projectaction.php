<?php
	require_once("../includes/dbconnection.php");
	require_once("../includes/sessions.php");
	require_once("../includes/functions.php");
	require_once("logincheck.php");



	if(isset($_GET['approvedchapter']) && isset($_GET['studentuserid']) && isset($_GET['chapter'])){
		$approvedchapter = $_GET['approvedchapter'];
		$studentuserid = $_GET['studentuserid'];
		$chapter = $_GET['chapter'];
		
	
        if($chapter == 'Abstract'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '5'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);

			 $sql = "INSERT INTO chapters(studentuserId, chapter, chapterstatus, progress)
	        VALUES(:studentuserId, 'Chapter 1: INTRODUCTION' ,'ongoing', '5')";
	        $stmt = $ConnectingDB->prepare($sql);
	        $stmt->bindValue('studentuserId',$studentuserid);
	      
	        $Executechapter = $stmt->execute();

	        if ($Execute && $Executechapter) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }elseif($chapter == 'Chapter 1: INTRODUCTION'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '20'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);

			 $sql = "INSERT INTO chapters(studentuserId, chapter, chapterstatus, progress)
	        VALUES(:studentuserId, 'Chapter 2: LITERATURE REVIEW' ,'ongoing', '20')";
	        $stmt = $ConnectingDB->prepare($sql);
	        $stmt->bindValue('studentuserId',$studentuserid);
	      
	        $Executechapter = $stmt->execute();

	        if ($Execute && $Executechapter) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }elseif($chapter == 'Chapter 2: LITERATURE REVIEW'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '40'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);

			 $sql = "INSERT INTO chapters(studentuserId, chapter, chapterstatus, progress)
	        VALUES(:studentuserId, 'Chapter 3: SYSTEM ANALYSIS' ,'ongoing', '40')";
	        $stmt = $ConnectingDB->prepare($sql);
	        $stmt->bindValue('studentuserId',$studentuserid);
	      
	        $Executechapter = $stmt->execute();

	        if ($Execute && $Executechapter) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }elseif($chapter == 'Chapter 3: SYSTEM ANALYSIS'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '60'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);

			 $sql = "INSERT INTO chapters(studentuserId, chapter, chapterstatus, progress)
	        VALUES(:studentuserId, 'Chapter 4: SYSTEM IMPLEMENTATION' ,'ongoing', '60')";
	        $stmt = $ConnectingDB->prepare($sql);
	        $stmt->bindValue('studentuserId',$studentuserid);
	      
	        $Executechapter = $stmt->execute();

	        if ($Execute && $Executechapter) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }elseif($chapter == 'Chapter 4: SYSTEM IMPLEMENTATION'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '80'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);

			 $sql = "INSERT INTO chapters(studentuserId, chapter, chapterstatus, progress)
	        VALUES(:studentuserId, 'Chapter 5: CONCLUSION' ,'ongoing', '80')";
	        $stmt = $ConnectingDB->prepare($sql);
	        $stmt->bindValue('studentuserId',$studentuserid);
	      
	        $Executechapter = $stmt->execute();

	        if ($Execute && $Executechapter) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }elseif($chapter == 'Chapter 5: CONCLUSION'){
        	$sql = "UPDATE chapters SET chapterstatus = 'approved', progress = '100'  WHERE chapterid='$approvedchapter'";
			$Execute = $ConnectingDB->query($sql);


	        if ($Execute) {
				$_SESSION["SuccessMessage"] = "Chapter has been approved successfully...";
				Redirect_to("ongoingproject.php");
		
			} else {
				$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
				Redirect_to("chaptersubmit.php");
			}
        }

	
	}
?>