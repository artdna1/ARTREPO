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
  <title>Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: linear-gradient(to bottom, #c2fbd7, #fdfcdc);
      font-family: 'Fredoka', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: url('https://cdn.pixabay.com/photo/2021/07/14/18/49/sunflowers-6466116_1280.jpg');
      background-size: cover;
      background-position: center;
    }

    .garden-card {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1.5rem;
      padding: 2.5rem;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: popIn 0.8s ease;
    }

    .garden-card h2 {
      font-size: 2rem;
      font-weight: bold;
      color: #388e3c;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-label {
      color: #4e944f;
      font-weight: 600;
    }

    .form-control {
      border-radius: 0.8rem;
      border: 2px solid #a5d6a7;
    }

    .btn-garden {
      background-color: #66bb6a;
      color: #fff;
      font-weight: bold;
      border-radius: 0.8rem;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-garden:hover {
      background-color: #4caf50;
    }

    .form-links {
      font-size: 0.9rem;
      color: #558b2f;
    }

    .form-links a {
      color: #558b2f;
      text-decoration: none;
    }

    .form-links a:hover {
      text-decoration: underline;
    }

    @keyframes popIn {
      0% {
        opacity: 0;
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>
  <div class="garden-card">
    <h2>🍃LOGIN</h2>
    <form action="dashboard/admin/authentication/admin-class.php" method="POST">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>

      <div class="d-flex justify-content-between mb-3 form-links">
        <a href="forgot-password.php">Forgot password?</a>
        <a href="signup.php">Create new account!</a>
      </div>

      <div class="d-grid">
        <button type="submit" name="btn-signin" class="btn btn-garden py-2">Sign In</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
