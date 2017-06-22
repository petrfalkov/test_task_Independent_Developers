<?php
include('database.php');

// create DB
try {
    $db = new PDO($DB_DSN_GLOBAL, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("CREATE DATABASE IF NOT EXISTS test_task_backend");
} catch (PDOException $e) {
    echo "ERROR CREATING DB: " . $e->getMessage() . "\n";
}
// build DB structure
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("CREATE TABLE IF NOT EXISTS groceries (
	groc_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	groc_name TEXT NOT NULL,
	groc_category TEXT NOT NULL,
	groc_price INT(8) NOT NULL,
	adding_time TIMESTAMP
	)");
    $qry = $db->prepare('select * from `groceries`');
    $qry->execute();
    if ($qry->rowCount() == 0) {
        for ($i = 0; $i < 30; $i++) { //put some info in db if it's empty
            $name = 'Something' . $i;
            $category;
            if ($i % 2 != 0)
                $category = 'cat1';
            else
                $category = 'cat2';
            $price = rand(40, 500);
            $db->query("INSERT INTO `groceries` (`groc_name`, `groc_category`, `groc_price`)
                              VALUES ('" . $name . "', '" . $category . "', '" . $price . "')");
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>