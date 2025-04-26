<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register new user
    public function register($full_name, $email, $password) {
        try {
            // Validate inputs
            if (empty($full_name) || empty($email) || empty($password)) {
                throw new Exception("جميع الحقول مطلوبة");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("البريد الإلكتروني غير صالح");
            }

            // Check if email exists
            $check_sql = "SELECT email FROM users WHERE email = ?";
            $check_stmt = $this->conn->prepare($check_sql);
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $check_stmt->store_result();
            
            if ($check_stmt->num_rows > 0) {
                throw new Exception("البريد الإلكتروني مسجل بالفعل");
            }

            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            if (!$hash) {
                throw new Exception("خطأ في تشفير كلمة المرور");
            }

            // Insert new user
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
            error_log("User registration error: " . $e->getMessage());
            throw $e; // Re-throw for handling in calling code
        }
    }

    // User login
    public function login($email, $password) {
        try {
            // Validate inputs
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
            
            if ($result->num_rows === 0) {
                throw new Exception("البريد الإلكتروني غير مسجل");
            }

            $user = $result->fetch_assoc();
            
            if (!password_verify($password, $user['password'])) {
                throw new Exception("كلمة المرور غير صحيحة");
            }

            return $user;
        } catch (Exception $e) {
            error_log("User login error: " . $e->getMessage());
            throw $e; // Re-throw for handling in calling code
        }
    }

    // Get all users
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

    // Delete user
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