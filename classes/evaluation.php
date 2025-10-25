<?php
class Evaluation {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert evaluation
    public function addEvaluation($patient_name, $age, $department, $service_rating, $staff_behavior, $cleanliness, $comments) {
        $sql = "INSERT INTO evaluations (patient_name, age, department, service_rating, staff_behavior, cleanliness, comments)
                VALUES (:patient_name, :age, :department, :service_rating, :staff_behavior, :cleanliness, :comments)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':patient_name' => $patient_name,
            ':age' => $age,
            ':department' => $department,
            ':service_rating' => $service_rating,
            ':staff_behavior' => $staff_behavior,
            ':cleanliness' => $cleanliness,
            ':comments' => $comments
        ]);
    }

    // Fetch all evaluations
    public function getAllEvaluations() {
        $stmt = $this->conn->query("SELECT * FROM evaluations ORDER BY submitted_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
