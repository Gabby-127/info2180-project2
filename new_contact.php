
<?php require_once 'db.php'; $users = $pdo->query("SELECT id, firstname, lastname FROM Users")->fetchAll(); ?>
<h1>New Contact</h1>
<form id="new-contact-form" style="background: white; padding: 30px; border-radius: 8px;">
    <select name="title"><option>Mr</option><option>Mrs</option><option>Ms</option><option>Dr</option><option>Prof</option></select>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telephone" placeholder="Telephone" required>
        <input type="text" name="company" placeholder="Company" required>
        <select name="type"><option value="Sales Lead">Sales Lead</option><option value="Support">Support</option></select>
    </div>
    <label>Assigned To</label>
    <select name="assigned_to">
        <?php foreach($users as $u): ?>
        <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['firstname'].' '.$u['lastname']) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn-primary" style="width: auto;">Save Contact</button>
</form>