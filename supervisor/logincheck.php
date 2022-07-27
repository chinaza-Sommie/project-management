<?php

  $supervisoruserId = $_SESSION['supervisoruser_ID'];
  global $ConnectingDB;
  $sql = "SELECT * FROM registertbl WHERE id='$supervisoruserId'";
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