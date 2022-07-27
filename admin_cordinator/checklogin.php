<?php

	$userId = $_SESSION['user_ID'];
	global $ConnectingDB;
	$sql = "SELECT * FROM registertbl WHERE id='$userId'";
	$stmtuser = $ConnectingDB->query($sql);
	if ($stmtuser) {
		while ($DataRows = $stmtuser->fetch()) {
			$bankname = $DataRows['fullname'];
			$bankbranch = $DataRows['status'];
			$email = $DataRows['email'];
		}
	} else {
		header("location: ../login.php");
	}
?>