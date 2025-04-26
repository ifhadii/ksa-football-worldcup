<?php include "header.php";?>

<?php
// Database configuration
$db_host = '127.0.0.1';
$db_name = 'vogue';
$db_user = 'root'; // Change to your username
$db_pass = '';     // Change to your password

// Initialize variables
$success_message = '';
$error_message = '';
$name = '';
$position = '';
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to database
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Validate required fields
        $required = ['name', 'position', 'message'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception('جميع الحقول المطلوبة يجب ملؤها');
            }
        }

        // Store form data for repopulation
        $name = $_POST['name'];
        $position = $_POST['position'];
        $message = $_POST['message'];

        // Process file upload
        $ufile = '';
        if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/testimonials/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Validate image
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $detectedType = finfo_file($fileInfo, $_FILES['ufile']['tmp_name']);
            finfo_close($fileInfo);

            if (!in_array($detectedType, $allowedTypes)) {
                throw new Exception('نوع الملف غير مسموح به (JPEG, PNG, GIF فقط)');
            }

            // Generate unique filename
            $extension = pathinfo($_FILES['ufile']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $extension;
            $destination = $uploadDir . $filename;

            if (!move_uploaded_file($_FILES['ufile']['tmp_name'], $destination)) {
                throw new Exception('فشل تحميل الملف');
            }
            $ufile = $filename;
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO testimony (name, position, message, ufile) VALUES (:name, :position, :message, :ufile)");
        $stmt->execute([
            ':name' => $name,
            ':position' => $position,
            ':message' => $message,
            ':ufile' => $ufile
        ]);

        $success_message = 'تم إرسال الشهادة بنجاح! شكراً لمشاركتك.';
        // Clear form fields after successful submission
        $name = $position = $message = '';
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        // If there was a file uploaded but DB insert failed, delete the file
        if (!empty($ufile) && file_exists($uploadDir . $ufile)) {
            unlink($uploadDir . $ufile);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج إضافة شهادة</title>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 15px;
        }
        .form-container {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        .form-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        .submit-btn {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background-color: #2980b9;
        }
        .required:after {
            content: " *";
            color: red;
        }
        .error {
            color: red;
            margin: 15px 0;
            text-align: center;
        }
        .success {
            color: green;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body style="background-color: rgb(16 36 18)">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">نموذج إضافة شهادة جديدة</h2>
            
            <?php if ($success_message): ?>
                <div class="success"><?= $success_message ?></div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="error"><?= $error_message ?></div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="required">الاسم الكامل</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="position" class="required">المنصب/الوظيفة</label>
                    <input type="text" id="position" name="position" value="<?= htmlspecialchars($position) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="message" class="required">نص الشهادة</label>
                    <textarea id="message" name="message" maxlength="300" required><?= htmlspecialchars($message) ?></textarea>
                    <small>الحد الأقصى 300 حرف</small>
                </div>
                
                <div class="form-group">
                    <label for="ufile">صورة شخصية</label>
                    <input type="file" id="ufile" name="ufile" accept="image/*">
                    <small>اختياري - يفضل صورة مربعة</small>
                </div>
                
                <button type="submit" class="submit-btn">إرسال الشهادة</button>
            </form>
        </div>
    </div>

<?php include "footer.php"; ?>
</body>
</html>