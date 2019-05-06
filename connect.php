<?php
 /*connect to database news_articles*/
 $host="localhost"; //leave database host blank
 $username="calendar"; //username used to login to database
 $password="calendar123"; //password for username
 $dbname="calendar"; //database name 

 $connect = new mysqli($host, $username, $password, $dbname); //all the information needed to connect to mysql server
 
 if($connect->connect_errno) {
     printf("Connection Failed: %s\n", $connect->connect_error);
     exit;
 }
?>