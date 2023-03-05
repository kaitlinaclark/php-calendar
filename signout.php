<?php
session_start();
session_unset(); 
session_destroy(); 
if(isset($_SESSION["username"])){
    echo "Session not destroyed. Username is ".$_SESSION["username"];
}
header ("Location: http://ec2-34-219-74-52.us-west-2.compute.amazonaws.com/~kaitlinaclark/calendar/php-calendar/index.php");
?>

