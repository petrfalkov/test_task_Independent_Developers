<?php
//connect to database 'drone_assets'
$host="localhost";
$user="root";
$pass="root";
$db_name="test_task_backend";
$link = mysql_connect('localhost', 'root', 'root');
mysql_select_db($db_name,$link);
?>