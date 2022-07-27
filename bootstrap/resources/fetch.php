<?php
if (isset($_GET['DiDicmrId'])) {
	$custLogin = $cmr->relogCustomer($_GET['cmrId']);
}
$id = $_SESSION['DiDicmrId'];
$sql = "SELECT * FROM customers where cus_id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
  while($row = $result->fetch_assoc()) {
  $id = $_SESSION['DiDicmrId'];
  $firstname = $row['cus_firstname'];
  $lastname = $row['cus_lastname'];
  $email = $row['cus_email'];
  $phone = $row['cus_tel'];
  $address = $row['address'];
  $adp = $row['cus_pic'];
  $dp = "images/profile/$adp";
  $logged = $row['cus_logged'];
$date = $row['cus_created_at'];
$stored_password=$row['cus_password'];
}}

function trim_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function trimphoneno($data)
{
  $data= explode('-',$data);
  $data=$data[0].''.$data[1].''.$data[2];
  $data= explode('(',$data);
  $data=$data[0].''.$data[1];
  $data= explode(')',$data);
  $data=$data[0].''.$data[1];
  $data= explode(' ',$data);
  $data=$data[0].''.$data[1];
  return $data;
}
$parentDir=explode('/',$_SERVER['REQUEST_URI'])[1];
$actual_link = "http://$_SERVER[HTTP_HOST]/$parentDir/";
 ?>
