<?php
$servername = "localhost";
$username = "mehrdadw_root";
$password = "mehrdad";
$dbname = "mehrdadw_linkDB";
$conn = new mysqli($servername, $username,$password,$dbname);
if($conn->connect_error){
        die("!!! Connection failed !!!: " . $conn->connect_error);
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$username=$_POST['username'];
echo "SALAM".$username;
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
    echo "structure_error";
}
?>