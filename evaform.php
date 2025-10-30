<?php
include_once 'databaseconn.php';
include_once 'classes/evaluation.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$eval = new Evaluation($conn);
$message = "";

// Fetch departments for dropdown

$departments = [];
$stmt = $conn->query("SELECT dept_name FROM departments ORDER BY dept_name ASC");
$departments = $stmt->fetchAll(PDO::FETCH_COLUMN);

  

// Server-side validation and form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = htmlspecialchars(trim($_POST['patient_name']));
    $age = intval($_POST['age']);
    $department = htmlspecialchars(trim($_POST['department']));
    $service_rating = $_POST['service_rating'];
    $staff_behavior = $_POST['staff_behavior'];
    $cleanliness = $_POST['cleanliness'];
    $comments = htmlspecialchars(trim($_POST['comments']));

    // Validate required fields
    if (empty($patient_name) || empty($age) || empty($department) || empty($service_rating) 
        || empty($staff_behavior) || empty($cleanliness)) {
        $message = "<div class='alert alert-danger'>⚠️ Please fill in all required fields!</div>";
    } elseif ($age <= 0) {
        $message = "<div class='alert alert-danger'>⚠️ Age must be a positive number!</div>";
    } else {
        // Save evaluation
        if ($eval->addEvaluation($patient_name, $age, $department, $service_rating, $staff_behavior, $cleanliness, $comments)) {
            $message = "<div class='alert alert-success'>✅ Evaluation submitted successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>❌ Failed to submit evaluation. Try again.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Evaluation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow col-md-6 mx-auto">
            <h3 class="text-center mb-4">Hospital Evaluation Form</h3>

            <?= $message ?>

            <form id="evaluationForm" method="POST" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label class="form-label">Patient Name</label>
                    <input type="text" name="patient_name" id="patient_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" id="age" class="form-control" required>
                </div>

           <div class="mb-3">
    <label class="form-label">Department</label>
    <select name="department" class="form-select" required>
        <option value="">Select Department</option>
        <?php foreach($departments as $dept): ?>
            <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
        <?php endforeach; ?>
    </select>
</div>


                <div class="mb-3">
                    <label class="form-label">Service Rating</label>
                    <select name="service_rating" id="service_rating" class="form-select" required>
                        <option value="">Select</option>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Fair</option>
                        <option>Poor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Staff Behavior</label>
                    <select name="staff_behavior" id="staff_behavior" class="form-select" required>
                        <option value="">Select</option>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Fair</option>
                        <option>Poor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cleanliness</label>
                    <select name="cleanliness" id="cleanliness" class="form-select" required>
                        <option value="">Select</option>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Fair</option>
                        <option>Poor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comments</label>
                    <textarea name="comments" id="comments" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Evaluation</button>
            </form>
        </div>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

    </div>

    <script>
    function validateForm() {
        const name = document.getElementById("patient_name").value.trim();
        const age = document.getElementById("age").value.trim();
        const dept = document.getElementById("department").value.trim();
        const service = document.getElementById("service_rating").value;
        const staff = document.getElementById("staff_behavior").value;
        const clean = document.getElementById("cleanliness").value;

        if (!name || !age || !dept || !service || !staff || !clean) {
            alert("⚠️ Please fill in all required fields.");
            return false;
        }

        if (isNaN(age) || age <= 0) {
            alert("⚠️ Age must be a positive number.");
            return false;
        }

        if (name.length < 3) {
            alert("⚠️ Patient name must be at least 3 characters long.");
            return false;
        }

        return true;
    }
    </script>
</body>
</html>
