<?php
header('Content-Type: application/json');

include_once "z_db.php";
session_start();

// 1. Check if user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'غير مصرح بالوصول'
    ]);
    exit();
}

// 2. Validate input
if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'معرف غير صالح'
    ]);
    exit();
}

$id = (int)$_POST["id"];
$table = isset($_POST["table"]) && in_array($_POST["table"], ['users', 'admin']) ? $_POST["table"] : null;

if (!$table) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'نوع الجدول غير صالح'
    ]);
    exit();
}

// 3. Verify record exists
$column = $table === 'users' ? 'user_id' : 'id';
$check = $con->prepare("SELECT $column FROM $table WHERE $column = ?");
$check->bind_param("i", $id);
$check->execute();
$check->store_result();

if ($check->num_rows == 0) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'السجل غير موجود'
    ]);
    exit();
}

// 4. Delete record
$stmt = $con->prepare("DELETE FROM $table WHERE $column = ?");
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

$stmt->close();
$check->close();
$con->close();
?>