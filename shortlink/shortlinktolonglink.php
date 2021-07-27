<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
function redirect($url)
{
    
    if (!headers_sent()){
        header("Location: $url");
    }else{
       echo "<script type='text/javascript'>
        window.location.href='$url'
        exit();
        </script>";
        echo "<noscript><meta  http-equiv='refresh' content='0;url='$url'/></noscript>";
    }
    exit;
}

//$_GET['id'] haman code 5 harfi mibashad ke az tarighe .htaccess be  page shortlinktolonglink.php enteghal dade shode
//echo $_GET['id'];
if(isset($_GET['id'])){
    require 'config.php';
    $shortlink="mehrdadweb.ir/";
    $shortlink.=$_GET['id'];
    $sql = "SELECT link FROM LINKSTABLE WHERE shortlink='$shortlink'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)  {
        $row = $result->fetch_assoc();
        $longlink=$row["link"];
        echo $_GET['id'];
        redirect("$longlink");
        $conn->close();
        
    }else{
        echo "<br>0 results";
        
    }      
    
}
?>   
</body>
</html>