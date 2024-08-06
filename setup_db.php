<?php
$db = new PDO('sqlite:users.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
)");

$users = [
    ['username' => 'user1', 'password' => password_hash('password1', PASSWORD_DEFAULT)],
    ['username' => 'user2', 'password' => password_hash('password2', PASSWORD_DEFAULT)]
];

$stmt = $db->prepare("INSERT OR IGNORE INTO users (username, password) VALUES (:username, :password)");
foreach ($users as $user) {
    $stmt->execute([':username' => $user['username'], ':password' => $user['password']]);
}

echo "Database setup complete.";
?>
