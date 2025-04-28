<?php
header('Content-Type: application/json');

include "z_db.php";
session_start();

// Check if user is NOT logged in
if (isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'غير مسموح بالوصول - يرجى تسجيل الدخول']);
    exit();
}

// Validate input
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'معرف غير صالح']);
    exit();
}

$id = (int)$_POST['id'];

try {
    // Check if record exists using prepared statement
    $check = $con->prepare("SELECT id FROM social WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'السجل غير موجود']);
        exit();
    }

    // Delete the record using prepared statement
    $stmt = $con->prepare("DELETE FROM social WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'تم الحذف بنجاح'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'فشل في الحذف: ' . $con->error
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'حدث استثناء: ' . $e->getMessage()
    ]);
}
?>