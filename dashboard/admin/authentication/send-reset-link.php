<?php
require_once __DIR__ . '/admin-class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-forgot'])) {
    $csrf_token = $_POST['csrf_token'] ?? '';
    $email = trim($_POST['email']);

    if (!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo "<script>alert('Invalid CSRF Token!'); window.location.href='../../../';</script>";
        exit;
    }

    // Create a new instance of the ADMIN class
    $admin = new ADMIN();
    $stmt = $admin->runQuery("SELECT * FROM user WHERE email = :email AND status = 'active'");
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $token = bin2hex(random_bytes(32)); // Generate reset token
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes')); // Token expiry (15 minutes)

        // Save the token and expiry in the database
        $stmt = $admin->runQuery("UPDATE user SET reset_token = :reset_token, reset_token_expiry = :expiry WHERE email = :email");
        $stmt->execute([
            ':reset_token' => $token,
            ':expiry' => $expiry,
            ':email' => $email
        ]);

        $link = "http://{$_SERVER['HTTP_HOST']}/ARTREPO/reset-password.php?token=$token";

        $subject = "Password Reset Request";
        $message = "
            <p>Hi {$user['username']},</p>
            <p>Click the link below to reset your password:</p>
            <a href='$link'>Reset Password</a>
            <p>This link will expire in 15 minutes. If you didn't request a reset, ignore this message.</p>
        ";

        // Send email using PHPMailer
        $admin->send_email($email, $message, $subject, $admin->getSmtpEmail(), $admin->getSmtpPassword());

        // Redirect the user with success message
        echo "<script>alert('Reset link sent!'); window.location.href='../../../';</script>";
    } else {
        echo "<script>alert('No active account found with that email.'); window.location.href='../../../';</script>";
    }
}
?>
