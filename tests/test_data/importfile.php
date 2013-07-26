<?php 

$pdo = new PDO('mysql:host=localhost;dbname=test-db-fixtures', 'root');

$pdo->exec('INSERT INTO `table1` VALUES ("8","test8","test test8","8.32")');
$pdo->exec('INSERT INTO `table1` VALUES ("9","test9","test test9","9.32")');