<?php
session_start();
require_once "db_connect.php";
require 'fetch.php';

$oldpassword = isset($_POST['old_password']) ? $_POST['old_password'] : "";
$newpassword = isset($_POST['new_password']) ? $_POST['new_password'] : "";


if (password_verify($oldpassword,$stored_password)) {
	$query = "UPDATE customers
        	SET
        	cus_password 	= '$newpassword'
        	WHERE cus_id = '$id'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
      $result = mysqli_error($conn);
  }else {
    $responses = array(
      'message' => 'Password Updated Successfully.',
      'type' => 'success',
      'icon' => 'fa-check-circle',
      'title' => 'Thank you'
    );

  }
}else{
	$responses = array(
      'message' => 'Wrong old password.',
      'type' => 'warning',
      'icon' => 'fa-bell',
      'title' => 'Sorry!'
    );
}
echo json_encode($responses);
?>
