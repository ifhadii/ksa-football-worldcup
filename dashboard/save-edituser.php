<?php
// dashboard/save-edituser.php

include "header.php";
include "sidebar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required parameters
    $required = ['id', 'table', 'id_column'];
    foreach ($required as $field) {
        if (!isset($_POST[$field])) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "خطأ",
                    text: "بيانات ناقصة!",
                }).then(() => {
                    window.location.href = "manage_users.php";
                });
            </script>';
            exit();
        }
    }

    $id = (int)$_POST['id'];
    $table = ($_POST['table'] === 'admin') ? 'admin' : 'users';
    $id_column = $_POST['id_column'];

    // Validate and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "خطأ",
                text: "البريد الإلكتروني غير صالح!",
            }).then(() => {
                window.location.href = "manage_users.php";
            });
        </script>';
        exit();
    }

    if ($table === 'admin') {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $update_query = "UPDATE admin SET username = ?, email = ? WHERE id = ?";
    } else {
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $update_query = "UPDATE users SET full_name = ?, email = ? WHERE user_id = ?";
    }

    // Prepare and execute the update
    $stmt = mysqli_prepare($con, $update_query);
    if ($table === 'admin') {
        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $id);
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $full_name, $email, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "تم!",
                text: "تم تحديث بيانات المستخدم بنجاح",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "حسناً"
            }).then(() => {
                window.location.href = "social.php";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "خطأ",
                text: "خطأ في التحديث: ' . mysqli_error($con) . '",
            }).then(() => {
                window.location.href = "manage_users.php";
            });
        </script>';
    }
    exit();
} else {
    header("Location: social.php");
    exit();
}