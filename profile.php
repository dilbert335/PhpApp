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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE username = :username");
    $stmt->execute([':email' => $email, ':username' => $username]);

    $user['email'] = $email;
    echo "Profile updated successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h1>Profile Page</h1>
    <p>Welcome to your profile page, <?php echo htmlspecialchars($username); ?>!</p>

    <form action="profile.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <input type="submit" value="Update Profile">
    </form>

    <p><a href="welcome.php">Back to Welcome</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
