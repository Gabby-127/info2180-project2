<?php
session_start();
require_once 'db.php';
$filter = $_GET['filter'] ?? 'all';
$uid = $_SESSION['user_id'];

if ($filter === 'Sales Lead') {
    $stmt = $pdo->prepare("SELECT * FROM Contacts WHERE type = 'Sales Lead'");
    $stmt->execute();
} elseif ($filter === 'Support') {
    $stmt = $pdo->prepare("SELECT * FROM Contacts WHERE type = 'Support'");
    $stmt->execute();
} elseif ($filter === 'assigned') {
    $stmt = $pdo->prepare("SELECT * FROM Contacts WHERE assigned_to = ?");
    $stmt->execute([$uid]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM Contacts");
    $stmt->execute();
}

$contacts = $stmt->fetchAll();
?>
<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <h1>Dashboard</h1>
    <button id="add-contact-btn" class="btn-primary" style="width: auto;">+ Add Contact</button>
</div>
<div class="filter-bar">
    <strong><i class="fa fa-filter"></i> Filter By: </strong>
    <a href="#" class="filter-btn" data-filter="all">All</a>
    <a href="#" class="filter-btn" data-filter="Sales Lead">Sales Leads</a>
    <a href="#" class="filter-btn" data-filter="Support">Support</a>
    <a href="#" class="filter-btn" data-filter="assigned">Assigned to me</a>
</div>
<div class="table-container" style="background: white; border-radius: 8px;">
    <table>
        <thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Type</th><th></th></tr></thead>
        <tbody>
            <?php foreach ($contacts as $c): ?>
            <tr>
                <td><strong><?= htmlspecialchars($c['title'].' '.$c['firstname'].' '.$c['lastname']) ?></strong></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['company']) ?></td>
                <td><span style="padding: 4px 8px; border-radius: 4px; color: white; background: <?= $c['type']=='Support'?'#6366f1':'#f59e0b'?>"><?= $c['type'] ?></span></td>
                <td><a href="#" class="view-contact-btn" data-id="<?= $c['id'] ?>">View</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>