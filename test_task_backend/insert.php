<?php
    include 'db/connection.php';
    $sql = "insert into `groceries`(`groc_name`, `groc_category`, `groc_price`) values('".$_POST['name']."', '".$_POST['category']."', '".$_POST['price']."')";

    mysql_query($sql);
?>
