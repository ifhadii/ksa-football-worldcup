<?php
 header('Content-Type: application/json');
 
 // Include your database connection
 include "z_db.php";
 session_start();
 
 // Check if user is admin
 if (isset($_SESSION['id'])) {
     echo json_encode(['status' => 'error', 'message' => 'غير مسموح بالوصول']);
     exit();
 }
 
 // Validate input
 if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
     echo json_encode(['status' => 'error', 'message' => 'معرف غير صالح']);
     exit();
 }
 
 $id = (int)$_POST['id'];
 $table = isset($_POST['table']) ? $_POST['table'] : '';
 
 // Validate table name
 if (!in_array($table, ['users', 'admin'])) {
     echo json_encode(['status' => 'error', 'message' => 'جدول غير صالح']);
     exit();
 }
 
 // Determine ID column based on table
 $id_column = ($table == 'users') ? 'user_id' : 'id';
 
 try {
     // Check if record exists
     $check = $con->prepare("SELECT $id_column FROM $table WHERE $id_column = ?");
     $check->bind_param("i", $id);
     $check->execute();
     $check->store_result();
 
     if ($check->num_rows == 0) {
         echo json_encode(['status' => 'error', 'message' => 'السجل غير موجود']);
         exit();
     }
 
     // Delete the record
     $stmt = $con->prepare("DELETE FROM $table WHERE $id_column = ?");
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