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
    echo '<p>به ایمیل خود مراجعه کرده و بر روی لینک تغییر پسورد کلیک کنید.</p>';
} else {
    echo '<p>Something went wrong. Please try again!</p>';
}

?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<body>
<center>
<h3 style="color:green;font-size:17px">
   <!--<?php echo $row1;?><br> <?php echo $to; ?><br>
    به ایمیل خود مراجعه کرده و بر روی لینک تغییر پسورد کلیک کنید.
    <a href="http://mehrdadweb.ir/registration/forgetpass.php?u=<?php echo $row1;?>">here</a>
    <br>
    your new password is :<?php echo $passs;?>-->
</h3>
</center>    
</body>    
</html>