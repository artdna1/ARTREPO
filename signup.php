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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up - Grow a Garden</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to bottom, #c2fbd7, #fdfcdc);
      background-image: url('https://cdn.pixabay.com/photo/2017/07/23/08/09/garden-2532574_1280.jpg');
      background-size: cover;
      background-position: center;
      font-family: 'Fredoka', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 1rem;
    }

    .signup-card {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1.5rem;
      padding: 2.5rem;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease;
    }

    .signup-card h4 {
      text-align: center;
      font-weight: bold;
      font-size: 2rem;
      color: #2e7d32;
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

    .login-link {
      margin-top: 1rem;
      font-size: 0.9rem;
      text-align: right;
    }

    .login-link a {
      color: #1b5e20;
      font-weight: 600;
      text-decoration: none;
    }

    .login-link a:hover {
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

<div class="signup-card">
  <h4>🍃Create Your New Account</h4>
  <form action="dashboard/admin/authentication/admin-class.php" method="POST" novalidate>
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
    
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input
        type="text"
        id="username"
        name="username"
        class="form-control"
        placeholder="username"
        required
        autofocus
      />
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        placeholder="email@example.com"
        required
      />
    </div>

    <div class="mb-4">
      <label for="password" class="form-label">Password</label>
      <input
        type="password"
        id="password"
        name="password"
        class="form-control"
        placeholder="••••••••"
        required
      />
    </div>

    <div class="login-link">
      <a href="index.php">Already have an account?</a>
    </div>

    <button type="submit" class="btn btn-garden w-100 py-2 mt-3" name="btn-signup">
      Sign Up
    </button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
