<?php
//this file adds a new column email to the database

$db = new PDO('sqlite:users.db');

$db->exec("ALTER TABLE users ADD COLUMN email TEXT");

$stmt = $db->prepare("UPDATE users SET email = :email WHERE email IS NULL");
$stmt->execute([':email' => 'example@example.com']);

echo "Database updated.";
?>
