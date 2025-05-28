<?php
session_start();
date_default_timezone_set('Asia/Manila'); // Set timezone here

require_once __DIR__ . '/admin-class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-reset'])) {
    $csrf_token = $_POST['csrf_token'] ?? '';
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // CSRF token validation
    if (!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo "❌ Invalid CSRF Token.";
        exit;
    }

    if (empty($token) || empty($new_password) || empty($confirm_password)) {
        echo "❌ Missing required fields.";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "❌ Passwords do not match.";
        exit;
    }

    $admin = new ADMIN();

    // Get the token expiry from the database, no need for NOW() here
    $stmt = $admin->runQuery("SELECT reset_token_expiry FROM user WHERE reset_token = :token");
    $stmt->execute([':token' => $token]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo "❌ No user found with that token.";
        exit;
    }

    $expiry = $result['reset_token_expiry'];
    $now = date('Y-m-d H:i:s'); // current PHP datetime

    if ($expiry < $now) {
        echo "❌ Token is expired.";
        exit;
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update = $admin->runQuery("UPDATE user SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token");
    $update->execute([
        ':password' => $hashed_password,
        ':token' => $token
    ]);

    echo "✅ Password reset successful.";
    exit;
}
