<?php
session_start();
require 'db_connect.php';
require 'fetch.php';
if(isset($_POST["image"]))
{
	$imgData = $_POST["image"];


	$image_array_1 = explode(";", $imgData);
	$image_array_2 = explode(",", $image_array_1[1]);



	$imgData = base64_decode($image_array_2[1]);
$imageName = time().'.png';
file_put_contents('../images/profile/'.$imageName, $imgData);

$img_sql = "UPDATE customers set cus_pic='$imageName' where cus_id = '$id' ";
$img_res = $conn->query($img_sql);

echo 'done';
}
 ?>
