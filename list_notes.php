
<?php
require_once 'db.php';
$stmt = $pdo->prepare("SELECT n.*, u.firstname, u.lastname FROM Notes n JOIN Users u ON n.created_by=u.id WHERE contact_id=? ORDER BY created_at DESC");
$stmt->execute([$_GET['contact_id']]);
foreach($stmt->fetchAll() as $n) {
    echo "<div class='note-item'><h4>" . htmlspecialchars($n['firstname'] . ' ' . $n['lastname']) . "</h4><p>" . htmlspecialchars($n['comment']) . "</p><small>{$n['created_at']}</small></div>";
}
?>