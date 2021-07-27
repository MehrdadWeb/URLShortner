<!DOCTYPE html>
<html lang="fa">
<head>
    <!-- ====== 1 ====== -->
    <meta name="author" content="Mehrdad Mohammadi"/>
    <title>Mehrdad Mohammadi</title>
    <!-- ====== 2 ====== -->
    <link rel="stylesheet" href="http://mehrdadweb.ir/css/linkshortner(1-3).css">
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
        $("#button4").click(function(){
            //alert("Goodbye!");
            //$(this).parents(".ex").hide("slow");
            var txt = $("#longlink").val();
            $.post("http://mehrdadweb.ir/shortlink/shortlink1.php",{suggest: txt}, function(result){
                    $("#shortlink2").hide();
                    $("#shortlink4").show();
                    $("#shortlink4").html(result);
            });
        });
        
        /*1*//*$("#login_button").click(function(){
            
            $("#header_login").hide();
            //$("#header_btns_online").css({"background-color": "yellow"});
            //$("#header_btns_online").html("Hello <b>world</b>!");
             var txt = $("#user_emial_login").val().trim();
             //alert($("#user_emial_login").val().trim());
             $.post("http://mehrdadweb.ir/login/dologin.php",{suggest: txt}, function(result){
                
                $("#header_btns_online").html(result);
                $("#header_btns_online").css("color", "red");
              });

        });*/
        /*1==2*/
        /*2 ورود کاربر*/
        $("#login_button").click(function(){
            if($("#user_emial_login").val().trim() == "" ){
                $("#user_emial_login").css("background-color", "red");
                $('#user_emial_login').attr("placeholder","لطفا ایمیل را وارد کنید.");
            }else if($("#pass_login").val().trim() == ""){
                $("#pass_login").css("background-color", "red");
                $('#pass_login').attr("placeholder","لطفا پسورد را وارد کنید.");
            }else if($("#pass_login").val().trim().length < 6){
                $("#pass_login").val('');
                $("#pass_login").css("background-color", "red");
                $("#pass_login").attr("placeholder","حداقل طول کلمه عبور باید ۶ حرف باشد." );
            }else{
                $.ajax({
                    url:'http://mehrdadweb.ir/login/dologin.php',
                    type:'POST',
                    success: function (res){
                        if(res.trim() == ""){
                            alert('!!! wrong password 3 times and your access denied for 1 hour');
                            $("#header_btns_online").empty(res);
                           // $("#login_dropdown_list").hide();
                        }else{
                            //$("#header_login").hide();
                            $("#header_btns_online").html(res);
                            $("#header_btns_online").css("color", "red");
                        }
                        

                    },
                    error: function (res){
                      alert('no no');
                      $("#demo2").html( "bad" );
                    },
                    data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
               
                  });
            }
           
        });
 
        //$(window).load(function(){
                    //alert("hello!");
                       $.ajax({
                       url:'http://mehrdadweb.ir/home.php',
                       type:'POST',
                       success: function (res) {
                            //$("#header_login").hide();
                            $("#header_btns_online").html(res);
                       },
                       error: function (res){
                          alert('no no');
                          $("#demo2").html( "bad" );
                       },
                       //data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
                       
                        });    
                            
        //});

            
         $('[data-toggle="tooltip"]').tooltip(); 
          
        $("#button1").click(function(){
              $("#text3").toggle(500);
        });
          
        $("#switch1").click(function(){
                if($("body").hasClass('firstbg'))
                {
                    $("body").addClass('secondbg').removeClass('firstbg');
                    $("#articlcolor").addClass("addborder");$("#footerborder1").addClass("footerborderclass");$("#footerborder2").addClass("footerborderclass");
                    $("#h3color").css("color", "white");$("#h5color").css("color", "white");$("#articlcolor div div div a span").css("color", "white");
                    $("#navbardrop").css("color", "yellow");$("#shortlink2").css("background-color", "white");
                    $("#linkcolor2").css("color", "yellow");$("#linkcolor3").css("color", "yellow");$("#linkcolor4").css("color", "yellow");
                    $("#linkcolor5").css("color", "yellow");$("#linkcolor6").css("color", "yellow");$("#switch2").css("color", "yellow");
                }
                else{
                    $("body").addClass('firstbg').removeClass('secondbg');
                    $("#h3color").css("color", "black");$("#h5color").css("color", "black");$("#articlcolor div a span").css("color", "black");
                    $("#navbardrop").css("color", "black");$("#shortlink2").css("background-color", "white");
                    $("#linkcolor2").css("color", "black");$("#linkcolor3").css("color", "black");$("#linkcolor4").css("color", "black");
                    $("#linkcolor5").css("color", "black");$("#linkcolor6").css("color", "black");$("#switch2").css("color", "black");
                }
            
        });

        
        
        });
    </script>
