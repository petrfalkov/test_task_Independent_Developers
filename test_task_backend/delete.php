<?php
    include 'db/connection.php';

    $sql = "delete from `groceries` where `groc_name` = '".$_POST["name"]."'";
    mysql_query($sql);
?>