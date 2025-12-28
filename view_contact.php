<?php
require_once 'db.php';
$id = $_GET['id'];
$c = $pdo->prepare("SELECT c.*, u1.firstname as assign_fn, u1.lastname as assign_ln, u2.firstname as creator_fn, u2.lastname as creator_ln FROM Contacts c JOIN Users u1 ON c.assigned_to=u1.id JOIN Users u2 ON c.created_by=u2.id WHERE c.id=?");
$c->execute([$id]);
$contact = $c->fetch();
?>
<div class="profile-header">
    <div style="display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 3rem;">🐬</span>
        <div>
            <h1 style="margin: 0;"><?= htmlspecialchars($contact['title'].'. '.$contact['firstname'].' '.$contact['lastname']) ?></h1>
            <p style="color: #666; margin: 5px 0;">Created on <?= $contact['created_at'] ?> by <?= $contact['creator_fn'] ?></p>
            <p style="color: #666; margin: 0;">Updated on <?= $contact['updated_at'] ?></p>
        </div>
    </div>
    <div class="action-buttons">
        <button id="assign-me-btn" data-id="<?= $contact['id'] ?>" class="btn-primary" style="width: auto; background: #10b981;"><i class="fa fa-hand-paper"></i> Assign to me</button>
        <button id="switch-type-btn" data-id="<?= $contact['id'] ?>" data-type="<?= $contact['type'] ?>" class="btn-primary" style="width: auto; background: #f59e0b;"><i class="fa fa-exchange-alt"></i> Switch to <?= $contact['type'] == 'Sales Lead' ? 'Support' : 'Sales Lead' ?></button>
    </div>
</div>
<div class="info-grid">
    <div><label>Email</label><strong><?= $contact['email'] ?></strong></div>
    <div><label>Telephone</label><strong><?= $contact['telephone'] ?></strong></div>
    <div><label>Company</label><strong><?= $contact['company'] ?></strong></div>
    <div><label>Assigned To</label><strong><?= $contact['assign_fn'].' '.$contact['assign_ln'] ?></strong></div>
</div>
<div class="notes-card">
    <div class="notes-header">
        <h3><i class="fa fa-edit"></i> Notes</h3>
    </div>
    <hr style="margin: 0;">
    <div id="notes-container" class="notes-list"></div>
    <div class="notes-footer">
        <label>Add a note about <?= htmlspecialchars($contact['firstname']) ?></label>
        <textarea id="new-note" placeholder="Enter details here" style="height: 100px;"></textarea>
        <button id="add-note-btn" data-id="<?= $contact['id'] ?>" class="btn-primary" style="width: auto; align-self: flex-end;">Add Note</button>
    </div>
</div>