</head>
<body class="firstbg">
<div class="newbody">
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
                    <span>ثبت نام کاربر</span>
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
    <!-- ====== headerbg-primary====== -->    
    <header class="header">
        <!-- ====== عکس لوگو ======  -->
        <h1>
            <a class="text-decoration-none" href="http://mehrdadweb.ir">
                <img src="/images/logo.png" class="img1">
            </a>
        </h1>
    </header>
    <!-- ====== end header ====== -->
    <!-- ====== article ======  -->
        <center>
           <?php
            if($_GET['u']){
                $u=$_GET['u'];
            }
        ?> 
        <div>
            <h1 style="color: #dc3545;">
              پسورد شما با موفقیت تغییر یافت <?php echo$u;?> کاربر گرامی
            </h1>
        </div>
        </center>
    <!-- ====== end article ====== -->
    <!-- ====== secondarticle  ====== -->
    <div class="d-flex secondarticle flex-column  justify-content-center align-content-center" dir="rtl" id="articlcolor">
        <!-- ====== 1th secondarticle ====== -->
        <h5 class="text2" id="h5color">با <span><strong>کوتاه کننده لینک</strong> </span>می‌توانید لینک‌های طولانی را به لینک‌های کوتاه و دلخواه تبدیل کنید تا به راحتی و بهترین شکل از طریق پیامک یا در اینستاگرام و ... به اشتراک بگذارید.</h5>
        <!-- ====== 2th secondarticle ====== -->
        <div class="secondarticle1 mt-2" dir="rtl">
            <!-- ====== 1 ====== -->
            <div class="d-flex justify-content-center align-content-center flex-wrap " >
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="امکان کوتاه کردن بی نهایت لینک به رایگان">
                       <img src="/images/icons8-checkmark-26.png" class="icon1" title><span class="icon2" id="articlcolor1">نامحدود و رایگان</span> 
                    </a>
                </div>
                <div class="p-2 ">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="الینک های کوتاهشه محدودیت زمانی ندارد">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2" id="articlcolor2">لینک های دائمی</span> 
                    </a>
                </div>
                <div class="p-2 ">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="پایداری(آپ تایم )بالا و دسترسی سریع">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2" id="articlcolor3">نپایدار و پرسرعت</span> 
                    </a>                    
                </div>
            </div>   
            <!-- ====== 2 ====== -->
            <div class="d-flex justify-content-center align-content-center flex-wrap ">    
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="امکان مشاهده آمار لینک کوتاه شده">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2" id="articlcolor4">نمایش آمار لینک</span> 
                    </a>                      
                </div>
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="سالها فعالیت و مورد اعتماد صدها برند">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2" id="articlcolor5">قدیمی و قابل اعتماد</span>
                    </a>                    
                </div>
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="امکان انتخاب آدرس دلخوته برای لینک کوتاه">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2" id="articlcolor6">لینک کوتاه دلخواه</span>
                    </a>                    
                </div>
            </div>   
            <!-- ====== 3 ====== -->
            <div class="d-flex justify-content-center align-content-center flex-wrap ">
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="کوتاه کردن لینک با یک کلیک بی نیاز به ثبت نام">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2">بی نیاز از ثبت نام</span>
                    </a>                    
                </div>
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="عدم نمایش تبلیغات قبل از باز شدن لینک">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2">عدم نمایش صفحه تبلیغاتی</span>
                    </a>                    
                </div>
                <div class="p-2">
                    <a class="text-decoration-none" href="#" data-toggle="tooltip" data-placement="top" title="پاسخگوی سوالات و شنونده نظرات شما هستیم">
                       <img src="/images/icons8-checkmark-26.png" class="icon1"><span class="icon2">نپشتیبانی پاسخگو</span>
                    </a>                    
                </div>
            </div>            
        </div>
        <!-- ====== 3th secondarticle ====== -->
        <div class="thirdarticle1 mt-2 mx-auto" dir="rtl">
            <button class="box3 mb-5" id="button1">
                ویژگی‌ها و امکانات سایت کوتاه کننده لینک
            </button>
            <div class="text3 mb-5 mx-auto" id="text3" style="display:none;">
                <h4 class="mb-2">امکان کوتاه کردن بی‌نهایت لینک به رایگان</h4>     
                <h4 class="mb-2">لینک‌های کوتاه شده محدودیت زمانی ندارد</h4> 
                <h4 class="mb-2">پایداری (آپ‌تایم) بالا و دسترسی سریع</h4> 
                <h4 class="mb-2">امکان مشاهده آمار بازدید لینک کوتاه شده</h4> 
                <h4 class="mb-2">8سال سابقه فعالیت و مورد اعتماد صد‌ها برند</h4> 
                <h4 class="mb-2">مکان انتخاب آدرس دلخواه برای لینک کوتاه</h4> 
                <h4 class="mb-2">کوتاه کردن لینک با یک کلیک بی‌نیاز به ثبت‌نام</h4> 
                <h4 class="mb-2">عدم نمایش تبلیغات قبل از باز شدن لینک</h4> 
                <h4 class="mb-5">پاسخگوی سوالات و شنونده نظرات شما هستیم</h4>
            </div>
            <button class="box4 mb-5" id="button2">
                <a style="color:black" class="text-decoration-none" href="http://mehrdadweb.ir/" target="_blank" >  مهرداد وب | طراحی حرفه ای سایت و فروشگاه اینترنتی </a>
            </button>
            <button class="box5 mb-5" id="button3" >
                <a style="color:black" class="text-decoration-none" href="https://www.instagram.com/mehrdad.mohammadi7/" target="_blank" >
                ما را در اینستاگرام دنبال کنید
                </a>
            </button>            
        </div>
    </div>
    <!-- ====== end-secondarticle ====== -->
    <!-- ====== footer ====== -->
    <!-- ====== footer1 ====== -->
    <div class="container-fluid  footer1" dir="rtl" id="footerborder1">
        <!-- ====== footer1-1 ====== -->
        <div class="d-flex  justify-content-center align-content-center">
            <div>
                <a class="text-warning c1" href="#">
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
    <!-- ====== footer2 container-fluid====== -->
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

