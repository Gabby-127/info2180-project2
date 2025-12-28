/* assign_contact.php */
<?php
session_start(); require_once 'db.php';
$pdo->prepare("UPDATE Contacts SET assigned_to=?, updated_at=NOW() WHERE id=?")->execute([$_SESSION['user_id'], $_POST['contact_id']]);
echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
?>