<?php
$target_dir = "../uploads/services/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
    $newName = uniqid() . "." . $ext;
    $target_file = $target_dir . $newName;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo $target_file; // هذا سيتم إدراجه مباشرة في <img src="">
    } else {
        http_response_code(500);
        echo "Error uploading image.";
    }
}
?>
