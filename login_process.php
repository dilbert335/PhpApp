<?php
session_start();

$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($users[$username]) && $users[$username] === $password) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    exit();
} else {
    echo "Invalid username or password.";
}
?>
