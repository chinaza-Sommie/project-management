<?php
session_start();
require_once "db_connect.php";
require 'fetch.php';

$newfirstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
$newlastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
$newemail = isset($_POST['email']) ? $_POST['email'] : "";
$newphone = isset($_POST['phone']) ? $_POST['phone'] : "";
$newaddress = isset($_POST['address']) ? $_POST['address'] : "";

/* Email Validation */
	if(!isset($message)) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$responses = array(
    'message' => 'Invalid Email, Please put a valid E-mail address',
    'type' => 'warning',
    'icon' => 'fa-bell',
    'title' => 'Sorry'
  );
	$message = "danger";
	}
	}
	if($newemail!==$email) {
	if(!isset($message)) {
    $query = $conn->query("SELECT DISTINCT * FROM `customers` WHERE cus_email = '" . $newemail . "'");
    $count = $query->num_rows;
    if($count!=0) {
		$message = "User Email is already in use.";
		$responses = array(
		'message' => 'User Email is already in use.',
		'type' => 'warning',
		'icon' => 'fa-bell',
		'title' => 'Sorry'
  );
		}
	}}
	if($newphone!==$phone) {
	if(!isset($message)) {
    $query = $conn->query("SELECT DISTINCT * FROM `customers` WHERE cus_tel = '" . $newphone . "'");
    $count = $query->num_rows;
    if($count!=0) {
		$message = "phone number is already in use.";
		$responses = array(
		'message' => 'Phone number is already in use.',
		'type' => 'warning',
		'icon' => 'fa-bell',
		'title' => 'Sorry'
  );
		}
	}}

 if(!isset($message)) {
	$query = "UPDATE customers
        	SET
        	cus_firstname 	= '$newfirstname',
        	cus_lastname = '$newlastname',
        	cus_email 	= '$newemail',
        	cus_tel = '$newphone',
        	address 	= '$newaddress'
        	WHERE cus_id = '$id'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
      $result = mysqli_error($conn);
  }else {
    $responses = array(
      'message' => 'Profile updated successfully.',
      'type' => 'success',
      'icon' => 'fa-check-circle',
      'title' => 'Thank you'
    );

  }
}
echo json_encode($responses);
?>
