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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="mt-3">Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="profile.php" class="btn btn-secondary">Go to Profile</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
