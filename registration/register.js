/*=============== 1 ==============="#username"*/
function CheckUsername(input){
   if ( $(input).val().trim() == "" ){
      $("#username_alert").html( "نام کاربری را وارد کنید." );
      $("#username_check").css("background-image","url('/images/input-cross.png')");
   }else{
       /*var txt = $("#username").val();
        $.post("http://mehrdadweb.ir/registration/register.php",{suggest: txt}, function(result){
            if ( result == 'structure_error' ){
                $("#username_alert").html( "نام کاربری باید فقط شامل تمامی حروف انگلیسی و اعداد باشد." );
                $("#username_check").css("background-image","url('/images/input-cross.png')");
                $('#username_check').attr("data-status","0");                
            }else if ( result == 'username_exists' ){
                $("#username_alert").html( "این نام کاربری موجود میباشد لطفا نام جدیدی وارد کنید." );   
                $("#username_check").css("background-image","url('/images/input-cross.png')");
                $('#username_check').attr("data-status","0");
               }else{
                   $("#username_check").css("background-image","url('/images/input-tick.png')");
                   $("#username_alert").html( "Yes" );
                   $('#username_check').attr("data-status","1");
               }

        });*/
   
     $.ajax({
            url:'http://mehrdadweb.ir/registration/register.php',
            type:'POST',
            success: function (res) {
               if ( res.trim() == 'structure_error' ){
                  $("#username_alert").html( "نام کاربری باید فقط شامل تمامی حروف انگلیسی و اعداد باشد." );
                  $("#username_check").css("background-image","url('/images/input-cross.png')");
                  $('#username_check').attr("data-status","0");
               }else if ( res.trim() == 'username_exists' ){
                  $("#username_alert").html( "این نام کاربری موجود میباشد لطفا نام جدیدی وارد کنید." );   
                  $("#username_check").css("background-image","url('/images/input-cross.png')");
                  $('#username_check').attr("data-status","0");
               }else{
                  $("#username_check").css("background-image","url('/images/input-tick.png')");
                  $("#username_alert").html( "" );
                  $('#username_check').attr("data-status","1");
               }
            },
            error: function (res){
                  alert('error');
            },
            /*async:false,  , checktype : "username" */
            data: { type: "check", username : $(input).val() }            
            
      });
   }
   
}
/*=============== 2 ===============*/
function CheckEmail(input){
   if ( $(input).val().trim() == "" ){
      $("#email_alert").html( "ایمیل خود را وارد کنید." );
      $("#email_check").css("background-image","url('/images/input-cross.png')");
   }else{
       /*var txt1 = $(input).val();
        $.post("http://mehrdadweb.ir/registration/register.php",{suggest: txt1}, function(result){
            if ( result == 'structure_error2' ){
                $("#email_alert").html( "اختار ایمیل شما قابل قبول نیست." );
                $("#email_check").css("background-image","url('/images/input-cross.png')");
                $('#email_check').attr("data-status","0");                
            }else if ( result == 'email_exists' ){
                $("#email_alert").html( "ایمیل وارد شده موجود می باشد" );   
                $("#email_check").css("background-image","url('/images/input-cross.png')");
                $('#email_check').attr("data-status","0");
               }else{
                   $("#email_check").css("background-image","url('/images/input-tick.png')");
                   $("#email_alert").html( "Yes" );
                   $('#email_check').attr("data-status","1");
               }

        });*/            
        $.ajax({
                  url:'http://mehrdadweb.ir/registration/register.php',
                  type:'POST',
                  success: function (res) {

                     if ( res.trim() == 'structure_error2' ){
                        $("#email_alert").html( "ساختار ایمیل شما قابل قبول نیست." );
                        $("#email_check").css("background-image","url('/images/input-cross.png')");
                        $('#email_check').attr("data-status","0");
                     }/*else if ( res.trim() == 'misspell' ){
                        $("#email_alert").html( "Ø§ÛŒÙ…ÛŒÙ„ Ø±Ø§ Ø¨Ø±Ø±Ø³ÛŒ Ú©Ù†ÛŒØ¯ Ù…Ø«Ù„Ø§ Ø¨Ø¬Ø§ÛŒ gmail.com Ø§Ø´ØªØ¨Ø§Ù‡Ø§ gmal.com ÙˆØ§Ø±Ø¯ Ù†Ú©Ø±Ø¯Ù‡ Ø¨Ø§Ø´ÛŒØ¯." );
                        $("#email_check").css("background-image","url('/images/input-cross.png')");
                        $('#email_check').attr("data-status","0");
                     }*/else if ( res.trim() == 'email_exists' ){
                        $("#email_alert").html( "ایمیل وارد شده موجود می باشد." );
                        $("#email_check").css("background-image","url('/images/input-cross.png')");
                        $('#email_check').attr("data-status","0");
                     }else{
                        $("#email_check").css("background-image","url('/images/input-tick.png')");
                        $("#email_alert").html( "" );
                        $('#email_check').attr("data-status","1");
                     }    
                  },
                  error: function (res){
                        alert('error');
                  },
                  /*async:false, , checktype : "email"*/ 
                  data: { type: "check" , email : $(input).val() }            
                  
            });
   }
   
}

