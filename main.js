function address_upload_reset(){
    $("#upload_addresses_button").removeAttr("disabled"),window.location.reload()
    
}
function setProgress(a){
    var b=a*$(".progressbar_container").width()/100;
    $(".progressbar").width(b).html(a+"% ")
    
}
function keysubmit(a){return 13!=a.keyCode||void document.getElementById("frm").submit()}function submit_query(){return $("#submitbtn").triger("click"),!1}function getInternetExplorerVersion(){var a=-1;if("Microsoft Internet Explorer"==navigator.appName){var b=navigator.userAgent,c=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=c.exec(b)&&(a=parseFloat(RegExp.$1))}return a}function startUpload(){$.each($("#incoming")[0].files,function(a,b){addUploadSlot(prog_counter,b.name,b.size),form[prog_counter-1]={name:"",size:"",isfinished:0,iserror:0,isuploading:0,file:new FormData},form[prog_counter-1].name=b.name,form[prog_counter-1].size=b.size,form[prog_counter-1].file.append("incoming",b),form[prog_counter-1].file.append("CurrentPath",$("#CurrentPath").val()),prog_counter++})}function Uploader(){for(k=0;k<form.length;k++){var a=k+1;1!=form[k].isfinished&&0==$("td[data-isuploading='1']").length&&$.ajax({url:"/cgi-bin/up_upload.cgi",type:"POST",success:function(b){var c=a;"FileSizeLimit"==b||"ImageSizeLimit"==b?setUploadSlotStatus(c,"محدودیت حجمی",0):"PanelSizeLimit"==b?setUploadSlotStatus(c,"محدودیت حجم پنل",0):"OK"==b&&($("#status_"+c).attr("data-isuploading","1"),form[c-1].isuploading=1,setUploadSlotStatus(c,"درحال آپلود...",1),file_slots[c]=$.ajax({url:"/cgi-bin/up_upload.cgi",type:"POST",success:function(a){$("#status_"+c).attr("data-isfinished","1"),$("#status_"+c).attr("data-isuploading","0"),form[c-1].isfinished=1,form[c-1].isuploading=0,$(".link_to_us_note").show(),setInterval(function(){$(".link_to_us_note").animate({opacity:0},200,"linear",function(){$(this).animate({opacity:1},200)})},800),setUploadSlotStatus(c,"آپلود شده",1),setUploadSlotInfo(c,a.split(" ")[0],a.split(" ")[1],a.split(" ")[2],a.split(" ")[3]),$("#size_speed_"+c).html("--"),Uploader()},error:function(a){$("#status_"+c).attr("data-isfinished","1"),$("#status_"+c).attr("data-isuploading","0"),$("#status_"+c).attr("data-iserror","1"),form[c-1].isfinished=1,form[c-1].isuploading=0,form[c-1].iserror=1,setUploadSlotStatus(c,"خطا در ارتباط",0),Uploader()},xhr:function(){var a=$.ajaxSettings.xhr();return a.upload&&(a.upload.progid=c,a.upload.addEventListener("progress",progress,!1)),a},data:form[c-1].file,cache:!1,contentType:!1,processData:!1}))},async:!1,data:{sc:form[a-1].size,n:form[a-1].name}})}}function addUploadSlot(a,b,c){$(".upload_slots_container table").append('<tr> <td> <div id="slot_filename_div_'+a+'" class="slot_filename_div">'+b+"</div> </td>  <td> "+NormalizeSize(c,"fa")+'</td> <td> <div  class="progress_container"><div class="progress_percentage" id="progress_'+a+'"></div><span id="progress_percent_'+a+'" class="progress_percent_style"></span></div></div> <td id="size_speed_'+a+'" style="direction:ltr;text-align:center"> </td> </td> <td class="status" data-isfinished="0" data-isuploading="0" data-iserror="0" id="status_'+a+'">در صف آپلود...</td> <td title="لغو آپلود" style="text-align: center;cursor:pointer" onclick="cancelUploadSlot('+a+')"><div class="stop_upload_div"> X </div></td> </tr>')}function cancelUploadSlot(a){file_slots[a]&&"1"==$("#status_"+a).attr("data-isuploading")&&file_slots[a].abort();var b=$("#progress_"+a).parent().parent().parent().next().html();b.indexOf("textarea")!=-1&&b.indexOf("tabs_body_div")!=-1&&$("#progress_"+a).parent().parent().parent().next().remove(),$("#progress_"+a).parent().parent().parent().remove()}function setUploadSlotStatus(a,b,c){$("#status_"+a).html(b),0==c?$("#status_"+a).css("color","red"):$("#status_"+a).css("color","green")}function setUploadSlotInfo(a,b,c,d,e){var f,g;"image"==e?(f='<img alt="http://www.uplooder.net" src="'+c+'"/>',g="[IMG]"+c+"[/IMG]",$("#progress_"+a).parent().parent().parent().after('<tr> <td colspan=6><div class="file_dl_info" id="file_dl_info_'+a+'">    <div class="tabs_div">  <span class="tab_span" style="background-color:silver" id="span_file_'+a+'_info_2" onclick="change_info(\'file_'+a+"_info_2','file_dl_info_"+a+'\')" > لینک مستقیم عکس </span>                <span class="tab_span" id="span_file_'+a+'_info_3" style="width: 200px;" onclick="change_info(\'file_'+a+"_info_3','file_dl_info_"+a+'\')">تگ html برای سایت یا وبلاگ</span>                <span class="tab_span" id="span_file_'+a+'_info_4" onclick="change_info(\'file_'+a+"_info_4','file_dl_info_"+a+'\')">تگ برای انجمن ها</span>            </div>   <div class="tabs_body_div"  id="file_'+a+'_info_2" name="file_'+a+'_info_2">                <textarea onclick="this.focus();this.select()" id="textarea_'+a+'_info_1" class="textarea_style" readonly="1">'+c+'</textarea>     <button id="copy-button-'+a+'-1" data-clipboard-target="textarea_'+a+'_info_1" onclick="return false;" class="copy-button">کپی کن</button>       </div>              <div class="tabs_body_div" style="display:none" id="file_'+a+'_info_3" name="file_'+a+'_info_3">                <textarea onclick="this.focus();this.select()" id="textarea_'+a+'_info_2" class="textarea_style" readonly="1">'+f+'</textarea>      <button id="copy-button-'+a+'-2" data-clipboard-target="textarea_'+a+'_info_2" onclick="return false;" class="copy-button">کپی کن</button>      </div>              <div class="tabs_body_div" style="display:none" id="file_'+a+'_info_4" name="file_'+a+'_info_4">                <textarea onclick="this.focus();this.select()" id="textarea_'+a+'_info_3" class="textarea_style" readonly="1">'+g+'</textarea>       <button id="copy-button-'+a+'-3" data-clipboard-target="textarea_'+a+'_info_3" onclick="return false;" class="copy-button">کپی کن</button>     </div>          </div></td></tr>'),client.clip($("#copy-button-"+a+"-1")),client.clip($("#copy-button-"+a+"-2")),client.clip($("#copy-button-"+a+"-3")),$("#slot_filename_div_"+a).html("<a href='"+c+"' target='_blank'>"+d+"</a>"),$("#span_file_"+a+"_info_2").css("border-top","3px #4CC417 solid"),$("#span_file_"+a+"_info_2").css("border-bottom-width","1px")):(f='<a href="'+c+'" target="_blank">'+d+"</a>",g="[URL="+c+"]"+d+"[/URL]",$("#progress_"+a).parent().parent().parent().after('<tr> <td colspan=6><div class="file_dl_info" id="file_dl_info_'+a+'">    <div class="tabs_div">                <span class="tab_span" id="span_file_'+a+'_info_1" onclick="change_info(\'file_'+a+"_info_1','file_dl_info_"+a+'\')" > لینک کوتاه </span>                <span class="tab_span" style="background-color:silver" id="span_file_'+a+'_info_2" onclick="change_info(\'file_'+a+"_info_2','file_dl_info_"+a+'\')" > لینک دانلود </span>                <span class="tab_span" id="span_file_'+a+'_info_3" style="width: 200px;" onclick="change_info(\'file_'+a+"_info_3','file_dl_info_"+a+'\')">تگ html برای سایت یا وبلاگ</span>                <span class="tab_span" id="span_file_'+a+'_info_4" onclick="change_info(\'file_'+a+"_info_4','file_dl_info_"+a+'\')">تگ برای انجمن ها</span>            </div>            <div class="tabs_body_div"  style="display:none" id="file_'+a+'_info_1" name="file_'+a+'_info_1">                <textarea onclick="this.focus();this.select()" class="textarea_style" id="textarea_'+a+'_info_1" readonly="1">'+b+'</textarea>  <button id="copy-button-'+a+'-1" data-clipboard-target="textarea_'+a+'_info_1" onclick="return false;" class="copy-button">کپی کن</button>  </div>      <div class="tabs_body_div"  id="file_'+a+'_info_2" name="file_'+a+'_info_2">                <textarea onclick="this.focus();this.select()" class="textarea_style" id="textarea_'+a+'_info_2" readonly="1">'+c+'</textarea>      <button id="copy-button-'+a+'-2" data-clipboard-target="textarea_'+a+'_info_2" onclick="return false;" class="copy-button">کپی کن</button>      </div>              <div class="tabs_body_div" style="display:none" id="file_'+a+'_info_3" name="file_'+a+'_info_3">                <textarea onclick="this.focus();this.select()" class="textarea_style" id="textarea_'+a+'_info_3" readonly="1">'+f+'</textarea>      <button id="copy-button-'+a+'-3" data-clipboard-target="textarea_'+a+'_info_3" onclick="return false;" class="copy-button">کپی کن</button>      </div>              <div class="tabs_body_div" style="display:none" id="file_'+a+'_info_4" name="file_'+a+'_info_4">                <textarea onclick="this.focus();this.select()" class="textarea_style" id="textarea_'+a+'_info_4" readonly="1">'+g+'</textarea>        <button id="copy-button-'+a+'-4" data-clipboard-target="textarea_'+a+'_info_4" onclick="return false;" class="copy-button">کپی کن</button>     </div>          </div></td></tr>'),client.clip($("#copy-button-"+a+"-1")),client.clip($("#copy-button-"+a+"-2")),client.clip($("#copy-button-"+a+"-3")),client.clip($("#copy-button-"+a+"-4")),$("#slot_filename_div_"+a).html("<a href='"+c+"' target='_blank'>"+d+"</a>"),$("#span_file_"+a+"_info_2").css("border-top","3px #4CC417 solid"),$("#span_file_"+a+"_info_2").css("border-bottom-width","1px"))}function progress(a){a.lengthComputable&&($("#progress_"+a.target.progid).css("width",100*a.loaded/a.total+"%"),$("#progress_percent_"+a.target.progid).html(Math.floor(100*a.loaded/a.total)+"%"),$("#size_speed_"+a.target.progid).html(NormalizeSize(a.loaded,"en")+' <span style="color:black;font-weight:bold">/</span> '+Math.floor(2*(a.loaded-a.target.loadedTillNow)/1024)+" KB.sec"),a.target.loadedTillNow=a.loaded)}function NormalizeSize(a,b){return a>Math.pow(1024,3)?(a/Math.pow(1024,3)).toFixed(2)+("en"==b?" GB":" گیگابایت"):a>Math.pow(1024,2)?(a/Math.pow(1024,2)).toFixed(2)+("en"==b?" MB":" مگابایت"):a>1024?(a/1024).toFixed(2)+("en"==b?" KB":" کیلوبایت"):a+("en"==b?" byte":" بایت")}function change_info(a,b){$("#"+b).children().next().hide(),$("#"+b).children().children().css("border-top","1px silver solid"),$("#"+b).children().children().css("border-bottom-width","4px"),$("#"+b).children().next().next().hide(),$("#"+b).children().children().next().css("border-top","1px silver solid"),$("#"+b).children().children().next().css("border-bottom-width","4px"),$("#"+b).children().next().next().next().hide(),$("#"+b).children().children().next().next().css("border-top","1px silver solid"),$("#"+b).children().children().next().next().css("border-bottom-width","4px"),$("#"+b).children().next().next().next().next().hide(),$("#"+b).children().children().next().next().next().css("border-top","1px silver solid"),$("#"+b).children().children().next().next().next().css("border-bottom-width","4px"),$("#span_"+a).css("border-top","3px #4CC417 solid"),$("#span_"+a).css("border-bottom-width","1px"),$("#"+a).show(),$(".textarea_style").css("border-top-width","0px")}function LoadPasswordPrompt(){var a=prompt("اسم شب ؟؟"),b=document.createElement("input");b.setAttribute("type","hidden"),b.setAttribute("name","LoadedPassword"),b.setAttribute("id","LoadedPassword"),b.setAttribute("value",a),document.getElementById("frm").appendChild(b),document.getElementById("frm").submit()}function SendContactText(){$(".err_message").html(""),$(".contact_success_message").html(""),$(".contact_error_message").html(""),$.ajax({url:"/contact.php",type:"POST",success:function(a){a=a.trim(),"email_problem"==a?($("#email_message").html("ایمیل خود را بطور صحیح وارد کنید."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"no_email"==a?($("#email_message").html("ایمیل خود را وارد کنید."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"no_text"==a?($("#text_message").html("هیچ متنی وارد نکرده اید."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"short_text"==a?($("#text_message").html("طول متن وارد شده کوتاه است."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"wrong_code"==a?($("#code_message").html("کد وارد شده اشتباه است."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"success"==a&&($(".contact_success_message").html("پیام شما با موفقیت ثبت شد."),$(".contact_success_message").show())},error:function(a){alert("error")},data:{type:"contact",email:$("#email").val().trim(),txt:$("#txt").val().trim(),code:$("#code").val().trim()}})}function SendErrorReport(){$(".contact_success_message").html(""),$(".contact_error_message").html(""),$(".err_message").html(""),$.ajax({url:"/contact.php",type:"POST",success:function(a){a=a.trim(),"no_text"==a?($("#text_message").html("هیچ متنی وارد نکرده اید."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"short_text"==a?($("#text_message").html("طول متن وارد شده کوتاه است."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"wrong_code"==a?($("#code_message").html("کد وارد شده اشتباه است."),$(".contact_error_message").html("خطاهای نمایش داده شده فیلدها را تصیح کنید."),$(".contact_error_message").show()):"success"==a&&($(".contact_success_message").html("گزارش شما با موفقیت ثبت شد."),$(".contact_success_message").show())},error:function(a){alert("error")},data:{type:"report",keycode:$("#keycode").val().trim(),txt:$("#txt").val().trim(),code:$("#code").val().trim()}})}$.ajaxSetup({global:!1,timeout:1e7}),$(".paragraphs_menu a").click(function(a){$(".paragraphs_menu li").attr("class",""),$(this).parent().attr("class","active_menu"),$(".tab_content").css("display","none"),$(""+$(this).attr("href")).css("display","block"),a.stopPropagation(),a.preventDefault()}),$("#upload_addresses_button").click(function(){var a=new Date,b=Math.floor(1e6*Math.random()+5e3)+"-"+a.toUTCString().substr(a.toUTCString().indexOf(",")+1),c="";$(".address_upload_notice").hide(),$(".addresses-textarea-label").hide(),$(".file-addresses-textarea").hide(),$("#upload_addresses_button").attr("disabled","disabled"),$(".progressbar_container").show(),$(".upload_detail").show(),$(".upload-type-switch-container").hide(),clearInterval(c),$.post("/cgi-bin/upload_starter.pl",{files_id:b,address:$(".file-addresses-textarea").val().split("\n")[0]}).done(function(a){"started"==a&&(c=setInterval(function(){$.get("/cgi-bin/hook_tools.pl?type=progress&files_id="+b).done(function(a){var b=a.split("&");if(setProgress(Math.ceil(b[0])),"undefined"==typeof b[1])return alert("آپلود آدرس مورد نظر با خطا مواجه شد"),clearInterval(c),!1;var d=$(".file-addresses-textarea").val().split("\n").length;$(".upload_detail span").html((d>2?"2":d)+" Addresses to upload...<br>Uploading file "+(b[1].length>23?b[1].substr(0,22)+"...":b[1])+" &nbsp; --- &nbsp; "+(b[2]/1024/1024).toFixed(2)+" MB from "+(b[3]/1024/1024).toFixed(2)+" MB"),"complete"==b[4]&&(clearInterval(c),$(".addresses-textarea-label").show(),$(".file-addresses-textarea").show(),$(".progressbar_container").hide(),$(".upload_detail").hide(),$(".address_upload_notice").show(),alert("آپلود به اتمام رسید . برای مشاهده لینک فایلهای آپلود شده به پنل کاربری مراجعه کنید."),$(".upload-type-switch-container").show(),$(".file-addresses-textarea").val(""),$("#upload_addresses_button").removeAttr("disabled"),setProgress(0))}).fail(function(a,b){})},2e3))}).fail(function(a,b){})}),$("#normal-file-upload").click(function(){$(".fileupload-main-container").show(),$(".fileupload-from-address-main-container").hide()}),$("#upload-from-address").click(function(){$(".fileupload-main-container").hide(),$(".fileupload-from-address-main-container").show()}),$("#login_span").click(function(){$(".pointy").slideToggle("fast"),$(".login_dropdown_style").slideToggle("fast")}),$(".online_ico_style,.online_arrow_ico").click(function(){$(".pointy").slideToggle("fast"),$(".setting_dropdown_style").slideToggle("fast")}),$(".setting_dropdown_style div").click(function(){$(".pointy").slideToggle("fast"),$(".setting_dropdown_style").slideToggle("fast")}),$(".fileupload_input").hover(function(){$(".upload-thin-span").html("یا فایل خود را به این قسمت کشیده و رها کنید")},function(){$(".upload-thin-span").html("برای آپلود فایل اینجا کلیک کنید")}),$("#signout").click(function(){$("#SignoutCheck").prop("checked",!0),document.getElementById("frm").submit()});var prog_counter=1,file_slots=new Array,slotsdb=new Array,form=new Array,client=new ZeroClipboard;window.onload=function(){document.getElementById("incoming").onchange=function(){startUpload(),Uploader()},getInternetExplorerVersion()>-1&&getInternetExplorerVersion()<10&&($("#upload_search_container").empty(),$("#upload_search_container").html("<h1 style='color:red;font-size:17px;direction:rtl'>جهت استفاده از امکانات سایت و آپلود فایل از مرورگری بغیر از اینترنت اکسپلورر استفاده نمایید.</h1>"))};