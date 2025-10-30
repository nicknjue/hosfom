<?php
session_start();
include 'databaseconn.php';
include 'classes/User.php';
include 'verify2fa.php';
$user = new User($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST['code']);
    $user_id = $_SESSION['user_id'];

    if ($user->verify2FA($user_id, $code)) {
        $_SESSION['2fa_verified'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "❌ Invalid or expired code!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>2FA Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 col-md-4 mx-auto">
        <h3 class="text-center mb-4">2FA Verification</h3>
        <?= $message ? "<div class='alert alert-danger'>$message</div>" : "" ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Enter 2FA Code</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Verify</button>
        </form>
    </div>
</div>
</body>
</html>
