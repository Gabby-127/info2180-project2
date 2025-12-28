
<?php session_start(); if ($_SESSION['role'] !== 'Admin') exit("Access Denied"); ?>
<h1>New User</h1>
<form id="new-user-form" style="background: white; padding: 30px; border-radius: 8px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" id="password" name="password" placeholder="Password (1 Upper, 1 Lower, 1 Number)" required>
    </div>
    <label>Role</label>
    <select name="role">
        <option value="Member">Member</option>
        <option value="Admin">Admin</option>
    </select>
    <button type="submit" class="btn-primary" style="width: auto;">Save User</button>
</form>
