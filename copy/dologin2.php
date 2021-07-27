<?php 
session_start();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$email_user=test_input($_POST['user_emial_login']);
$pass=$_POST['pass_login'];
$remember=$_POST['RememberCheckbox'];
//1.خالی هستند یا نه ؟  (email or username) and password 
if(empty($email_user)||empty($pass)){
    echo "You must insert a unsername or email or password please !!!";
    exit();
}
//2.ارتباط با دیتابیس
$servername = "localhost";
$username = "mehrdadw_root";
$password = "mehrdad";
$dbname = "mehrdadw_linkDB";
$conn = new mysqli($servername, $username,$password,$dbname);
if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM UserLogsInfo WHERE (username='$email_user' OR email='$email_user')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$nowtime1 = date("h:i:sa");
$nowtime = strtotime($nowtime1);//ساعت کنونی 
$bu=strtotime($row['bu']);// ساعت و زمانی که کاربر تا آن زمان مسدود شده است
$date1 = date("Y/m/d h:i:sa");
$date2 = date("Y/m/d");
$datetimeObj1 = new DateTime($date2);//تاریخ امروز و همین لحظه
$datetimeObj2 = new DateTime($row['datebu']);//تاریخی که کاربر مسدود شده
$logindate = new DateTime($row['logindate']);//آخرین تاریخی که کاربر لاگین کرده

$loginstarttime = strtotime($row['loginstarttime']);
$loginendtime = strtotime($row['loginendtime']);

//گر امروز تمام نشده باشد و ساعت قبل از 24 نیمه شب باشد و کاربر سه بار رمز را اشتباه وارد کرده یا از بازه زمانی خارج شده حق ورود ندارد تا یک ساعت 
if($nowtime < $bu && $datetimeObj1 == $datetimeObj2){
    //return 1;
    echo "loginstarttime : ".$row['loginstarttime']." | loginendtime : ".$row['loginendtime']."<br>";
    echo  "TIME = ".$date1." /BannedUntil= ".$row['datebu']." ".$row['bu']."<br>1.you have entered password 3 times  and you are blocked until 1 hour(".$row['datebu']." ".$row['bu'].")";
    $_SESSION['count'] = 0;
    exit();
}
//.اگر امروز تمام شده باشد بازه زمانی جدیدی تعیین میگردد
if($datetimeObj1 > $logindate){
    $_SESSION['count'] = 0;
    $sql6 ="UPDATE UserLogsInfo
    SET loginstarttime =DATE_ADD(NOW(), INTERVAL 0 minute),loginendtime=DATE_ADD(NOW(), INTERVAL 5 minute),logindate='$date1'
    WHERE (username='$email_user' OR email='$email_user')";
    $result6 = $conn->query($sql6);
    
    $sql8 = "SELECT * FROM UserLogsInfo WHERE (username='$email_user' OR email='$email_user')";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $loginstarttime=strtotime($row8['loginstarttime']);
    $loginendtime=strtotime($row8['loginendtime']);
//.اگر محدوده لاگین به پایان رسیده باشد بازه زمانی جدیدی برای لاگین تعیین میشود    
}elseif($nowtime > $loginendtime){
    $_SESSION['count'] = 0;
    $sql6 ="UPDATE UserLogsInfo
    SET loginstarttime =DATE_ADD(NOW(), INTERVAL 0 minute),loginendtime=DATE_ADD(NOW(), INTERVAL 5 minute),logindate='$date1'
    WHERE (username='$email_user' OR email='$email_user')";
    $result6 = $conn->query($sql6);
    
    $sql8 = "SELECT * FROM UserLogsInfo WHERE (username='$email_user' OR email='$email_user')";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $loginstarttime=strtotime($row8['loginstarttime']);
    $loginendtime=strtotime($row8['loginendtime']);
    //exit();
}
$sql1 = "SELECT * FROM UserLogsInfo WHERE password=$pass";
$result1 = $conn->query($sql1);
//3. password is wrong 
if($result1->num_rows <= 0){
//. چک میکنیم که کاربر 3 بار رمز را اشتباه وارد کرده یا نه    
    if($_SESSION['count'] == 2){
        $_SESSION['count'] = 0;
        //کاربر تا مدت زمان نتواند وارد حساب کاربری خود شود banned from access
        $sql2 = "UPDATE UserLogsInfo SET bu = DATE_ADD(NOW(), INTERVAL 10 minute),datebu ='$date1' WHERE (username='$email_user' OR email='$email_user')";
        $result2 = $conn->query($sql2);
    
        $sql3 = "SELECT * FROM UserLogsInfo WHERE (username='$email_user' OR email='$email_user')";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        echo "loginstarttime : ".$row3['loginstarttime']." | loginendtime : ".$row3['loginendtime']."<br>";
        echo "<br>TIME = ".$date1."<br>!!! wrong password 3 times and you cannot login until ".$row3['datebu']." ".$row3['bu'].".3";
        exit();
            
        }
    $_SESSION['count'] = $_SESSION['count'] + 1;
    $result12 = $conn->query("SELECT * FROM UserLogsInfo WHERE (username='$email_user' OR email='$email_user')");
    $row12 = $result12->fetch_assoc();
    echo "loginstarttime : ".$row12['loginstarttime']." | loginendtime : ".$row12['loginendtime']."<br>";
    echo "d=".$date1." / <br>!!! wrong password ".$_SESSION['count'];
    exit();
        
    }
    $sql4 = "SELECT * FROM UserLogsInfo WHERE password=$pass AND (username='$email_user' OR email='$email_user')"; 
    $result4 = $conn->query($sql4);
    //. email or username is wrong
    if($result4->num_rows <= 0){
        echo "!!! wrong unsername or email";
        exit();
    //. (email or username) and password is right همه چی اوکی است
    }else{
        $_SESSION['count'] = 0;
        $row4 = $result4->fetch_assoc();
            
        $username1=$row4['username'];
        $email1=$row4['email'];
        $pass1=$row4['password'];
        $id1=$row4['id'];
            
        $cookie_name = "userlogged";
        $cookie_value = $row4['id'];
        //expiriry time. 86400 = 1 day (86400*30 = 1 month)
        $expiry = time() + (86400 * 30);
        //.Remember me cheked true or flase    
        if($remember=='RememberMe'){
            setcookie($cookie_name, $cookie_value, $expiry, "/");
            /*echo "cookie_name : ".$cookie_name;
            echo "<br>"."cookie_vlue : ".$cookie_value;*/
                
        }else{
            //if your server requires to set session path             //session_start();
            $_SESSION['userlogged'] = $id;
        }
    //echo "username= ".$username1."  /  email= ".$email1."  /  password= ".$pass1."  /  id= ".$id1."/  remember= ".$_POST['RememberCheckbox'];
    }