</div> 
<!-- ====== nav ====== --> 
<nav class="sidenav secondcolumn shadow-lg border pt-5" id="secondcolumn">
    <div class="d-flex flex-column" dir="rtl">
                    <!-- ====== flexitem0 ====== -->
                    <div class="border mx-n3 py-3 pl-5 text-center active" style="right: 0; z-index:3;">
                   
                        <div class="d-inline list-unstyled align-self-center text-decoration-none flex_item font-weight-bolder" style="z-index:3;">
                            <li class="nav-item dropdown" style="z-index:3;">
                                <a class="nav-link dropdown-toggle d-inline text-decoration-none flex_item" href="#" id="navbardrop" data-toggle="dropdown" style="z-index:3;" >پروژه ها</a>
                                <ul class="dropdown-menu" style="z-index:3;">
                                    <li>
                                        <a class="dropdown-item" style="color:red;" href="http://mehrdadweb.ir/projects/linkshortner(1-1).html" target="_blank" data-toggle="tooltip" data-placement="top" title="پروژه کوتاه کردن لینک بدون فریم ورک" dir="rtl">
                                            1.پروژه کوتاه کردن لینک
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" style="color:red;" href="http://mehrdadweb.ir/projects/linkshortner(1-2).html" data-toggle="tooltip" data-placement="top" title="پروژه کوتاه کردن لینک با فریم ورک بوت استرپ">
                                            2.پروژه کوتاه کردن لینک
                                        </a>    
                                    </li>
                                    <li>
                                        <a class="dropdown-item" style="color:red;" href="http://mehrdadweb.ir/projects/linkshortner(1-3).html" target="_blank" data-toggle="tooltip" data-placement="top" title="پروژه کوتاه کردن لینک " dir="rtl"> 
                                            3.پروژه کوتاه کردن لینک
                                        </a>
                                    </li>                                    
                                </ul>
                            </li>                             
                        </div>    
                    </div>
                    <!-- ====== flexitem1 ====== -->
                    <div class="border mx-n3 py-3 pl-5 text-center active" style="right: 0;">
                        <span class="d-inline icon ml-2">
                            <img src="/images/home1.png" class="icon" style="width: 20px; height: 30px; margin-bottom: 5PX; padding-bottom: 4px;">
                        </span>                    
                        <a title="کوتاه کننده لینک" class="d-inline align-self-center text-decoration-none flex_item font-weight-bolder" href="http://mehrdadweb.ir/shortlink/linkshortener.html" >
                            <span id="linkcolor2">کوتاه کننده لینک</span>
                        </a>    
                    </div>
                    <!-- ====== flexitem2 ====== --> 
                    <div class="border mx-n3 py-3 pl-5 text-center">
                        <span class="d-inline icon ml-2">
                            <img src="/images/bar-chart.png" class="icon" style="width: 20px; height: 30px; margin-bottom: 5PX; padding-bottom: 4px;">
                        </span>                    
                        <a title="مشاهده آمار لینک کوتاه شده" href="http://mehrdadweb.ir/shortlink/linkshortener.html" class="menu-item d-inline align-self-center text-decoration-none flex_item font-weight-bolder" >
                            <span id="linkcolor3">آمار بازدید لینک</span>
                        </a>
                    </div>
                    <!-- ====== flexitem3 ====== -->
                    <div class="border mx-n3 py-3 pl-5 text-center">
                        <span class="d-inline icon ml-2">
                            <img src="/images/star.png" class="icon" style="width: 20px; height: 30px; margin-bottom: 5PX; padding-bottom: 4px;">
                        </span>                     
                        <a title="آسان کوتاه کن" href="http://mehrdadweb.ir/shortlink/linkshortener.html" class="menu-item d-inline align-self-center text-decoration-none flex_item font-weight-bolder" >
                            <span id="linkcolor4">آسان کوتاه کن</span>
                        </a>
                    </div>
                    <!-- ====== flexitem4 ====== -->
                    <div class="border mx-n3 py-3 pl-5 text-center">
                        <span class="d-inline icon ml-2">
                            <img src="/images/four-squares-button-of-view-options.png" class="icon" style="width: 20px; height: 30px; margin-bottom: 5PX; padding-bottom: 4px;">
                        </span>                     
                        <a title="کیو آر کد بساز" href="http://mehrdadweb.ir/shortlink/linkshortener.html" class="menu-item d-inline align-self-center text-decoration-none flex_item font-weight-bolder" >
                            <span id="linkcolor5">کیو آر کد بساز</span>
                        </a>
                    </div>
                    <!-- ====== flexitem5 ====== -->
                    <div class="border mx-n3 py-3 pl-5 text-center">
                        <span class="d-inline icon ml-2">
                            <img src="/images/email.png" class="icon" style="width: 20px; height: 30px; margin-bottom: 5PX; padding-bottom: 4px;">
                        </span>                      
                        <a title="پشتیبانی و تماس" href="http://mehrdadweb.ir/shortlink/linkshortener.html" class="menu-item d-inline align-self-center text-decoration-none flex_item font-weight-bolder"> 
                            <span id="linkcolor6">پشتیبانی و تماس</span>
                        </a>
                    </div>
                    <!-- ====== flexitem6 ====== </section>-->
                    <div class="border mx-n3 py-3 pl-5 text-center">
                        <div class="custom-control custom-switch c" >
                            <input type="checkbox" class="d-inline custom-control-input c1 rtl" id="switch1" name="example">
                            <label class="d-inline custom-control-label c2" for="switch1" id="switch2">مدرن و روشن</label>
                        </div>
                    </div>
                
    </div>
</nav>
 
</body>
</html>