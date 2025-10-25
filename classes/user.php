<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($fullname, $email, $password, $role = 'patient') {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$fullname, $email, $hashed, $role]);
    }

    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['2fa_pending'] = true;
            $_SESSION['2fa_user_email'] = $row['email'];
            $_SESSION['user_fullname'] = $row['fullname'];
            $_SESSION['2fa_user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'] ?? 'patient';
            $_SESSION['phone'] = $row['phone'] ?? '';
            $_SESSION['address'] = $row['address'] ?? '';
            return true;
        }
        return false;
    }

    public function updateUser($user_id, $fullname, $email, $password = null, $phone = null, $address = null, $role = null) {
        if ($password) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET fullname = ?, email = ?, password = ?, phone = ?, address = ?, role = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$fullname, $email, $hashed, $phone, $address, $role, $user_id]);
        } else {
            $sql = "UPDATE users SET fullname = ?, email = ?, phone = ?, address = ?, role = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$fullname, $email, $phone, $address, $role, $user_id]);
        }
    }

    public function getAllUsers() {
        $stmt = $this->conn->query("SELECT * FROM users ORDER BY user_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
