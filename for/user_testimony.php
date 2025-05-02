<?php include "header.php"; ?>

<?php
// Database configuration
$db_host = '127.0.0.1';
$db_name = 'vogue';
$db_user = 'root';
$db_pass = '';

// Initialize variables with default values
$success_message = $error_message = '';
$name = $position = $message = '';
$uploadDir = 'uploads/testimonials/';

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

        // Store form data
        $name = htmlspecialchars($_POST['name']);
        $position = htmlspecialchars($_POST['position']);
        $message = htmlspecialchars($_POST['message']);
        $ufile = '';

        // Process file upload if exists
        if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
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

            // Check file size (max 2MB)
            if ($_FILES['ufile']['size'] > 2097152) {
                throw new Exception('حجم الملف كبير جداً (الحد الأقصى 2MB)');
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
        $stmt = $pdo->prepare("INSERT INTO review (name, position, message, ufile) VALUES (:name, :position, :message, :ufile)");
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
        if (!empty($ufile)) {
            @unlink($uploadDir . $ufile);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #245e3d;
            --secondary-color: #1a3e72;
            --accent-color: #d4af37;
            --light-color: #f8f9fa;
            --dark-color: #102412;
        }
        
        body {
            background-color: var(--dark-color);
            font-family: 'Tajawal', sans-serif;
            color: #333;
            padding-top: 60px;
        }

        header {
            background-color: rgb(16, 36, 18);
            color: white;
        }
        
        .form-wrapper {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(248,249,250,0.95));
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin: 30px auto;
            max-width: 700px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .form-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        .form-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
            font-size: 28px;
        }
        
        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
            display: flex;
            align-items: center;
        }
        
        .form-label .required {
            color: #dc3545;
            margin-right: 5px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
            background-color: rgba(255,255,255,0.8);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(36, 94, 61, 0.25);
            background-color: white;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #1e4f32, #153258);
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-upload-input {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            min-height: 50px;
        }
        
        .file-upload-label:hover {
            background-color: #e9ecef;
            border-color: var(--primary-color);
        }
        
        .file-upload-icon {
            font-size: 24px;
            margin-left: 10px;
            color: var(--primary-color);
        }
        
        .alert-message {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background-color: rgba(212, 237, 218, 0.9);
            color: #155724;
            border-color: #c3e6cb;
        }
        
        .alert-error {
            background-color: rgba(248, 215, 218, 0.9);
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        .char-count {
            font-size: 14px;
            color: #6c757d;
            text-align: left;
            margin-top: 5px;
        }
        
        .form-note {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
            display: block;
        }
        
        @media (max-width: 768px) {
            .form-wrapper {
                padding: 25px;
                margin: 20px 15px;
            }
            
            .form-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-wrapper">
                    <h2 class="form-title">سجل اهتمامك الآن</h2>
                    
                    <?php if (!empty($success_message)): ?>
                        <div class="alert-message alert-success"><?= $success_message ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="alert-message alert-error"><?= $error_message ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <span class="required">*</span> الاسم الكامل
                            </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="position" class="form-label">
                                <span class="required">*</span> المنصب/الوظيفة
                            </label>
                            <input type="text" class="form-control" id="position" name="position" value="<?= htmlspecialchars($position) ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">
                                <span class="required">*</span> نص الشهادة
                            </label>
                            <textarea class="form-control" id="message" name="message" maxlength="300" required><?= htmlspecialchars($message) ?></textarea>
                            <div class="char-count">الأحرف المتبقية: <span id="char-remaining"><?= 300 - strlen($message) ?></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">صورة شخصية</label>
                            <div class="file-upload">
                                <label for="ufile" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <span id="file-name">اختر صورة (JPEG, PNG, GIF)</span>
                                </label>
                                <input type="file" id="ufile" name="ufile" class="file-upload-input" accept="image/*">
                            </div>
                            <span class="form-note">اختياري - يفضل صورة مربعة بحجم لا يتجاوز 2MB</span>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> إرسال الشهادة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <script>
        // Update file name display when file is selected
        document.getElementById('ufile').addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'اختر صورة (JPEG, PNG, GIF)';
            document.getElementById('file-name').textContent = fileName;
        });
        
        // Character count for message textarea
        const messageTextarea = document.getElementById('message');
        const charRemaining = document.getElementById('char-remaining');
        
        messageTextarea.addEventListener('input', function(e) {
            const remaining = 300 - e.target.value.length;
            charRemaining.textContent = remaining;
            
            if (remaining < 50) {
                charRemaining.style.color = '#dc3545';
                charRemaining.style.fontWeight = 'bold';
            } else {
                charRemaining.style.color = '#6c757d';
                charRemaining.style.fontWeight = 'normal';
            }
        });
    </script>

<?php include "footer.php"; ?>
</body>
</html>