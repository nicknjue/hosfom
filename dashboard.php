<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Hospital Evaluation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #0d6efd;
            color: white;
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #0b5ed7;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>🏥 HosForm</h4>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="evaform.php">📝 Fill Evaluation Form</a>
    <a href="viewform.php">📋 View Submissions</a>
    <a href="viewusers.php">👥 View Users</a>
    <a href="viewservices.php">🛒 Goods & Services</a>
    <a href="profile.php">👤 My Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <div class="container">
        <div class="alert alert-success">
            Welcome, <strong><?= htmlspecialchars($_SESSION['fullname'] ?? ''); ?></strong> 👋
        </div>

        <h3 class="mb-3">Dashboard Overview</h3>
        <p>Here you can manage your hospital forms, view records, and access reports.</p>

        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Evaluation Forms</h5>
                        <p class="card-text">Submit or review patient evaluations.</p>
                        <a href="evaform.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <p class="card-text">Check or update your account details.</p>
                        <a href="profile.php" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Submissions</h5>
                        <p class="card-text">View all your submitted forms and their status.</p>
                        <a href="viewform.php" class="btn btn-success">Open</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">View Users</h5>
                        <p class="card-text">See all registered users in the system.</p>
                        <a href="viewusers.php" class="btn btn-warning">Open</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
    <div class="card text-center shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Goods & Services</h5>
            <p class="card-text">View all available hospital goods and services.</p>
            <a href="viewservices.php" class="btn btn-warning">View</a>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

</body>
</html>
