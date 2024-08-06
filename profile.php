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
    echo "<div class='alert alert-success'>Profile updated successfully.</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Profile Page</h1>
        <p class="mt-3">Welcome to your profile page, <?php echo htmlspecialchars($username); ?>!</p>

        <form action="profile.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <div class="mt-3">
            <a href="welcome.php" class="btn btn-secondary">Back to Welcome</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
