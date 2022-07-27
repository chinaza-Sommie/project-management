<?php
$servername = "localhost";
$username = "u606614949_quiescent";
$password = "KachisiCho1";
$db_database = "u606614949_didiscuisine";

// Create connection
$conn = new mysqli($servername,$username,$password,$db_database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
