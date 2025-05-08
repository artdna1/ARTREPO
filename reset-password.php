<?php include_once 'config/settings-configuration.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4">Reset Password</h3>
                    <form method="POST" action="dashboard/admin/authentication/reset-password-handler.php">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? ''; ?>">
                        <div class="mb-3">
                            <input type="password" name="new_password" class="form-control" placeholder="New password" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                        </div>
                        <button class="btn btn-success w-100" name="btn-reset">Reset Password</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="index.php" class="text-decoration-none">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
