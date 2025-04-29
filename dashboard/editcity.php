<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);
include "sidebar.php";

// Handle city card operations
if (isset($_POST["add_card"])) {
    $place_name = mysqli_real_escape_string($con, $_POST["place_name"]);
    $place_description = mysqli_real_escape_string(
        $con,
        $_POST["place_description"]
    );

    // Handle image upload
    $uploads_dir = "uploads";
    $tmp_name = $_FILES["place_image"]["tmp_name"];
    $name = basename($_FILES["place_image"]["name"]);
    $random_digit = rand(0000, 9999);
    $new_file_name = $random_digit . $name;

    if (move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name")) {
        mysqli_query(
            $con,
            "INSERT INTO city_cards (city_id, place_name, place_image, place_description) 
                          VALUES ('$todo', '$place_name', '$new_file_name', '$place_description')"
        );
    }
}

if (isset($_GET["delete_card"])) {
    $card_id = mysqli_real_escape_string($con, $_GET["delete_card"]);
    mysqli_query($con, "DELETE FROM city_cards WHERE id='$card_id'");
}
?>
<style>
    .main-content {
    margin-left: 250px; /* Adjust based on your sidebar width */
    width: calc(100% - 250px);
    padding: 20px;
}
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit city</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">city</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php
            $query = "SELECT * FROM city WHERE id='$todo'";
            $result = mysqli_query($con, $query);
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $id = "$row[id]";
                $city_title = "$row[city_title]";
                $city_desc = "$row[city_desc]";
                $city_detail = "$row[city_detail]";
            }
            ?>

            <div class="row">
                <div class="col-xxl-9">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Edit city
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK"; //initial status
                        $msg = "";
                        if (isset($_POST["save"])) {
                            $city_title = mysqli_real_escape_string(
                                $con,
                                $_POST["city_title"]
                            );
                            $city_desc = mysqli_real_escape_string(
                                $con,
                                $_POST["city_desc"]
                            );
                            $city_detail = mysqli_real_escape_string(
                                $con,
                                $_POST["city_detail"]
                            );

                            if ($status == "OK") {
                                $qb = mysqli_query(
                                    $con,
                                    "UPDATE city SET city_title='$city_title', city_desc='$city_desc', city_detail='$city_detail' WHERE id='$todo'"
                                );

                                if ($qb) {
                                    $errormsg = "
                    <div class='alert alert-success alert-dismissible fade show'>✅ تم تعديل المدينة بنجاح.<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>"; // Handle card data if city was added successfully

                                }
                            } elseif ($status !== "OK") {
                                $errormsg =
                                    "
                                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                    " .
                                    $msg .
                                    " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
                                </div>";
                            } else {
                                $errormsg = "
                                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                    Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if (
                                        $_SERVER["REQUEST_METHOD"] == "POST"
                                    ) {
                                        print $errormsg;
                                    } ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">city Title</label>
                                                    <input type="text" class="form-control" id="firstnameInput" name="city_title" value="<?php print $city_title; ?>" placeholder="Enter city Title">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Short Description</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea5" name="city_desc" rows="2"><?php print $city_desc; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">city Detail</label>
                                                    <textarea name="city_detail" class="form-control summernote"><?= $city_detail ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Update city</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- City Cards Section -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title">City Cards</h4>
                        </div>
                        <div class="card-body">
                            <!-- Add New Card Form -->
                            <form method="post" enctype="multipart/form-data" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Place Name</label>
                                            <input type="text" class="form-control" name="place_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Place Image</label>
                                            <input type="file" class="form-control" name="place_image" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="place_description" rows="1" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="add_card" class="btn btn-primary">Add Card</button>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- Existing Cards Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Place Name</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cards_query = "SELECT * FROM city_cards WHERE city_id='$todo' ORDER BY id DESC";
                                        $cards_result = mysqli_query(
                                            $con,
                                            $cards_query
                                        );
                                        $card_count = 1;

                                        while (
                                            $card = mysqli_fetch_array(
                                                $cards_result
                                            )
                                        ) {
                                            echo '<tr>
                                                <td>' .
                                                $card_count .
                                                '</td>
                                                <td>' .
                                                $card["place_name"] .
                                                '</td>
                                                <td><img src="uploads/' .
                                                $card["place_image"] .
                                                '" style="max-width: 100px;"></td>
                                                <td>' .
                                                substr(
                                                    $card["place_description"],
                                                    0,
                                                    100
                                                ) .
                                                '...</td>
                                                <td>
                                                    <a href="?id=' .
                                                $todo .
                                                "&delete_card=" .
                                                $card["id"] .
                                                '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>
                                                </td>
                                            </tr>';
                                            $card_count++;
                                        }
                                        if ($card_count == 1) {
                                            echo '<tr><td colspan="5" class="text-center">No cards added yet</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
