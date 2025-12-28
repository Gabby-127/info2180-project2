/* add_contact.php */
<?php
session_start();
require_once 'db.php';

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$assigned_to = filter_input(INPUT_POST, 'assigned_to', FILTER_VALIDATE_INT);

if (!$firstname || !$lastname || !$email || !$telephone || !$company || !$type || !$assigned_to) {
    echo "All fields are required.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,NOW(),NOW())");
if ($stmt->execute([
    $title, $firstname, $lastname, $email, 
    $telephone, $company, $type, $assigned_to, $_SESSION['user_id']
])) echo "success";
else echo "Error";
?>