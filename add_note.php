
<?php
session_start(); require_once 'db.php';
$stmt = $pdo->prepare("INSERT INTO Notes (contact_id, comment, created_by, created_at) VALUES (?,?,?,NOW())");
if($stmt->execute([$_POST['contact_id'], $_POST['comment'], $_SESSION['user_id']])) {
    $pdo->prepare("UPDATE Contacts SET updated_at = NOW() WHERE id = ?")->execute([$_POST['contact_id']]);
    echo "success";
} else echo "error";
?>