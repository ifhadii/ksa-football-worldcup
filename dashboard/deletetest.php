<?php
header('Content-Type: application/json');

// Include database connection
include "z_db.php";
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'يجب تسجيل الدخول أولاً']);
    exit();
}

// Check if user has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'ليست لديك صلاحية للقيام بهذا الإجراء']);
    exit();
}

// Validate input
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'معرف غير صالح']);
    exit();
}

if (!isset($_POST['table']) || $_POST['table'] !== 'testimony') {
    echo json_encode(['status' => 'error', 'message' => 'جدول غير صالح']);
    exit();
}

$id = (int)$_POST['id'];

try {
    // Check if testimony exists and get image filename
    $stmt = $con->prepare("SELECT ufile FROM review WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'الشهادة غير موجودة']);
        exit();
    }
    
    $testimony = $result->fetch_assoc();
    $image_file = $testimony['ufile'];
    
    // Delete the testimony record
    $delete_stmt = $con->prepare("DELETE FROM review WHERE id = ?");
    $delete_stmt->bind_param("i", $id);
    
    if ($delete_stmt->execute()) {
        // Delete the associated image file if exists
        $image_path = "../for/uploads/testimonials/" . $image_file;
        if (!empty($image_file) && file_exists($image_path) && is_file($image_path)) {
            unlink($image_path);
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'تم حذف الشهادة بنجاح'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'فشل في حذف الشهادة: ' . $con->error
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'حدث خطأ: ' . $e->getMessage()
    ]);
}
?>