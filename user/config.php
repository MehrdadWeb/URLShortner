<!DOCTYPE html>
<html>
<head>

</head>
<body>
    
<?php
$servername = "localhost";
$username = "mehrdadw_root";
$password = "mehrdad";
$dbname = "mehrdadw_linkDB";

// Create connection
$conn = new mysqli($servername, $username,$password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>