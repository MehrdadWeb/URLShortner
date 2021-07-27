<?php
    $q=$_POST['suggest'];
    require 'config.php';
    echo $conn->query("SELECT shortlink FROM LINKSTABLE WHERE link='$q'")->fetch_assoc()["shortlink"];
?>
