<?php
require 'config.php';
session_start();
if($_GET['username']){
    $userx=$_GET['username'];
    $sql = "SELECT * FROM UserLogsInfo WHERE username='$userx'";
    $result= $conn->query($sql);
    $row=$result->fetch_assoc();
    if($result->num_rows <= 0){
        echo "!!! wrong unsername or email";
        exit();
    //. (email or username) and password is right همه چی اوکی است
    }
    $cookie_name = "userlogged";
    $cookie_value = $row['id'];
    //expiriry time. 86400 = 1 day (86400*30 = 1 month)
    $expiry = time() + (86400 * 30);
    //.Remember me cheked true or flase    
    setcookie($cookie_name, $cookie_value, $expiry, "/");
    header("Location: http://mehrdadweb.ir/");
    echo $row['id']." /".$row['username']."/ ".$row['email'];
    
}else{echo "NO";}
?>
