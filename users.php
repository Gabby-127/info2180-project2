
<?php
session_start();
require_once 'db.php';
if ($_SESSION['role'] !== 'Admin') exit("Access Denied");
$users = $pdo->query("SELECT * FROM Users")->fetchAll();
?>
<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <h1>Users</h1>
    <button id="add-user-btn" class="btn-primary" style="width: auto;">+ Add User</button>
</div>
<div class="table-container" style="background: white; border-radius: 8px; overflow: hidden;">
    <table>
        <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr></thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['firstname'] . ' ' . $u['lastname']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>
                <td><?= $u['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>