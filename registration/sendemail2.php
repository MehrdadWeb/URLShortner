<?php
// Start the session
session_start();

    $emaill=$_POST['email'];
    $passs=$_POST['passwrd'];
    require 'config.php';
    $sql = "UPDATE UserLogsInfo SET password='$passs' WHERE email='$emaill'";
    $result = $conn->query($sql);
    
    $sql1 = "SELECT username FROM UserLogsInfo";
    $result1 = $conn->query($sql1);
    $row = $result1->fetch_assoc();
    $row1=$row["username"];
    $to = $_POST['email'];
    $subject = "درخواست تغییر پسورد فراموش شده";
    $txt ="سلام کاربر گرامی
            .$row1. 
    کلمه عبور شما با موفقیت تغییر یافت.
    روی لینک زیر کلیک کنید
    http://mehrdadweb.ir/registration/forgetpass.php?u=$row1";
    


    mail($to,$subject,$txt);  
    $status = mail($to, $subject, $txt);

if($status)
{
    echo '<p>ایمیلی حاوی لینک فعال سازی برای شما ارسال شد. با مراجعه به ایمیل خود و باز کردن لینک مربوطه حساب کاربری خود را فعال کنید.ممکن است ایمیل به قسمت spam یا junk رفته باشد.</p>';
} else {
    echo '<p>Something went wrong. Please try again!</p>';
}

?>