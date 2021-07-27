<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <title> بازیابی پسورد فراموش شده </title>
    <link rel="stylesheet" type="text/css" href="http://mehrdadweb.ir/css/mainforget.css">
    <link rel="stylesheet" type="text/css" href="http://mehrdadweb.ir/css/forget.css">
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
        $("#login_span").click(function(){
        $("#login_dropdown_list").toggle(500);
        $("#pointy").toggle(500);
        });
        
        $(window).load(function(){
                    //alert("Goodbye!");
                       $.ajax({
                       url:'http://mehrdadweb.ir/home.php',
                       type:'POST',
                       success: function (res) {
                           if($("#header_btns_online").html(res)){
                              //$("#header_login").hide(); 
                           }
                        //$("#header_login").hide();
                        $("#header_btns_online").html(res);
                        $("#header_btns_online").css("color", "red");
                       },
                       error: function (res){
                          alert('no no');
                          $("#demo2").html( "bad" );
                       },
                       //data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
                       
                          });    
                            
                    });
        
        $("#login_button").click(function(){
            if($("#user_emial_login").val().trim() == "" ){
                $("#user_emial_login").css("background-color", "red");
                $('#user_emial_login').attr("placeholder","لطفا ایمیل را وارد کنید.");
            }else if($("#pass_login").val().trim() == ""){
                $("#pass_login").css("background-color", "red");
                $('#pass_login').attr("placeholder","لطفا پسورد را وارد کنید.");
            }else{
                $.ajax({
                    url:'http://mehrdadweb.ir/login/dologin.php',
                    type:'POST',
                    success: function (res){
                       $("#header_btns_online").html(res);
                       $("#header_btns_online").css("color", "red");
                    },
                    error: function (res){
                      alert('no no');
                      $("#demo2").html( "bad" );
                    },
                    data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
               
                  });
            }
           
        });            
                    
                    
  
});
/////////myTimer()
    var myTimer = setInterval(myClock, 1000);
    function myClock() {
        document.getElementById("democlock").innerHTML = new Date().toLocaleTimeString();
        
    }
    </script>
