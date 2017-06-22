<?php
include "db/connection.php";
$sql = "update `groceries` set `".$_POST['column_name']."` = '".$_POST['text']."' where `groc_name` like '".$_POST['name']."'";
mysql_query($sql);
?>