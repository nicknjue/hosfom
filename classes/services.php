<?php
class GoodsServices {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all goods/services
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM services ORDER BY service_name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
