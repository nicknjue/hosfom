<?php
include_once 'databaseconn.php';
include_once 'classes/User.php';
include_once 'mailer.php';
session_start();

// Redirect if already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$user = new User($conn);
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($user->loginUser($email, $password)) {
        // Generate 2FA code
        $code = rand(100000, 999999);
        $_SESSION['2fa_code'] = $code;

        // Send code via email
        $mailer = new MailerHelper();
        if($mailer->sendCode($email, $_SESSION['user_fullname'], $code)) {
            header("Location: verfy2fa.php"); // Redirect to 2FA page
            exit();
        } else {
            $message = "❌ Failed to send 2FA code.";
        }
    } else {
        $message = "❌ Invalid email or password!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Hospital Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4 col-md-4 mx-auto">
        <h3 class="text-center mb-4">Login</h3>

        <?php if($message): ?>
            <div class="alert alert-danger text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
            <h1> <i>If not registered</i> </h1>
            <a href="register.php" class="btn btn-success w-100 mt-2">Sign Up</a>
        </form>
    </div>
</div>
</body>
</html>