?>
<!DOCTYPE html>
<html lang="fa">
<html>
 <head>   
    

        
    <script>
        $(document).ready(function(){
            $("#header_login").hide(); 
            //    <meta charset="UTF-8" />
    //<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    //<meta name="viewport" content="width=device-width, initial-scale=1.0" />
            //<link rel="stylesheet" href="http://mehrdadweb.ir/css/maindologin.css"> <div class="header_btns_online" id="header_btns_online" style="display:block;">    
            $("#id1").click(function(){
                $("#setting_dropdown_style").toggle(500);
                $("#pointy").toggle(500);
            });
            $("#id2").click(function(){
                $("#setting_dropdown_style").toggle(500);
                $("#pointy").toggle(500);
            });

    });  
        </script>
</head>
<body>

 
     		&nbsp;
        <a title="ورود به پنل کاربری جدید" class="user_online_link" href="http://mehrdadweb.ir/user/userpanel.php/<?php echo $username1;?>">
            &nbsp;&nbsp; پنل کاربری &nbsp;&nbsp;</a>  &nbsp; -- &nbsp;
            
    	<a title="اطلاعات کاربر آنلاین" class="user_online_info"> &nbsp;<?php echo $username1;?>&nbsp; | &nbsp;<?php echo $email1;?>&nbsp; | &nbsp;<?php echo $date1;?></a>
    	&nbsp;
    	
    	<img alt="کاربر آنلاین" src="http://mehrdadweb.ir/images/usericonlogin.png" class="online_ico_style" id="id1">
    	<img alt="منوی کاربر" src="http://www.mehrdadweb.ir/images/down-arrow.png" class="online_arrow_ico" id="id2">
    	
    	<form action="http://mehrdadweb.ir/" method="POST" name="frm" id="frm">
        	<div class="pointy" style="position: absolute; top: 33px; display: block;display: none;"></div>
        	
        	<div class="setting_dropdown_style" id="setting_dropdown_style" style="display: block;display: none;">
        	    
                <div onclick="javascript:window.location='http://mehrdadweb.ir/user/userpanel.php/<?php echo $username1;?>'"> 
                    <img alt="منوی تنظیمات و خروج" src="http://www.mehrdadweb.ir/images/setting_ico.png">
                    <span style="position:relative;top:2px;"> پنل کاربری </span>
                </div>
            
                <div class="hr_shape" style="height:1px;"></div>
            
                <div id="signout"  onclick="javascript:window.location='http://mehrdadweb.ir/login/logout.php'">
                    <img alt="خروج" src="http://www.mehrdadweb.ir/images/exit_ico.png" id="signout2">
                    <span id="signout1"> 1خروج </span> 
                    <input type="checkbox" name="SignoutCheck" id="SignoutCheck" value="SignOut!" style="display:none;">
                </div>
        	</div>
    	</form>
         

   
    
</body>
</html>

