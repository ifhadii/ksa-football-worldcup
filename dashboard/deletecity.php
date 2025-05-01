<?php
header('Content-Type: application/json');

include_once "z_db.php";
session_start();

// 1. Check if user is logged in (corrected logic)
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'يجب تسجيل الدخول أولاً'
    ]);
    exit();
}

// 2. Check if user has admin privileges
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([
        'status' => 'error', 
        'message' => 'ليست لديك صلاحية إدارية لهذا الإجراء'
    ]);
    exit();
}

// 3. Validate city ID parameter
if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'معرف المدينة غير صالح'
    ]);
    exit();
}

$city_id = (int)$_POST["id"];

// 4. Verify city exists
$check = $con->prepare("SELECT id FROM city WHERE id = ?");
$check->bind_param("i", $city_id);
$check->execute();
$check->store_result();

if ($check->num_rows == 0) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'المدينة غير موجودة'
    ]);
    exit();
}

// 5. Delete city (only reaches here if all checks pass)
$stmt = $con->prepare("DELETE FROM city WHERE id = ?");
$stmt->bind_param("i", $city_id);

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

// 6. Clean up resources
$stmt->close();
$check->close();
$con->close();
?>