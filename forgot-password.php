<?php
    include_once 'config/settings-configuration.php';

    if (isset($_SESSION['adminSession'])) {
        header("Location: dashboard/admin/");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password - Garden Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      margin: 0;
      font-family: 'Fredoka', sans-serif;
      background: linear-gradient(to bottom, #c2fbd7, #fdfcdc);
      background-image: url('https://cdn.pixabay.com/photo/2017/08/01/08/29/sunflower-2564261_1280.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .forgot-card {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1.5rem;
      padding: 2.5rem;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease;
    }

    .forgot-card h2 {
      font-size: 2rem;
      font-weight: bold;
      color: #388e3c;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-label {
      font-weight: 600;
      color: #4e944f;
    }

    .form-control {
      border-radius: 0.8rem;
      border: 2px solid #a5d6a7;
    }

    .btn-garden {
      background-color: #66bb6a;
      color: white;
      font-weight: bold;
      border-radius: 0.8rem;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-garden:hover {
      background-color: #4caf50;
    }

    .footer-link {
      margin-top: 1.5rem;
      font-size: 0.9rem;
      text-align: center;
    }

    .footer-link a {
      color: #1b5e20;
      text-decoration: none;
      font-weight: 600;
    }

    .footer-link a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<div class="forgot-card">
  <h2>🍃Forgot Your Password?</h2>
  <form action="dashboard/admin/authentication/admin-class.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" required>
    </div>

    <div class="d-grid mt-4">
      <button type="submit" name="btn-forgot-password" class="btn btn-garden py-2">Send Reset Link</button>
    </div>
  </form>

  <div class="footer-link">
    Remembered your password? <a href="index.php">Sign In</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
