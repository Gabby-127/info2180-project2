/* add_user.php */
<?php
session_start();
require_once 'db.php';
if ($_SESSION['role'] !== 'Admin') exit("Unauthorized");

$fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pass  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$role  = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

// Regex check (Server side backup)
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass)) exit("Password complexity not met.");

$hashed = password_hash($pass, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO Users (firstname, lastname, email, password, role, created_at) VALUES (?,?,?,?,?,NOW())");

if ($stmt->execute([$fname, $lname, $email, $hashed, $role])) echo "User successfully created.";
else echo "Error creating user.";
?>