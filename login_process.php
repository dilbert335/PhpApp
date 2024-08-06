<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);
$stored_password = $stmt->fetchColumn();

if ($stored_password && password_verify($password, $stored_password)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    exit();
} else {
    echo "Invalid username or password.";
}
?>
