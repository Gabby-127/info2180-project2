<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <span style="font-size: 2rem; margin-right: 15px;">🐬</span>
        <h1>Dolphin CRM</h1>
    </header>
    <main id="main-content">
        <?php if (!$isLoggedIn): ?>
            <div class="login-container">
                <h2>Login</h2>
                <form id="login-form" class="login-form">
                    <div id="login-message" class="error-msg"></div>
                    <input type="email" name="email" placeholder="Email address" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn-primary"><i class="fa fa-lock"></i> Login</button>
                </form>
            </div>
            <hr>
            <footer>Copyright &copy; 2025 Dolphin CRM</footer>
        <?php else: ?>
            <div class="dashboard-container">
                <aside>
                    <nav>
                        <ul>
                            <li><a href="#" id="nav-home"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="#" id="nav-new-contact"><i class="fa fa-user-circle"></i> New Contact</a></li>
                            <li><a href="#" id="nav-users"><i class="fa fa-users"></i> Users</a></li>
                            <li style="border-top: 1px solid #eee; padding-top: 15px;"><a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </nav>
                </aside>
                <section id="result">
                    <h1>Dashboard</h1>
                    <p>Loading...</p>
                </section>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
