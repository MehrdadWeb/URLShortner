<?php
/*echo '<pre>';
var_dump(headers_list());
echo '</pre>';*/
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


if(!isset($_COOKIE["user"])) {
     echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
     echo "Cookie '" . $cookie_name . "' is set!<br>";
     echo "Value is: " . $_COOKIE["user"];
}

?>
<p><strong>Note:</strong> You might have to reload the page to see the value of the cookie.</p>
