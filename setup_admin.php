<?php
require_once 'db.php';
$pass = password_hash('password123', PASSWORD_DEFAULT);
$pdo->prepare("UPDATE Users SET password = ? WHERE email = 'admin@project2.com'")->execute([$pass]);
echo "Admin password set to 'password123'. Delete this file after use.";
?>