<?php include_once 'config/settings-configuration.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login & Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <!-- Login Form -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4">Sign In</h3>
                    <form method="POST" action="dashboard/admin/authentication/admin-class.php">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3 text-end">
                            <a href="forgot-password.php" class="text-decoration-none">Forgot Password?</a>
                        </div>
                        <button class="btn btn-primary w-100" name="btn-signin">Sign In</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4">Register</h3>
                    <form method="POST" action="dashboard/admin/authentication/admin-class.php">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button class="btn btn-success w-100" name="btn-signup">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
