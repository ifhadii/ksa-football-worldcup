<?php 
include "header.php"; 
include "sidebar.php"; 

// Initialize variables
$errormsg = "";
$status = "OK";
$msg = "";
$city_id = 0;
?>

<!-- CSS Styles -->
<style>
.summernote {
  direction: rtl !important;
  text-align: right !important;
}
.note-editable {
  direction: rtl !important;
  text-align: right !important;
}
.card-container {
  border: 1px solid #eee;
  padding: 15px;
  margin-bottom: 15px;
  border-radius: 5px;
}
.section-title {
  margin-top: 20px;
  margin-bottom: 15px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">إضافة مدينة</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">المدن</a></li>
                                <li class="breadcrumb-item active">إضافة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['save'])) {
                // Handle city data
                $city_title = mysqli_real_escape_string($con, $_POST['city_title']);
                $city_desc = mysqli_real_escape_string($con, $_POST['city_desc']);

                // Validation
                if (strlen($city_title) < 5) {
                    $msg .= "🛑 عنوان المدينة يجب أن يكون أكثر من 5 أحرف.<br>";
                    $status = "NOTOK";
                }
                if (strlen($city_desc) > 190) {
                    $msg .= "🛑 الوصف المختصر يجب أن لا يتجاوز 190 حرفًا.<br>";
                    $status = "NOTOK";
                }

                if ($status == "OK") {
                    // Insert city data
                    $qb = mysqli_query($con, "INSERT INTO city (city_title, city_desc) VALUES ('$city_title', '$city_desc')");
                    
                    if ($qb) {
                        $city_id = mysqli_insert_id($con);
                        $errormsg = "<div class='alert alert-success alert-dismissible fade show'>✅ تم إضافة المدينة بنجاح.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                        
                        // Handle place cards
                        if (isset($_POST['place_name']) && is_array($_POST['place_name'])) {
                            foreach ($_POST['place_name'] as $index => $place_name) {
                                if (!empty($place_name)) {
                                    $place_name = mysqli_real_escape_string($con, $place_name);
                                    $place_description = mysqli_real_escape_string($con, $_POST['place_description'][$index]);
                                    
                                    // Handle place image upload
                                    $place_image = '';
                                    if (!empty($_FILES["place_image"]["tmp_name"][$index])) {
                                        $uploads_dir = 'uploads/places';
                                        if (!is_dir($uploads_dir)) {
                                            mkdir($uploads_dir, 0777, true);
                                        }
                                        $tmp_name = $_FILES["place_image"]["tmp_name"][$index];
                                        $name = basename($_FILES["place_image"]["name"][$index]);
                                        $random_digit = rand(0000, 9999);
                                        $place_image = $random_digit . $name;
                                        if (!move_uploaded_file($tmp_name, "$uploads_dir/$place_image")) {
                                            $place_image = '';
                                        }
                                    }
                                    
                                    // Insert place data
                                    $place_query = "INSERT INTO city_cards (city_id, place_name, place_description, place_image) 
                                                  VALUES ('$city_id', '$place_name', '$place_description', '$place_image')";
                                    mysqli_query($con, $place_query);
                                }
                            }
                        }
                        
                        // Handle hotel cards
                        if (isset($_POST['hotel_name']) && is_array($_POST['hotel_name'])) {
                            foreach ($_POST['hotel_name'] as $index => $hotel_name) {
                                if (!empty($hotel_name)) {
                                    $hotel_name = mysqli_real_escape_string($con, $hotel_name);
                                    $hotel_description = mysqli_real_escape_string($con, $_POST['hotel_description'][$index]);
                                    
                                    // Handle hotel image upload
                                    $hotel_image = '';
                                    if (!empty($_FILES["hotel_image"]["tmp_name"][$index])) {
                                        $uploads_dir = 'uploads/hotels';
                                        if (!is_dir($uploads_dir)) {
                                            mkdir($uploads_dir, 0777, true);
                                        }
                                        $tmp_name = $_FILES["hotel_image"]["tmp_name"][$index];
                                        $name = basename($_FILES["hotel_image"]["name"][$index]);
                                        $random_digit = rand(0000, 9999);
                                        $hotel_image = $random_digit . $name;
                                        if (!move_uploaded_file($tmp_name, "$uploads_dir/$hotel_image")) {
                                            $hotel_image = '';
                                        }
                                    }
                                    
                                    // Insert hotel data
                                    $hotel_query = "INSERT INTO hotels (city_id, hotel_name, description, image) 
                                                  VALUES ('$city_id', '$hotel_name', '$hotel_description', '$hotel_image')";
                                    mysqli_query($con, $hotel_query);
                                }
                            }
                        }
                    } else {
                        $msg .= "🛑 خطأ في حفظ المدينة: " . mysqli_error($con) . "<br>";
                        $status = "NOTOK";
                    }
                }
                
                if ($status !== "OK") {
                    $errormsg = "<div class='alert alert-danger alert-dismissible fade show'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                }
            }
            ?>

            <!-- Form -->
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> إضافة مدينة
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if (isset($errormsg)) echo $errormsg; ?>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">اسم المدينة</label>
                                                    <input type="text" class="form-control" name="city_title" placeholder="أدخل اسم المدينة" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">وصف مختصر</label>
                                                    <textarea class="form-control" name="city_desc" rows="2" placeholder="وصف مختصر عن المدينة" required></textarea>
                                                </div>
                                            </div>

                                            <!-- Places Section -->
                                            <div class="col-12">
                                                <h5 class="section-title">بطاقات الأماكن السياحية</h5>
                                                <div id="places-container">
                                                    <!-- First Place Card -->
                                                    <div class="card-container">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">اسم المكان</label>
                                                                    <input type="text" class="form-control" name="place_name[]" placeholder="اسم المكان السياحي">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">وصف المكان</label>
                                                                    <textarea class="form-control" name="place_description[]" rows="2" placeholder="وصف مختصر"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">صورة المكان</label>
                                                                    <input type="file" class="form-control" name="place_image[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button type="button" class="btn btn-secondary mt-2" id="add-place">
                                                    <i class="fas fa-plus"></i> إضافة مكان آخر
                                                </button>
                                            </div>

                                            <!-- Hotels Section -->
                                            <div class="col-12">
                                                <h5 class="section-title">بطاقات الفنادق</h5>
                                                <div id="hotels-container">
                                                    <!-- First Hotel Card -->
                                                    <div class="card-container">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">اسم الفندق</label>
                                                                    <input type="text" class="form-control" name="hotel_name[]" placeholder="اسم الفندق">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">وصف الفندق</label>
                                                                    <textarea class="form-control" name="hotel_description[]" rows="2" placeholder="وصف مختصر"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">صورة الفندق</label>
                                                                    <input type="file" class="form-control" name="hotel_image[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button type="button" class="btn btn-secondary mt-2" id="add-hotel">
                                                    <i class="fas fa-plus"></i> إضافة فندق آخر
                                                </button>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">حفظ المدينة</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add Place Card
document.getElementById('add-place').addEventListener('click', function() {
    const container = document.getElementById('places-container');
    const newCard = document.createElement('div');
    newCard.className = 'card-container mt-3';
    newCard.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">اسم المكان</label>
                    <input type="text" class="form-control" name="place_name[]" placeholder="اسم المكان السياحي">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">وصف المكان</label>
                    <textarea class="form-control" name="place_description[]" rows="2" placeholder="وصف مختصر"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">صورة المكان</label>
                    <input type="file" class="form-control" name="place_image[]">
                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-card">حذف البطاقة</button>
                </div>
            </div>
        </div>
    `;
    container.appendChild(newCard);
    
    // Add event listener to the new remove button
    newCard.querySelector('.remove-card').addEventListener('click', function() {
        container.removeChild(newCard);
    });
});

// Add Hotel Card
document.getElementById('add-hotel').addEventListener('click', function() {
    const container = document.getElementById('hotels-container');
    const newCard = document.createElement('div');
    newCard.className = 'card-container mt-3';
    newCard.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">اسم الفندق</label>
                    <input type="text" class="form-control" name="hotel_name[]" placeholder="اسم الفندق">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">وصف الفندق</label>
                    <textarea class="form-control" name="hotel_description[]" rows="2" placeholder="وصف مختصر"></textarea>
                </div>
            </div>
        </div>
    `;
    container.appendChild(newCard);
    
    // Add event listener to the new remove button
    newCard.querySelector('.remove-card').addEventListener('click', function() {
        container.removeChild(newCard);
    });
});
</script>

<?php include "footer.php"; ?>