<?php
header('Content-Type: application/json');

include_once "z_db.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'يجب تسجيل الدخول أولاً'
    ]);
    exit();
}

// Check if user has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([
        'status' => 'error', 
        'message' => 'ليست لديك صلاحية للقيام بهذا الإجراء'
    ]);
    exit();
}

// Check ID parameter
if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'معرف المدينة غير صالح'
    ]);
    exit();
}

$event_id = (int)$_POST["id"];

// Verify event exists
$check = $con->prepare("SELECT id FROM event WHERE id = ?");
$check->bind_param("i", $event_id);
$check->execute();
$check->store_result();

if ($check->num_rows == 0) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'المدينة غير موجودة'
    ]);
    exit();
}

// Delete event
$stmt = $con->prepare("DELETE FROM event WHERE id = ?");
$stmt->bind_param("i", $event_id);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'تم حذف المدينة بنجاح'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'فشل في حذف المدينة: ' . $con->error
    ]);
}

$stmt->close();
$con->close();
?>