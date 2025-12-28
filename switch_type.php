/* switch_type.php */
<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized";
    exit;
}

$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);
$current_type = filter_input(INPUT_POST, 'current_type', FILTER_SANITIZE_STRING);

if (!$contact_id || !$current_type) {
    echo "Invalid input.";
    exit;
}

$new = ($current_type === 'Sales Lead') ? 'Support' : 'Sales Lead';
$pdo->prepare("UPDATE Contacts SET type=?, updated_at=NOW() WHERE id=?")->execute([$new, $contact_id]);
echo "success";
?>