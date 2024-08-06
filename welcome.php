<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit();
}

require 'db.php';

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT email FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p><a href="profile.php">Go to Profile</a></p>
    <a href="logout.php">Logout</a>
</body>
</html>
