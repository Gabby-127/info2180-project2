<?php
/* db.php */
$host = 'localhost';
$dbname = 'dolphin_crm';
$username = 'root'; 
$password = ''; 

$pdo = null;
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    // Throw exception - let calling script handle it
    throw $e;
}
?>