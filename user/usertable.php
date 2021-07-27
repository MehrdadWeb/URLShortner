<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<!--<html lang="en">  English -->
<html lang="fa">
<head>
    <meta name="author" content="Mehrdad Mohammadi" />
    <title>Mehrdad Mohammadi</title>
    <link rel="stylesheet" href="/css/usertable.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="jquery-3.5.1.min.js"></script>
    <script type="application/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.1.js"></script>
    <script language="javascript" type="text/javascript" src="http://mehrdadweb.ir/registration/register.js"></script>
    <script language="javascript" type="text/javascript" src="index.js"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
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
        $("#shortbutton").click(function(){
            var txt = $("#longlink").val();
            $.post("/shortlink/shortlink.php",{suggest: txt},function(result){
                $("#shortlink").html(result);
            });
        });

        /* ورود کاربر*/
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
                    url:'/login/dologin.php',
                    type:'POST',
                    success: function (res){
                        if(res.trim() == ""){
                            alert('!!! wrong password 3 times and your access denied for 1 hour');
                            $("#header_btns_online").empty(res);
                           // $("#login_dropdown_list").hide();
                        }else{
                            $("#header_login").hide();
                            $("#header_btns_online").html(res);
                            $("#header_btns_online").css("color", "red");
                        }
                    },
                    error: function (res){
                      alert('no no');
                      $("#demo2").html( "bad1" );
                    },
                    data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
               
                  });
            }
           
        });
                    $.ajax({
                       url:'/home.php',
                       type:'POST',
                       success: function (res) {
                           if($("#header_btns_online").html(res)){
                              //$("#header_login").hide(); 
                           }
                        //$("#header_login").hide();
                        $("#header_btns_online").html(res);
                       },
                       error: function (res){
                          alert('no no');
                          $("#demo2").html( "bad" );
                       },
                       //data: {type: "check",user_emial_login:$("#user_emial_login").val().trim() , pass_login:$("#pass_login").val().trim() , RememberCheckbox:$("#RememberCheckbox").val().trim()}            
                       
                    });   
        $("#allcheckbox").click(function(){
            //alert('no1');
            $('input:checkbox').not(this).prop('checked', this.checked);    
        });  
        $("input:checkbox:checked,#deletebutton").click(function(){
            alert('deletebutton');
            var txt = $("input:checkbox:checked").val();
            $.post("/db/deletefromdb.php",{suggest: txt},function(result){
                $("#mytable").html(result);
            });
        });
        $("#alldeletebutton").click(function(){
            //alert('no2');
            var txt = $("#alldeletebutton").val();
            $.post("/db/deletefromdb.php",{suggest: txt},function(result){
                $("#mytable").html(result);
            });
        });
    });


    </script>
</head>
<body>
<!-- ====== Header ======  -->
<section id="home" class="header container-fliud"  data-scroll-index="0" style="background-image: url(/images/header4.png); background-position: 0px 0px;margin-bottom:0;" data-stellar-background-ratio="0.8">
    
        <div class="row  pl-sm-5 pt-3 pt-sm-5">
            <!-- ====== first col====== -->
            <div class="col-10 pl-sm-5 ">
                <div id="demo2" style="display:block; color: blue;"></div>
                <div id="txtHint" class="txtHint">
                <!-- ====== نمایش اطلاعات کاربری که ثبت نام کرده و ورودش مجاز است====== -->    
                <div class="header_btns_online" id="header_btns_online" ></div>
                <!-- ====== قسمت ورود اطلاعات کاربری + ثبت نام + فراموشی رمز عبور + یادآوری====== -->
                <div class="header_login" id="header_login">
                <div class="login_container">
                    <span class="span-button" id="login_span" onclick="showhide()">ورود کاربر </span>  
                    <span class="span-button" style="position:relative;top:1px;"> | </span>
                    <span class="span-button"><a href="http://mehrdadweb.ir/registration/register.php" style="color:white;text-decoration: none;">ثبـــت نام کاربر</a></span>
                    
                    <div id="pointy" class="pointy" style="display: block;display: none;"></div>
                    
                    <!-- <form action="http://www.mehrdadweb.ir/login/dologin.php" method="POST" name="frm" id="form0" >login box ورود کاربر                 -->
                    <div id="login_dropdown_list" class="login_dropdown_list" style="display:block;display: none;">
                        <div class="login-text-div"> 
                            <input type="text" id="user_emial_login" name="user_emial_login" placeholder="نام کاربری یا ایمیل" class="input_login" required>
                        </div>
                            
                        <div class="login-text-div">
                            <input type="password" id="pass_login" name="pass_login" placeholder="کلمه عبور"  class="input_login" required>
                        </div>
                            
                        <div class="login-sec-div"> 
                            &nbsp; 
                                
                            <input type="submit" id="login_button" value="login" class="sub_login_btn" >
                            &nbsp; 
                                
                     <!-- </form>login box ورود کاربر-->           
                            <input type="checkbox" id="RememberCheckbox" name="RememberCheckbox" value="RememberMe" style="position:relative;top:2px;">
                            <span> بخاطر بسپار </span>
                        </div>
                                
                        <div class="hr_shape"></div>
                                
                        <div class="forgot-link-div"> 
                            <a style="text-decoration:none;" href="http://mehrdadweb.ir/registration/forget.php">
                            <span tabindex="5"> آیا کلمه عبور را فراموش کردید ؟ </span></a>
                        </div>
                    </div>
                </div>
                </div>
                
                </div> 
            </div>
            <!-- ====== second col ====== -->        
            <div class="col-2  align-top pl-2">
                <div class="clock"><p id="demo">Clock</p></div>
            </div>
        </div>
