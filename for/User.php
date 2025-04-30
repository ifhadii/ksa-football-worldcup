<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($full_name, $email, $password) {
        try {
            // Validate inputs
            if (empty($full_name) || empty($email) || empty($password)) {
                throw new Exception("جميع الحقول مطلوبة");
            }

            // Check if email already exists
            if ($this->emailExists($email)) {
                throw new Exception("البريد الإلكتروني مسجل بالفعل");
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            if (!$hash) {
                throw new Exception("خطأ في تشفير كلمة المرور");
            }

            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("خطأ في إعداد الاستعلام: " . $this->conn->error);
            }

            $stmt->bind_param("sss", $full_name, $email, $hash);
            if (!$stmt->execute()) {
                throw new Exception("خطأ في تنفيذ الاستعلام: " . $stmt->error);
            }

            return true;
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            throw $e;
        }
    }

    private function emailExists($email) {
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function login($email, $password) {
        try {
            if (empty($email) || empty($password)) {
                throw new Exception("البريد الإلكتروني وكلمة المرور مطلوبان");
            }

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("خطأ في إعداد الاستعلام: " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                throw new Exception("خطأ في تنفيذ الاستعلام: " . $stmt->error);
            }

            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if (!$user || !password_verify($password, $user['password'])) {
                throw new Exception("بيانات الدخول غير صحيحة");
            }

            return [
                'user_id' => $user['user_id'],
                'full_name' => $user['full_name'],
                'email' => $user['email'],
                'is_admin' => isset($user['is_admin']) ? (bool)$user['is_admin'] : false
            ];
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getAll() {
        try {
            $result = $this->conn->query("SELECT user_id, full_name, email, created_at FROM users");
            if (!$result) {
                throw new Exception("خطأ في جلب المستخدمين: " . $this->conn->error);
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Get users error: " . $e->getMessage());
            return [];
        }
    }

    public function delete($user_id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
            if (!$stmt) {
                throw new Exception("خطأ في إعداد الاستعلام: " . $this->conn->error);
            }
            $stmt->bind_param("i", $user_id);
            if (!$stmt->execute()) {
                throw new Exception("خطأ في حذف المستخدم: " . $stmt->error);
            }
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            error_log("Delete user error: " . $e->getMessage());
            throw $e;
        }
    }
}
?>
