<?php

  $studentuserId = $_SESSION['studentuser_ID'];
  global $ConnectingDB;
  $sql = "SELECT * FROM registertbl WHERE id='$studentuserId'";
  $stmtuser = $ConnectingDB->query($sql);
  if ($stmtuser) {
    while ($DataRows = $stmtuser->fetch()) {
      $fullname = $DataRows['fullname'];
      $status = $DataRows['status'];
      $email = $DataRows['email'];
    }
  } else {
    header("location: ../login.php");
  }
?>