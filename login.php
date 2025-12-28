<?php
session_start();
header('Content-Type: application/json');
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require_once 'db.php';
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (empty($email) || empty($password)) {
            $response['message'] = 'Email and password are required.';
        } else {
            $stmt = $pdo->prepare("SELECT id, firstname, lastname, password, role FROM Users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['role'] = $user['role'];
                $response['success'] = true;
            } else {
                $response['message'] = 'Invalid email or password.';
            }
        }
    } catch (PDOException $e) {
        error_log("Login DB Error: " . $e->getMessage());
        $response['message'] = 'Database error. Please try again.';
    } catch (Exception $e) {
        error_log("Login Error: " . $e->getMessage());
        $response['message'] = 'An error occurred. Please try again.';
    }
}
echo json_encode($response);
?>