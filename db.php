<?php

// configure your database here
// if you are using SQL Lite you don't have to make any changes
// Please read here for more: https://www.php.net/manual/en/ref.pdo-mysql.php
try {
    $pdo = new PDO('sqlite:users.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
