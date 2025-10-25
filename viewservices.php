<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'databaseconn.php';
include_once 'classes/services.php';

$goods = new GoodsServices($conn);
$list = $goods->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Goods & Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">All Goods & Services</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        <?php if($list): ?>
            <?php foreach($list as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['service_id']) ?></td>
                    <td><?= htmlspecialchars($item['service_name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($item['Category'] ?? '') ?></td>
                    <td><?= htmlspecialchars($item['cost'] ?? '') ?></td>
                    <td><?= htmlspecialchars($item['description'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center">No goods or services found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
</body>
</html>
