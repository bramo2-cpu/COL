<?php
$host = 'localhost';
$db   = 'bram';     
$user = 'root';          
$pass = '1234';          

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("⚠️ Database connection failed: " . $e->getMessage());
}


$stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC"); 
$users = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; }
        ol { list-style-type: decimal; padding-left: 20px; }
        li { margin: 15px 0; padding: 10px; background: #f9f9f9; border-left: 4px solid #007bff; }
        .email { color: #555; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Registered Users (Numbered List)</h1>

        <?php if (empty($users)): ?>
            <p style="text-align: center; color: #888;">No users registered yet.</p>
        <?php else: ?>
            <ol>
                <?php foreach ($users as $user): ?>
                    <li>
                        <strong><?= htmlspecialchars($user['name'] ?? $user['username'] ?? 'Unknown') ?></strong>
                        <div class="email"><?= htmlspecialchars($user['email']) ?></div>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
</body>
</html>