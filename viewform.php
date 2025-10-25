<?php
include_once 'databaseconn.php';
include_once 'classes/evaluation.php';
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$eval = new Evaluation($conn);
$result = $eval->getAllEvaluations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Evaluations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">All Submitted Evaluations</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Department</th>
                <th>Service Rating</th>
                <th>Staff Behavior</th>
                <th>Cleanliness</th>
                <th>Comments</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($result)): ?>
            <?php foreach($result as $row): ?>
                <tr>
                    <td><?= $row['eval_id'] ?></td>
                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= htmlspecialchars($row['department']) ?></td>
                    <td><?= $row['service_rating'] ?></td>
                    <td><?= $row['staff_behavior'] ?></td>
                    <td><?= $row['cleanliness'] ?></td>
                    <td><?= htmlspecialchars($row['comments']) ?></td>
                    <td><?= $row['submitted_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9" class="text-center">No evaluations found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

</div>
</body>
</html>
