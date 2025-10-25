<?php
session_start();
include_once 'databaseconn.php';
include_once 'classes/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = new User($conn);
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $role = htmlspecialchars(trim($_POST['role']));
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

    if ($user->updateUser($_SESSION['2fa_user_id'], $fullname, $email, $password, $phone, $address, $role)) {
        $message = "<div class='alert alert-success'>✅ Profile updated successfully!</div>";
        // Update session variables
        $_SESSION['user_fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
        $_SESSION['role'] = $role;
    } else {
        $message = "<div class='alert alert-danger'>❌ Failed to update profile!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile | Hospital Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

<div class="container mt-5">
    <div class="card shadow p-4 col-md-6 mx-auto">
        <h3 class="text-center mb-4">My Profile</h3>
        <?= $message ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($_SESSION['user_fullname']?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($_SESSION['address'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="patient" <?= ($_SESSION['role'] ?? '') == 'patient' ? 'selected' : '' ?>>Patient</option>
                    <option value="admin" <?= ($_SESSION['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
</div>
</body>
</html>
