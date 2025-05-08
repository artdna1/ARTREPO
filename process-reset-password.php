<?php
require_once __DIR__ . '/dashboard/admin/authentication/admin-class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-reset'])) {
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($token) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    $admin = new ADMIN();
    $stmt = $admin->runQuery("SELECT * FROM user WHERE reset_token = :token AND reset_token_expiry >= NOW()");
    $stmt->execute([':token' => $token]);

    if ($stmt->rowCount() !== 1) {
        echo "<script>alert('Invalid or expired token.'); window.location.href='index.php';</script>";
        exit;
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update = $admin->runQuery("UPDATE user SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token");
    $update->execute([
        ':password' => $hashed_password,
        ':token' => $token
    ]);

    echo "<script>alert('Password has been reset. Please sign in.'); window.location.href='index.php';</script>";
    exit;
}
