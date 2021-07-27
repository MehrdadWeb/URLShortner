<?php
session_start();
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
$username1=$_POST['username'];
//$row = $result->fetch_assoc();
// USERNAME VALIDATION check if name only contains letters and whitespace WHERE (username='$username1') ^([A-Za-z0-9]+)$ 
if($username1){
    if (!preg_match("/^[a-zA-Z0-9']*$/",$username1)) {
        echo "structure_error";
        exit();
    }
    $sql = "SELECT * FROM UserLogsInfo ";
    $result = $conn->query($sql);
    while($row = ($result->fetch_assoc())){
        if($username1 == $row['username']){
            echo "username_exists";
            exit();
        }
    }
}
/*EMAIL VALIDATION */
$email1=$_POST['email'];
if($email1){
    // check if e-mail address is well-formed
    if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
        echo "structure_error2";
        exit();
    }
    $sql1 = "SELECT * FROM UserLogsInfo ";
    $result1 = $conn->query($sql1);
    //$row1 = $result1->fetch_assoc();
    while($row1 = ($result1->fetch_assoc())){
        if($email1 == $row1['email']){
            echo "email_exists";
            exit();
        }
    }
}
/*RegisterMe()*/
$username2=$_POST['username'];
$email2=$_POST['email'];
$password2=$_POST['password'];
$code2=$_POST['codee'];
/*$se=intval($_COOKIE['captcha1']);
$se2=intval($_SESSION['captcha1']);
$se3=$_SESSION['captcha1'];
$se4=$_SESSION["captcha2"];
$se5=$_SESSION["captcha3"];
echo "code:".$code2."<br>";
echo "SESSION:".$se."<br>";
echo "SESSION:".$se2."<br>";
echo "SESSION:".$se3."<br>";
echo "SESSION:".$se4."<br>";
echo "SESSION:".$se5."<br>";*/
//$code1=$_POST['code1'];
if($username2 && $email2 && $password2){
    /*1*/
    /*if($code2 != $_SESSION["captcha"]){
    echo $code2."//"."کد امنیتی وارد شده صحیح نمی باشد."."<br>";
    //exit();
    }else{echo $code2."<br>"."کد امنیتی وارد شده صحیح می باشد.";}*/
    /*2*/
    /*2-1*/
    $date = date("Y/m/d h:i:sa");
    /*2-2*/
    $sql2 = "INSERT INTO UserLogsInfo (username,email,password,logindate,bu)
    VALUES ('$username2', '$email2', '$password2' , '$date','$code2')";

    if ($conn->query($sql2) === TRUE) {
        /*2-3*/
        $sql3 ="UPDATE UserLogsInfo
        SET loginstarttime =DATE_ADD(NOW(), INTERVAL 0 minute),loginendtime=DATE_ADD(NOW(), INTERVAL 60 minute)
        WHERE (username='$username2')";
        $result3 = $conn->query($sql3);
        echo "New record created successfully ".$date;
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    /*3*/
    $to = $email2;
    $subject = "لینک فعالسازی";
    $txt ="درتاریخ$date 
    $username2 سلام کاربر گرامی
    لینک فعالسازی شما با موفقیت ارسال شد.
    روی لینک زیر کلیک کنید
    http://mehrdadweb.ir/registerlink.php/?username=$username2";
    $status = mail($to, $subject, $txt);
if($status)
{
    echo 
        '<p>ایمیل فعال سازی برای شما ارسال شده لطفا بر روی لینک فعال سازی در داخل ایمیل خود کلیک کنید<br>
        رفته باشد spam ممکن است ایمیل فعالسازی شما به پوشه
        </p>'
        ;
    exit();
}else {
    echo '<p>Something went wrong. Please try again!</p>';
    exit();
    }
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <title> به صفحه ثبت نام خوش آمدید </title>
    <link rel="stylesheet" type="text/css" href="http://mehrdadweb.ir/css/mainregister.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="jquery-3.5.1.min.js"></script>
    <script type="application/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.1.js"></script>
    <script language="javascript" type="text/javascript" src="http://mehrdadweb.ir/registration/register.js"></script>
    <!-- ====== 3(bootstrap icons) ====== -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- ====== 4(bootstrap) ====== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- ====== 5(favicon) ====== -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
<script>
$(document).ready(function(){
    
/*$("#register").click(function(){
    alert('no no');
    $("#captcha2").html("http://www.mehrdadweb.ir/captcha1.php?random=' + Math.floor(Math.random()*10000)");
    $("#captcha").src.css({"background-color": "yellow"});
});
                    $.ajax({
                       url:'http://mehrdadweb.ir/home.php',
                       type:'POST',
                       success: function (res) {
                            $("#header_btns_online").html(res);
                       },
                       error: function (res){
                          alert('no no');
                          $("#demo2").html( "bad" );
                       },

                    });
                                        $.ajax({
                       url:'http://www.mehrdadweb.ir/captcha1.php',
                       type:'POST',
                       success: function (res) {
                            $("#header_btns_online").html(res);
                            $("#captcha2").html(res);
                       },
                       error: function (res){
                          alert('no no');
                          $("#demo2").html( "bad" );
                       },

                    });*/
    
    /*$("#code_input").blur(function(){
        //alert("This input field has lost its focus.");
        if ($("#code_input").val().trim() == "" ){
            $("#code_alert").html( "کد امنیتی  را وارد کنیدلطفا." );
            $("#code_check").css("background-image","url('/images/input-cross.png')");
       }else if($("#code_input").val().trim() != $("#captcha").src){
            $("#code_alert").html( $("#captcha").src"کد امنیتی وارد شه صحیح نمی باشد." );
            $("#code_check").css("background-image","url('/images/input-cross.png')");
       }else{
        $("#code_check").css("background-image","url('/images/input-tick.png')");
        $("#code_alert").html("");
        $('#code_check').attr("data-status","1"); 
        }
    });*/
           
});/*$(document).ready(function(){*/
</script>
</head>
<body>
<header>
<!-- ====== header ====== -->    
<header>   
    <!-- ====== عکس لوگو ======  -->
    <h1>
        <a class="text-decoration-none" href="http://mehrdadweb.ir">
            <img src="/images/logo.png" class="img1">
        </a>
    </h1>
</header>
<!-- ====== End-header ====== --> 
<!-- ====== Nav ====== --> 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="http://mehrdadweb.ir/shortlink/shortlinker.html">Mehrdad <i class="fas fa-cut"></i></a> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/biography/biography.html" target="_blank">بیوگرافی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">مهارت ها</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">پروژه ها</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/shortlink/shortlinker.html" target="_blank">پروژه کوتاه کردن لینک</a></li>
                    <li><a class="dropdown-item" href="#">پروژه 2</a></li>
                    <li><a class="dropdown-item" href="#">پروژه 3</a></li>
                </ul>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="http://mehrdadweb.ir">صفحه اصلی</a>
            </li>
        </ul>
     </div> 
</nav>
<!-- ====== End-Nav ====== -->
<!-- ====== MAIN ====== -->
<div class="header_notice mx-auto my-2" id="header_notice"></div>
<div class="header_btns_online mt-2" id="header_btns_online" style="display:block;"></div>
<div class="row my-3" style="direction: rtl;margin-right:15px;margin-left:15px;">
    <!-- ====== col1 ====== -->
    <div class="col-md-5 register_container mb-2">
        <div>
            <!-- نام کاربری -->
            <div class="username my-2">
                <p class="p2">نام کاربری</p>
                <input name="username_input"  id="username_input" type="text" class="register-input1 pr-1"  onblur="CheckUsername(this)" placeholder="نام کاربری">
                <div name="username_check" data-status="0" id="username_check" class="input-check "></div>
            	<span id="username_alert" class="input-problem-alert"></span>  
            </div> 
            <!-- ایمل -->
            <div class="email_input my-2">
                <p class="p2">ایمیل</p>
                <input name="email_input" id="email_input" type="text" class="register-input1 pr-1"   onblur="CheckEmail(this)" placeholder="ایمیل مثال example@gmail.com">               
                <div name="email_check" data-status="0" id="email_check" class="input-check "></div>
            	<span id="email_alert" class="input-problem-alert"></span>                  
            </div>
            <!-- کلمه عبور -->
            <div class="password_input my-2">
                <p class="p2">کلمه عبور</p>
                <input name="password_input" id="password_input" type="text" class="register-input1 pr-1"   onblur="CheckPassword(this)" placeholder="کلمه عبور">              
            	<div name="password_check" id="password_check" data-status="0" class="input-check"></div>
            	<span id="password_alert" class="input-problem-alert"></span>                
            </div>
            <!-- کد امنیتی CheckCode(this)-->
        	<div class="enter_code p-2 mb-2">
            	<h2 class="p2" style="font-size:80%;"> کد امنیتی زیر را وارد کنید: </h2>
            	<center>
            		<div style="width:220px;height:80px;margin-right: 6rem;">
                	    <input type="text" name="code_input" id="code_input" class="cdinput" dir="ltr" onblur="CheckCode(this)">
                        <img name="captcha" id="captcha" src="http://www.mehrdadweb.ir/captcha1.php?random=12000">
                         
                        <img src="http://www.mehrdadweb.ir/images/refresh_blue.ico" title="refresh" style="cursor:pointer" onclick="captcha.src='http://www.mehrdadweb.ir/captcha1.php?random=' + Math.floor(Math.random()*10000);">
                		<div  id="code_check" name="code_check" data-status="0"  class="input-check"></div>
                    	<span id="code_alert" class="input-problem-alert"></span>
                	</div>
            	</center>  
        	</div>           
        	<!-- button -->
        	<div>
        	    <input type="button" onkeydown="if (event.keyCode == 13) document.getElementById('register').click()" id="register" name="register" value="ثبت" class="button mb-3" onclick="RegisterMe()">    		    
        	</div>            
        </div>
    </div>
    <!-- ====== col2 ====== -->
    <div class="col-md-5">
        <div class="two_dv-register-info">
					<table>
						<tbody>
						    <tr>
						        <td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
							    <td><p style="text-align: right;"> ایمیل خود را بدون www وارد کنید.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;"> حداکثر طول نام کاربری ۱۵ حرف می باشد.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">نام کاربری فقط میتواند از بین حروف انگلیسی و اعداد انگلیسی انتخاب شود.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">بعد از انجام موفقیت آمیز ثبت نام ایمیلی حاوی لینک فعال سازی برای شما ارسال می شود. با مراجعه به ایمیل خود و باز کردن لینک مربوطه حساب کاربری خود را فعال کنید.ممکن است ایمیل به قسمت spam یا junk رفته باشد.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">برای اینکه ایمیل فعال سازی مجدد برای شما ارسال شود به 
    							<a href="/registration/resend.php" target="_blank">
    							    اینجا
    							    </a> مراجعه کنید.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">انجام ثبت نام به این منظور است که شما تمامی <a href="/rules.php" style="text-decoration:none;color:blue">قوانین</a> سایت را پذیرفته اید.</p></td>
    						</tr>

					     </tbody>
					</table>
				</div>
    </div>
</div>
<!-- ====== END-MAIN ====== -->
<div style="clear:both"></div>
<!-- ====== footer ====== -->
    <!-- ====== footer1 ====== -->
    <div class="container-fluid mt-5 footer1" dir="rtl" id="footerborder1">
        <!-- ====== footer1-1 ====== -->
        <div class="d-flex  justify-content-center align-content-center">
            <div>
                <a class="text-warning " href="#">
                     گزارش تخلف
                </a>
            </div>
            <div style="color:gray;">&#x2502;</div>
            <div>
                <a class="text-warning" href="#">
                      ساخت UTM
                </a>
            </div>
            <div style="color:gray;">&#x2502;</div>
            <div>
                <a class="text-warning" href="#">
                       شرایط و قوانین
                </a>                
            </div>
        </div>
        <!-- ====== footer1-2 ====== -->
        <div class="row">
            <p class="p1">
            کلیه حقوق محفوظ است ~ 2020 - 2012 &#169;راحی و ارائه شده توسط <a class="text-decoration-none" href="http://mehrdadweb.ir/biography/biography.html" target="_blank">مهندس مهرداد محمدی</a>
            </p>
        </div>
    </div>
    <!-- ====== endfooter1 ====== -->
    <!-- ====== footer2 ====== -->
    <div class=" mt-5 footer2" dir="rtl" id="footerborder2">
        <!-- ====== footer2-1 ====== -->
        <div class="d-flex  justify-content-center align-content-center">
            <div>
                <a class="text-warning c1" href="#">
                    کوتاه کننده لینک
                </a>
            </div>
            <div style="color:gray;">&#x2502;</div>
            <div>
                <a class="text-warning" href="#">
                      آمار لینک
                </a>
            </div>
            <div style="color:gray;">&#x2502;</div>
            <div>
                <a class="text-warning" href="#">
                       قوانین
                </a>                
            </div>
                        <div style="color:gray;">&#x2502;</div>
            <div>
                <a class="text-warning" href="#">
                       پشتیبانی وتماس
                </a>                
            </div>
        </div>    
        <!-- ====== footer2-2 ====== -->
        <div class="row">
            <p class="p1">
            کلیه حقوق محفوظ است ~ 2020 - 2012 &#169;راحی و ارائه شده توسط <a class="text-decoration-none" href="http://mehrdadweb.ir/biography/biography.html" target="_blank">مهندس مهرداد محمدی</a>
            </p>
        </div>    
    </div>     
    <!-- ====== endfooter2 ====== -->
<!-- ====== End-footer ====== -->
</body>
</html>

<?php
/*
$nameErr= $emailErr= $passwordErr= "";
$nameFlag= $emailFlag= $passwordFlag= "F";
$name= $email= $pass= "";
$Err_icon1=$Err_icon2=$Err_icon3=$Err_icon_all=$user_add="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Validate username 1.empty nabashad 2.characte va number bashad 3.dar DB mojood nabashad
    if (empty($_POST["username"])) {
    $nameErr = "نام کاربری ضروری است ،لطفا یک نام کابری مجازی انتخاب کنید.";
    $Err_icon1='<img src="/images/input-cross.png" alt="error" width="10" height="10">';  
    }else{
        $name = test_input($_POST["username"]);
        if (!preg_match("/^[A-Za-z0-9]*$/",$name)) {
        $nameErr = "نام کاربری فقط میتواند از بین حروف انگلیسی و اعداد انگلیسی انتخاب شود."; 
        $Err_icon1='<img src="/images/input-cross.png" alt="error" width="10" height="10">';    
        }else{
            if(preg_match("/^[پ0-9]*$/",$name)){
                $nameErr = "نام کاربری بایدا ترکیبی از بین حروف انگلیسی و اعداد انگلیسی انتخاب شود."; 
                $Err_icon1='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
            }else{
                require 'config.php';
                $sql = "SELECT username FROM UserLogsInfo WHERE username='$name'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                $nameErr= "این نام کاربری قبلا انتخاب شده است.";
                $Err_icon1='<img src="/images/input-cross.png" alt="error" width="10" height="10">';    
                    
                }else{
                    $nameFlag="T";
                    $Err_icon1="";
                }
            $conn->close();
            }
            }
        
    }
            
    //Validate email
    if (empty($_POST["email"])) {
        $emailErr = "ایمیل ضروری است،لطفا ایمیل خود را وراد کنید.";
        $Err_icon2='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
    }else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "فرمت ایمیل مشکل دارد"; 
            $Err_icon2='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
        }else{
            require 'config.php';
            $sql = "SELECT email FROM UserLogsInfo WHERE email='$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $emailErr= "این ایمیل قبلا وارد شده است.";
                $Err_icon2='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
            }else{
                $emailFlag="T";
                $conn->close();}
            
        }
  }
    // Validate password
    if(empty($_POST["password"])){
        $passwordErr = "لطفا کلمه عبور را وارد کنید";
        $Err_icon3='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
    } else{
        $pass = trim($_POST["password"]);
        if(strlen($_POST["password"]) < 6){
            $passwordErr = "پسورد باید حداقل 6 کاراکتر و حرف داشته باشد.";
            $Err_icon3='<img src="/images/input-cross.png" alt="error" width="10" height="10">';
        } else{
            $passwordFlag="T";
              
    }  
} 

if($nameFlag==="T" and $emailFlag==="T" and $passwordFlag=== "T"){      
    if(create_user($name,$email,$pass)=="True"){
        $user_add="کاریر ثبت شد";
        

    }else
    {
      $Err_icon_all="لطفا تمام فیلدها را دقیق پر کنید!;";
    }
    
} 
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}  

function create_user($name,$email,$pass){
            // Insert Data Into MySQL
            require 'config.php';
            $sql = "INSERT INTO UserLogsInfo(username,email,password) VALUES ('$name','$email','$pass')";
            if ($conn->query($sql) === TRUE) {
                return True;
            }else {
                 echo "can't insert into database: " . $sql . "<br>" . $conn->error;
                    return False;                
             }
            $conn->close();  
            
        }

*/
?>