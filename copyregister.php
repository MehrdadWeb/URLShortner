<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/registration/register.css">
	<script type="text/javascript" async="" src="https://www.google-analytics.com/gtm/js?id=GTM-WLSJMMJ&amp;cid=1940523652.1596548575"></script>
	<script type="text/javascript" async="" src="https://www.google-analytics.com/gtm/js?id=GTM-WLSJMMJ&amp;cid=721636816.1596048461"></script>
	<script async="" src="https://www.google-analytics.com/analytics.js"></script>
	<!--<script language="javascript" type="text/javascript" src="../jquery.js"></script>-->
	<!--<script language="javascript" type="text/javascript" src="../jquery.placeholder.js"></script>-->
	<!--<script language="javascript" type="text/javascript" src="register.js"></script>-->
			
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ثبت نام</title>

	<script>

    </script>
</head>

<body class="body_style">
<?php
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


?>

<header>
    <div><img src="/images/header2.png" class="heaerimg" alt="guitarimage"></div>
    <!--login-->
        <div id="txtHint">
    <div class="header_login">
        <div class="login_container">
            <span id="login_span" class="span-button"> 
            ورود کاربر 
            </span>  
            
            <span class="span-button" style="position:relative;top:1px;"> | </span>
            
            <span class="span-button"> 
            <a href="http://mehrdadweb.ir/registration/register.php" style="text-decoration:none;color:white;">
            ثبـــت نام کاربر
            </a> 
            </span>
            
            <div class="pointy" style="display: block;"></div>
            
            <!--login box ورود کاربر-->
            <div class="login_dropdown_list" style="display: block;">
                
                <form action="http://www.mehrdadweb.ir/login/do_login.php" method="POST" name="frm" id="frm" >
                    <div class="login-text-div"> 
                        <input type="text" id="user_emial_login" name="user_emial_login" placeholder="   نام کاربری یا ایمیل" class="input_login" >
                    </div>
                    
                    <div class="login-text-div">
                        <input type="password" id="pass_login" name="pass_login" placeholder="   کلمه عبور"  class="input_login" >
                    </div>
                    
                    <div class="login-sec-div"> 
                    &nbsp; 
                        <input type="submit" id="login_button" value="(Login)ورود" class="sub_login_btn" >
                        &nbsp; 
                        
             <!--login box ورود کاربر-->           
                        <input id="RememberCheckbox" name="RememberCheckbox" type="checkbox" value="RememberMe!" style="position:relative;top:2px;">  
                        <span> بخاطر بسپار </span>
                    </div>
                        
                    <div class="hr_shape"></div>
                        
                    <div class="forgot-link-div"> 
                        <a style="text-decoration:none;" href="http://mehrdadweb.ir/registration/forget.php">
                        <span tabindex="5"> آیا کلمه عبور را فراموش کردید ؟ </span></a>
                    </div>
                </form>    
                
        </div>
    </div>
            </div>
    </div> 
            <div class="headerslider-text">
                <h1>مهرداد محمدی</h1>
            </div>
    

</header>
<nav>

    <a class="nav-link" href="http://mehrdadweb.ir">صفحه اصلی</a>
    <a class="nav-link" href="/shortlink/shortlinker.html" target="_blank">
        "پروژه ها"
    </a>
    <a class="nav-link" href="/kiana/kiana.html" target="_blank">کیانا</a>
    <a class="nav-link">بنیاد</a>
    <a class="nav-link">دنیا</a>

</nav>


<form name="frminfo" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" autocomplete="on">
    <br>
    <div id="header_notice">
		<h1 class="register_pg_notice">ثبت نام کنید و خاص شوید</h1><br>
	</div>
	<br>
	<div class="register-main-container">
	    
		<div id="formvalidate" class="one_dvinput" style="height:380px" dir="rtl">
				      
	        <h2 style="font-size:100%;color:red" dir="rtl">  </h2>
	        <fieldset>
	            <legend>اطلاعات زیر را وارد کنید</legend>
	        <lable for="username">نام کاربری:</lable><br>  <input type="text" id="username" name="username" value="<?php echo $name;?>"  placeholder="نــــام کاربری"  required autofocus>
	                                    <br>
                                        <span class="error"><?php echo $nameErr.$Err_icon1; ?></span>
            <br><br>
            	
            <lable for="email">ایمل:</lable><br>           <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="ایـمیل ( مثال: example@yahoo.com )" required> 
                                         <br>
                                         <span class="error"><?php echo $emailErr.$Err_icon2;?></span>
            <br><br>
			
	         <lable for="password">کلمه عبور:</lable><br>     <input type="text" id="password" name="password" value="<?php echo $pass;?>" placeholder="کـــــلمه عبـــور" required>  
	                                     <br>
                                         <span class="error"><?php echo $passwordErr.$Err_icon3; ?></span>
            <br>                                         
            <input type="submit" name="submit"  value="ثبت نام">    
            <!--<button type="button" onclick="document.getElementById('formvalidate').innerHTML='<?php echo $name;?>'">ثبت نام ج</button>
            -->
            <br><br>
            <span class="error"><?php echo $Err_icon_all; ?></span>
            <span class="error"><?php echo $user_add; ?></span>
<script>
window.alert("سلام به صفحه ثبت نام خوش آمدید");
</script>
</fieldset>                                         
			<h2 style="font-size:80%;color:#7E587E"> کد امنیتی زیر را وارد کنید: </h2>
					 
			<center>
			    <div style="width:220px;height:60px;">
    				<input type="text" name="code" id="code" class="cdinput" dir="ltr">
    				    <div style="width:20px;height:46px;">
    					    <img name="captcha" src="http://mehrdadweb.ir/captcha/captcha1.php?random=12000">
    						<img src="/images/refresh.png" title="refresh" style="cursor:pointer" onclick="captcha.src='http://mehrdadweb.ir/captcha1.php?random=' + Math.floor(Math.random()*10000);">
					    </div>	
				</div>
			</center>
			
            

		</div>
		<div class="two_dv-register-info">
					<br>
					<table>
						<tbody>
						    <tr>
						        <td><img src="/images/checkmark.png" style="width:30px;height:30px;"</td>
							    <td><p> ایمیل خود را بدون www وارد کنید.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p> حداکثر طول نام کاربری ۱۵ حرف می باشد.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p>نام کاربری فقط میتواند از بین حروف انگلیسی و اعداد انگلیسی انتخاب شود.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p>بعد از انجام موفقیت آمیز ثبت نام ایمیلی حاوی لینک فعال سازی برای شما ارسال می شود. با مراجعه به ایمیل خود و باز کردن لینک مربوطه حساب کاربری خود را فعال کنید.ممکن است ایمیل به قسمت spam یا junk رفته باشد.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p>برای اینکه ایمیل فعال سازی مجدد برای شما ارسال شود به 
    							<a href="/registration/resend.php" target="_blank">
    							    اینجا
    							    </a> مراجعه کنید.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p>انجام ثبت نام به این منظور است که شما تمامی <a href="/rules.php" style="text-decoration:none;color:blue">قوانین</a> سایت را پذیرفته اید.</p></td>
    						</tr>

					     </tbody>
					</table>
										
					
				</div>
			
			<br><br>
			<br><br>
			<br><br>
			<br>
	   </form>

	   <div style="clear:both"></div>

</script>
	<script language="javascript" type="text/javascript" src="../main.js"></script>
</body>
</html>