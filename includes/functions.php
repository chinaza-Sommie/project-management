<?php
// redirects user to a certain page 
	function Redirect_to($New_Location){
		header("Location:" . $New_Location);
		exit;
	}
	
	// checks if email exists before registering user
	function checkEmail($email){
		global $ConnectingDB;
		$sql = "SELECT email FROM registertbl WHERE email =:emaiL ";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':emaiL', $email);
		$stmt->execute();
		$Result = $stmt->rowcount();
		if ($Result == 1) {
			return true;
		} else {
			return false;
		}
	}

		// checks if details are correct before login
	function Login_Attempt($Email)
	{
		global $ConnectingDB;
		$sql = "SELECT * FROM registertbl WHERE email=:emaiL LIMIT 1";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':emaiL', $Email);
		$stmt->execute();
		$Result = $stmt->rowcount();
		if ($Result == 1) {
			return $found_Account = $stmt->fetch();
		} else {
			return null;
		}
	}

	// checks if email exists before registering user
	function checkRegno($regno){
		global $ConnectingDB;
		$sql = "SELECT regno FROM studentdetails WHERE regno =:regnO ";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':regnO', $regno);
		$stmt->execute();
		$Result = $stmt->rowcount();
		if ($Result == 1) {
			return true;
		} else {
			return false;
		}
	}

	function checksupervisee($supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM studentdetails WHERE supervisorid = :superID ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('superID', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	function checkstudent($studentuserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM studentdetails WHERE studentid = :studentID ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('studentID', $studentuserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	function supervisorupload($supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM approvedprojects WHERE supervisorId = :superID AND topicstatus = 'available' ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('superID', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	//  checks for fellow supervisees
	function checksuperviseelist($studentuserId,$supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM studentdetails WHERE studentid != :studentID AND supervisorid = :superiD";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('studentID', $studentuserId);
		$stmt->bindValue('superiD', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	

	// CHECK IF TOPIC ALREADY EXISTS IN THE TABLE
	function checkTopic($topic){
		global $ConnectingDB;
		$sql = "SELECT topic FROM approvedprojects WHERE topic =:topiC ";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':topiC', $topic);
		$stmt->execute();
		$Result = $stmt->rowcount();
		if ($Result == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Display all projects posted by a supervisor
	function displayTopics($supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM approvedprojects WHERE supervisorId = :superID";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('superID', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	// Display all projects posted by a supervisor
	function Ongoingproject($supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM approvedprojects WHERE supervisorId = :superID AND topicstatus = 'ongoing' ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('superID', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	function checkstudenttopic($studentuserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM studentdetails WHERE studentid = :studentID AND projectname != ' ' ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('studentID', $studentuserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	function checkstudentprogressbar($studentuserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM chapters WHERE studentuserId = :studentID ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('studentID', $studentuserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	function checkstudentprogresstatsbar($studentuserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM chapters WHERE studentuserId = :studentID AND chapterstatus = 'ongoing' OR chapterstatus = 'dissaproved'";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('studentID', $studentuserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}

	// function checkstudenttopic($studentuserId){
	// 	global $ConnectingDB;
	// 	$sql = "SELECT * FROM studentdetails WHERE studentid = :studentID AND projectname != ' ' ";
 //   		$stmt = $ConnectingDB->prepare($sql);
	// 	$stmt->bindValue('studentID', $studentuserId);
	// 	$stmt->execute();
	// 	if( ($stmt->rowcount()) >= 1){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

	function checksuperviseeprgrstat($supervisoruserId){
		global $ConnectingDB;
		$sql = "SELECT * FROM studentdetails WHERE supervisorid = :superID AND projectname != ' ' ";
   		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('superID', $supervisoruserId);
		$stmt->execute();
		if( ($stmt->rowcount()) >= 1){
			return true;
		}else{
			return false;
		}
	}
?>