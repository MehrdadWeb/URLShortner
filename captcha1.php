<?php
// We start a session to access 
// the captcha externally! 
session_start(); 
// Generate a random number 
// from 1000-9999
//$captcha = rand(1000, 9999);
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$captcha = '';
for ($i = 0; $i < 5; $i++){
    $captcha .= $characters[mt_rand(0, 61)];
}
    $cookie_name = "captcha1";
    $cookie_value = $captcha;
    //expiriry time. 86400 = 1 day (86400*30 = 1 month)
    $expiry = time() + (86400 * 30);
    //.Remember me cheked true or flase    
    setcookie($cookie_name, $cookie_value, $expiry, "/");
// The capcha will be stored 
// for the session 
//$_SESSION["captcha"] = $captcha;
if($_GET['random']==''){
    $_SESSION["captcha1"] = $captcha;
}else{
  $_SESSION["captcha1"]=$_GET['random'];  
}
$_SESSION["captcha2"]=$captcha;
// Generate a 50x24 standard captcha image 
$im = imagecreatetruecolor(60, 30);   
  
// Blue color 
$bg = imagecolorallocate($im, 22, 86, 165); 
  
// White color 
$fg = imagecolorallocate($im, 255, 255, 255); 
   
// Give the image a blue background 
imagefill($im, 0, 0, $bg);  
   
// Print the captcha text in the image 
// with random position & size 
imagestring($im, rand(4, 7), rand(4, 7), 
            rand(4, 7),  $captcha, $fg); 
            
$_SESSION["captcha2"] = $captcha;   
// VERY IMPORTANT: Prevent any Browser Cache!! 
/*header("Cache-Control: no-store, 
            no-cache, must-revalidate");  
   
// The PHP-file will be rendered as image 
header('Content-type: image/png');*/  /*با کامنت کردن این قسمت تصویر کپچا درست شد */
   
// Finally output the captcha as 
// PNG image the browser   
imagepng($im);  
$_SESSION["captcha3"] = $im;  
echo $im;  
// Free memory 
imagedestroy($im); 
?>