</head>
<body>
<!-- ====== header ====== -->    
<header>   
    <!-- ====== ثبت نام و ورود ====== -->
    <div class="lginsub_header_btns_online">
        <!-- ====== ثبت نام و ورود1 ======  -->
        <div class="header_btns_online mt-2" id="header_btns_online" style="display:block;"></div>
        <!-- ====== ثبت نام و ورود2 ======  -->
        <div class="logsub" id="header_login">
            <div class="mr-2 mt-2 form-group">
                <div class="loginsec p-2 ">
                    <span id="login_span">ورود کاربر</span>
                    <span>|</span>
                    <span><a class="text-decoration-none" href="http://mehrdadweb.ir/registration/register.php" style="color:black;">ثبت نام کاربر</span>
                    <div class="pointy mt-2" id="pointy" style="display:none;"></div>
                </div>
            </div>    
            <div class="login_dropdown_list mt-2" id="login_dropdown_list" style="display:none;">
                <input class="input_username p-2 my-2" type="text" id="user_emial_login" placeholder="نام کاربری یا ایمل ">
                <input class="input_pass p-2" type="password" id="pass_login" placeholder="رمز عبور">
                
                <button class=" butt1 d-inline mt-3 ml-2" id="login_button">ورود - login</button>
                <span>
                    <input class="rembox d-inline mt-3" type="checkbox" value="RememberMe"  id="RememberCheckbox" name="RememberCheckbox">
                    بخاطر بسپار
                </span>  
                
                <hr class="hr-line mx-auto" style="">
                
                <div class="forgetlink mb-3">
                    <a  style="text-decoration:none;color:black;" href="http://mehrdadweb.ir/registration/forget.php">
                        آیا کلمه عبور خود را فراموش کرده اید؟
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== ثبت نام و ورود end ======  -->
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
<!-- ====== Main ====== -->
<form  action="forget.php" method="POST">
    <div class="my-2" id="header_notice">
        <h2 dir="rtl" class="register_pg_notice" style="width:350px;color:green"> کلمه عبور خودتو فراموش کردی ؟؟؟ </h2><br>
	</div>
	<div class="row" style="direction: rtl;margin-right: 15px;margin-left: 15px;">
	    <!-- ====== col-1 ====== -->
	    <div class="col-md-5">
    	    <!--===================== 1-MAIN =====================-->
    	    <div class="dvinput" style="" dir="rtl">
        		<h2 style="font-size:100%;color:red" dir="rtl"> </h2>
        		<!-- ایمیلی که با آن ثبت نام کردید-->
        		<div class="enter_email p-2 mb-2">
            		<span class="c1"><p class="c2">ایمیلی که با آن ثبت نام کردید</p></span>
            		<input name="email" type="text" class="register-input1 " placeholder="ایمیلی که با آن ثبت نام کردید را وارد کنید." id ="email" onblur="CheckEmail2(this)"> 
            		<div name="email_check" data-status="0" id="email_check" class="input-check "></div>
            		<span id="email_alert" class="input-problem-alert"></span>    
        		</div>
        		<!--کلمه عبور جدید-->
        		<div class="enter_pass p-2 mb-2">
        		    <span class="c1"><p class="c2">کلمه عبور جدید را وارد کنید</p></span>
            		<input name="passwrd" type="password" id="passwrd" title="کلمه عبور جدید را وارد کنید!" onblur="CheckPassword(this)" class="register-input2" placeholder="کـــــلمه عبـــور جدید">
            		<div name="password_check" id="password_check" data-status="0" class="input-check"></div>
            		<span id="password_alert" class="input-problem-alert"></span>
        		</div>
        		<!--کد امنیتی -->	
        		<div class="enter_code p-2 mb-2">
            		<h2 class="c1 c2" style="font-size:80%;"> کد امنیتی زیر را وارد کنید: </h2>
            		<center>
            		    <div style="width:220px;height:80px;">
                		    <input type="text" name="code" id="code" class="cdinput" dir="ltr" onblur="ValidateCode(this)">
                        	<img name="captcha" id="captcha" src="http://www.mehrdadweb.ir/captcha1.php?random=12000">
                        	<img src="http://www.mehrdadweb.ir/images/refresh_blue.ico" title="refresh" style="cursor:pointer" onclick="captcha.src='http://www.mehrdadweb.ir/captcha1.php?random=' + Math.floor(Math.random()*10000);">
                		    <div name="code_check" id="code_check" data-status="0"  class="input-check"></div>
                    		<span id="code_alert" class="input-problem-alert"></span>
                		</div>
            		</center>  
        		</div>
        		<!-- button -->
        		<div>
        		    <input type="button" onkeydown="if (event.keyCode == 13) document.getElementById('register').click()" id="register" name="register" value="ثبت" class="button" onclick="RemindMe()">    		    
        		</div>
            </div>
    	   <!--===================== END 1-MAIN =====================--> 	        
	    </div>
	    <!-- ====== col-2 ====== -->
	    <div class="col-md-5">
    	   <!--===================== 2-MAIN =====================-->
    	    <div class="dv-register-info" style="">
    			<br>
    			<table>
    						<tbody><tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;"> ایمیل خود را بدون www وارد کنید.</p></td>
    						</tr>	
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">در قسمت کلمه عبور جدید , کلمه عبور جدید را که می خواهید برای اکانت شما ثبت شود را وارد کنید.</p></td>
    						</tr>
    						<tr>
    							<td><img src="/images/checkmark.png" style="width:30px;height:30px;"></td>
    							<td><p style="text-align: right;">بعد از فشردن کلید ثبت ایمیلی حاوی لینک تغییر کلمه عبور برای شما ارسال می شود. که با ورود به آن لینک کلمه عبور شما به کلمه عبور انتخابیتان در این فرم تغییر می یابد.</p></td>
    						</tr>
    
    					</tbody></table>
    				</div>
    	   <!--===================== END 2-MAIN =====================-->	        
	    </div>
	</div>
</form>
	<div style="clear:both"></div>
<!-- ====== End-Main ====== -->	
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