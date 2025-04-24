<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // تسجيل مستخدم جديد
    public function register($full_name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $full_name, $email, $hash);
            return $stmt->execute();
        }
        return false;
    }

    // تسجيل الدخول
    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return null;
    }

    // جلب كل المستخدمين
    public function getAll() {
        $result = $this->conn->query("SELECT * FROM users");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // حذف مستخدم
    public function delete($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
?>
