<?php
/*1==============================================================================*/
if(isset($_COOKIE['userlogged']) && $_COOKIE['userlogged'] != ''){
    $user=intval($_COOKIE['userlogged']);
    //echo "<br>"."1.cookie_vlue : ".$_COOKIE['userlogged']."<br>";
     //get user data from mysql
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
    
    $sql = "SELECT * FROM UserLogsInfo WHERE id=$user";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $username1=$row['username'];
    $email1=$row['email'];
    
}else if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] !=''){
    $user=intval($user);
    echo "2.cookie is not set"."<br>";
     //get user data from mysql
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
    
    $sql = "SELECT * FROM UserLogsInfo WHERE id=$user";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $username1=$row['username'];
    $email1=$row['email'];
    
}
/*2==============================================================================*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/*3==============================================================================*/
$longlink=$_POST['suggest'];
/*echo "سیلام";
$longlink=$_POST['longlink'];
$usernamee=$_POST['usernamee'];*/
if (empty($longlink)) {
    echo "insert something!";
    exit();
}else {
    $website = test_input($longlink);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        echo "Invalid URL !!!";
       // exit();
    }else{
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $resultmix = '';
        for ($i = 0; $i < 5; $i++){
            $resultmix .= $characters[mt_rand(0, 61)];
        }
        $baseurl = "mehrdadweb.ir/";
        $shortl=$baseurl;
        $shortl.=$resultmix;                        /*ایجاد لینک کوتاه*/
        echo $shortl;
        require 'config.php';
        $sql = "INSERT INTO LINKSTABLE(link, shortlink) VALUES ('$longlink','$shortl')"; /*افزودن لینک بلند و لینک کوتاه به ذیتابیس*/
        if ($conn->query($sql) === TRUE) {}
        else {echo "Error: " . $sql . "<br>" . $conn->error;}
        /*13991222*/
        $sql_user_insert="INSERT INTO UserLinks(username, link, shortlink) VALUES ('$username1','$longlink','$shortl')";  
        if ($conn->query($sql_user_insert) === TRUE) {}
        else {echo "Error: " . $sql_user_insert . "<br>" . $conn->error;}
        /**/
        $conn->close();    
        }    
}
/*4==============================================================================*/
/*if($usernamee){
    $hello="Welcome Dear user  : ";
    $user_name=$_GET['id'];
    $sql_user_insert="INSERT INTO UserLinks(username, link, shortlink) VALUES ('$user_name','$longlink','$shortl')";  
    if ($conn->query($sql_user_insert) === TRUE) {}
    else {
        echo "Error: " . $sql_user_insert . "<br>" . $conn->error;}
    $conn->close();  
}    
?>*/