<?php
header('Content-Type: application/json');

include "z_db.php";
session_start();

// Check if user is admin
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'غير مسموح بالوصول']);
    exit();
}

// Validate input
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'معرف غير صالح']);
    exit();
}

$id = (int)$_POST['id'];

// Check if record exists
$check = mysqli_query($con, "SELECT id FROM social WHERE id = $id");
if (mysqli_num_rows($check) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'السجل غير موجود']);
    exit();
}

// Delete the record
$delete = mysqli_query($con, "DELETE FROM social WHERE id = $id");

if ($delete) {
    echo json_encode([
        'status' => 'success',
        'message' => 'تم الحذف بنجاح'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'فشل في الحذف: ' . mysqli_error($con)
    ]);
}
?>