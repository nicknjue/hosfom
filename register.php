<?php
include_once 'databaseconn.php';
include_once 'classes/User.php';
session_start();

// Redirect if already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$user = new User($conn);
$message = "";

// Handle registration
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if($password !== $confirm_password) {
        $message = "<div class='alert alert-danger'>❌ Passwords do not match!</div>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='alert alert-danger'>❌ Invalid email format!</div>";
    } else {
        // Create user
        if($user->createUser($fullname, $email, $password)) {
            $message = "<div class='alert alert-success'>✅ Registration successful! You can now <a href='login.php'>login</a>.</div>";
        } else {
            $message = "<div class='alert alert-danger'>❌ Failed to register. Email might already exist.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Hospital Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4 col-md-4 mx-auto">
        <h3 class="text-center mb-4">Sign Up</h3>

        <?= $message ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Sign Up</button>
            <a href="login.php" class="btn btn-outline-primary w-100 mt-2">Back to Login</a>
        </form>
    </div>
</div>
</body>
</html>
