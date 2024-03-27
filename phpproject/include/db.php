<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = "1234"; 
$database = "hms"; 


$conDB = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conDB->connect_error) {
    echo 'not coonnected';
    die("Connection failed: " . $conn->connect_error);
}


?>

