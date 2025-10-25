<?php
session_start();

// Redirect if no 2FA pending
if(!isset($_SESSION['2fa_pending']) || !isset($_SESSION['2fa_user_email'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Handle 2FA submission
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $entered_code = trim($_POST['code']);

    if($entered_code == $_SESSION['2fa_code']) {
        // 2FA successful: finalize login
        $_SESSION['user_id'] = $_SESSION['2fa_user_email']; // or actual user ID if stored earlier
        $_SESSION['fullname'] = $_SESSION['user_fullname'];

        // Clear 2FA session variables
        unset($_SESSION['2fa_code'], $_SESSION['2fa_pending'], $_SESSION['2fa_user_email'], $_SESSION['user_fullname']);

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "❌ Invalid 2FA code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify 2FA | Hospital Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4 col-md-4 mx-auto">
        <h3 class="text-center mb-4">Two-Factor Authentication</h3>

        <?php if($message): ?>
            <div class="alert alert-danger text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Enter the 6-digit code sent to your email</label>
                <input type="text" name="code" class="form-control" maxlength="6" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Verify Code</button>
            <a href="login.php" class="btn btn-secondary w-100 mt-2">Back to Login</a>
        </form>
    </div>
</div>
</body>
</html>

