<?php
session_start();
if (isset($_COOKIE['userlogged'])) {
    unset($_COOKIE['userlogged']); 
    setcookie('userlogged', null, -1, '/'); 
    //return true;
    header("Location: http://mehrdadweb.ir/");
} else {
    //return false;
    header("Location: http://mehrdadweb.ir/");
}
/* 
//deleting cookie by setting expirty to past time
setcookie("userlogged", "", time() - 3600);
setcookie('user', '', time() - 3600);
//destroys all session variables
session_destroy();

//header("Location: http://mehrdadweb.ir/");*/
/*if(count($_COOKIE) > 0) {
  echo "Cookies are enabled.";
} else {
  echo "Cookies are disabled.";
}*/

exit;
?>