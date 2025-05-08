<?php
require_once __DIR__ . '/admin-class.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-reset'])) {
    $csrf_token = $_POST['csrf_token'] ?? '';
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // 1. Validate CSRF token
    if (!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo "<script>alert('Invalid CSRF Token!'); window.location.href='../../../';</script>";
        exit;
    }

    // 2. Validate form input
    if (empty($token) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    $admin = new ADMIN();

    // 3. Validate token from DB
    $stmt = $admin->runQuery("SELECT * FROM user WHERE reset_token = :token AND reset_token_expiry >= NOW()");
    $stmt->execute([':token' => $token]);

    if ($stmt->rowCount() !== 1) {
        echo "<script>alert('Invalid or expired token.'); window.location.href='../../../';</script>";
        exit;
    }

    // 4. Update password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update = $admin->runQuery("UPDATE user SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token");
    $update->execute([
        ':password' => $hashed_password,
        ':token' => $token
    ]);

    echo "<script>alert('Password has been reset successfully.'); window.location.href='../../../';</script>";
    exit;
}
?>