</section>
<!-- ====== End Header ======  -->
<!-- ====== Navgition ======  -->
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
<!-- ====== End Navgition ======  -->
<!-- ====== main ====== -->
<div class="mainclass">
    <!-- ====== 1-main ====== -->
    <div class="row ">
        <div class="col col1color d-flex flex-column" >
            <!-- ====== 1/1-main ====== -->
            <div class="text1 mt-1" id="showit">
                <pre> کاربر گرامی <span style="color:red;"><?php echo $_GET['id'];?></span></pre>
                <pre> جدول لینک های خود را در زیر مشاهده می کنید: </pre>  
                <input style="display:none" type="text" name="usernamee" id="usernamee" value="<?php echo $_GET['id'];?>">
            </div> 
            <!-- ====== 1/2-main ====== -->
            <div class="ml-2">
                    <table class="table table1 table-bordered table-hover" id="mytable">
                        <thead class="thead-dark">
                            <tr>
                              <th>Delete</th>  
                              <th>ID</th>
                              <th>Usename</th>
                              <th>Link</th>
                              <th>Shortlink</th>
                            </tr>
                        </thead>
                        <tbody class="table-info">
                            <?php
                            $user_name=$_GET['id'];
                            require 'config.php';        
                            $sql = "SELECT * FROM UserLinks WHERE username='$user_name'";
                            $result = $conn->query($sql);
                             if ($result->num_rows > 0){
                            while($row = ($result->fetch_assoc()))
                            {
                               
                              echo "<tr>";
                              echo "<td >".
                                        " 
                                        <input  type='checkbox' value='".$row['id']."' id='".$row['id']."' name='".$row['id']."'>
                                        <label  for='".$row['id']."'><img class='d-inline' src='/images/input-cross.png' alt='error' width='10' height='10'></label>
                                        <button type='button' class='btn btn-primary d-inline' id='deletebutton'>حذف</button>
                                        " 
                                    ."</td>";
                              echo "<td>". $row['id'] . "</td>";
                              echo "<td>" . $row['username'] . "</td>";
                              echo "<td>" . $row['link'] . "</td>";
                              echo "<td>" . $row['shortlink'] . "</td>";
                              echo "<td>" . $row['datetime'] . "</td>";
                              echo "</tr>";
                            }
                           // echo "</table>"; "<input type='checkbox' value='deleted' id='mycheckbox' name='mycheckbox'>" 
                            
                            }
                            $conn->close();
                            ?>
                        </tbody>
                        <tr>
                            <input class="ml-2" type='checkbox' value='alldeleted' id='allcheckbox' name='allcheckbox'>
                            <label for="allcheckbox">Delete All Rows</label> 
                            <button type='button' class=' d-inline mb-1' id='alldeletebutton' value='alldeletebutton'>حذف</button>
                        </tr>
                    </table>
            </div>
            
        </div>
    </div>  
    <!-- ====== 2-main ====== -->
    <div class="row   ml-5">    
        <div id="signout"  onclick="javascript:window.location='http://mehrdadweb.ir/login/logout.php'">
            <img alt="خروج" src="http://www.mehrdadweb.ir/images/exit_ico.png" id="signout2">
            <button id="signout1">خروج از حساب کاربری</button> 
            <input type="checkbox" name="SignoutCheck" id="SignoutCheck" value="SignOut!" style="display:none;">
        </div>
    </div> 
</div>    
<!-- ====== end_main ======  -->
<!-- ====== footer ======  -->
<div class="container-fluid footercl footer text-primary"  data-scroll-index="0" style="background-image: url(/images/footer1.PNG); background-position: 0px 0px;margin-bottom:0;" data-stellar-background-ratio="0.8">
    <div class="row text-center pt-md-2 mt-md-2" >
        <div class="col">Contact us</div>
    </div>
    <div class="row text-center pt-md-3 mt-md-3">
        <div class="col-md-3">
            <div class="item">
                <span class="icon">
				    <i class="fa fa-phone" aria-hidden="true"></i>
				</span>
				<h6>Phone</h6>
				<p>+98 9390182439</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item">
				<span class="icon">
				    <i class="fa fa-envelope" aria-hidden="true"></i>
				</span>
				<h6>Gmail</h6>
				<a class="text-decoration-none" href="#" target="_blank">mehrdadmmg2012@gmail.com</a>
			</div>
        </div>
        <div class="col-md-3">
            <div class="item">
				<span class="icon">
				    <i class="fa fa-location-arrow" aria-hidden="true"></i>
				</span>
				<h6>Telegram</h6>
				<a class="text-decoration-none" href="https://t.me/mohammadi90" target="_blank">@mohammadi90</a>
			</div>
        </div>
        <div class="col-md-3">
            <div class="item">
                <span class="icon">
				    <i class="fab fa-instagram" aria-hidden="true"></i>
				</span>
                <h6>Instagram</h6>
				<a class="text-decoration-none" href="https://www.instagram.com/mehrdad.mohammadi7/" target="_blank">mehrdad.mohammadi7</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ====== endfooter ====== -->
</body>
</html>