/*=============== 4 ===============*/
function CheckPassword(input){
   
   if ( $(input).val().trim() == "" ){
      $("#password_alert").html( "کلمه عبور انتخابی خود را وارد کنید." );
      $("#password_check").css("background-image","url('/images/input-cross.png')");
      $('#password_check').attr("data-status","0");
   }else if ( $(input).val().trim().length < 6 ){
      $("#password_alert").html( "حداقل طول کلمه عبور باید ۶ حرف باشد." );
      $("#password_check").css("background-image","url('/images/input-cross.png')");
      $('#password_check').attr("data-status","0");    
   }else{//وقتی پسورد اوکی باشد
      $("#password_check").css("background-image","url('/images/input-tick.png')");
      $("#password_alert").html("");
      $('#password_check').attr("data-status","1");
   }
   
}
/*=============== 5 ===============*/
function CheckCode(input){
    if ( $(input).val().trim() == "" ){
      $("#code_alert").html( "خواهشا کد امنیتی  را وارد کنید." );
      $("#code_check").css("background-image","url('/images/input-cross.png')");
   }/*else if($(input).val().trim() != $("#captcha").src){
       $("#code_alert").html( "کد امنیتی  را اشتباه وارد کردید." );
       $("#code_check").css("background-image","url('/images/input-cross.png')");
   }*/else{
        $("#code_check").css("background-image","url('/images/input-tick.png')");
        $("#code_alert").html("");
        $('#code_check').attr("data-status","1"); 
   }
}
/*=============== 6 sendemail2.php===============*/
function RegisterMe(){
  //alert('error');
  CheckUsername("#username_input");
  CheckEmail("#email_input");
  CheckPassword("#password_input");

   if ( $('#password_check').attr("data-status") == "1" && $('#username_check').attr("data-status") == "1" && $('#email_check').attr("data-status") == "1"  ){
      $.ajax({
               url:'http://mehrdadweb.ir/registration/register.php',
               type:'POST',
               success: function (res) {
                  $("#header_notice").empty();
                  $("#header_notice").html(res);
               },
               error: function (res){
                     alert('error');
               },
               data: { type: "register" , username : $("#username_input").val().trim() , email : $("#email_input").val().trim() , password : $("#password_input").val().trim() , codee : $("#code_input").val().trim()}            
               
      });
   }
}
/*=============== 7 ===============*/
function RemindMe(){
    //alert('hello');
    CheckPassword('#passwrd');
    CheckCode('#code');
   if (($('#password_check').attr("data-status") == "1") && ($('#code_check').attr("data-status") == "1")){
       $.ajax({
           
               url:'http://mehrdadweb.ir/registration/sendemail.php',
               type:'POST',
               success: function (res) {
                  $("#header_notice").empty();
                  $("#header_notice").html(res);
               },
               error: function (res){
                     alert('error');
               },
               data: { type: "remind" , email : $("#email").val().trim() , passwrd : $("#passwrd").val().trim() , code : $("#code").val().trim() }            
               
      });
   }
}
/*=============== 8 ===============*/
function ResendActivationEmail(){
    $.ajax({
               url:'./resend.php',
               type:'POST',
               success: function (res) {
                 
                  if ( res.trim() == 'done' ){
                     $("#header_notice h2").empty();
                     $("#header_notice h2").html("Ø§ÛŒÙ…ÛŒÙ„ ÙØ¹Ø§Ù„ Ø³Ø§Ø²ÛŒ Ø¨Ø§ Ù…ÙˆÙÙ‚ÛŒØª Ø§Ø±Ø³Ø§Ù„ Ø´Ø¯.");
                  }else{
                     $("#header_notice h2").empty();
                     $("#header_notice h2").html("Ø§ÛŒÙ…ÛŒÙ„ ÙØ¹Ø§Ù„ Ø³Ø§Ø²ÛŒ Ø¨Ø§ Ø®Ø·Ø§ Ù…ÙˆØ§Ø¬Ù‡ Ø´Ø¯.");   
                  }
               },
               error: function (res,err){
                     alert(res);
               },
               data: { type: "resend" , email : $("#email").val().trim() , code : $("#code").val().trim() }            
               
      });
}