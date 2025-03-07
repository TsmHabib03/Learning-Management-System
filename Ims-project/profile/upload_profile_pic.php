<?php
session_start();
include("../database/database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['upload']) && isset($_FILES['profile_pic'])) {
    $upload_dir = "uploads/";
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    // Extract file information
    $file_name = $_FILES['profile_pic']['name'];
    $file_tmp = $_FILES['profile_pic']['tmp_name'];
    $file_size = $_FILES['profile_pic']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($file_ext, $allowed_types)) {
        echo "Invalid file format. Allowed: JPG, JPEG, PNG, GIF.";
        exit();
    }

    // Ensure uploads directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Rename file to prevent duplicates
    $new_file_name = "profile_" . $user_id . "." . $file_ext;
    $target_path = $upload_dir . $new_file_name;

    // Move file to uploads folder
    if (move_uploaded_file($file_tmp, $target_path)) {
        // Update database
        $update_query = "UPDATE user SET profile_pic = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("si", $new_file_name, $user_id);

        if ($stmt->execute()) {
            header("Location: profile.php?success=Profile picture updated!");
            exit();
        } else {
            echo "Database update failed.";
        }
    } else {
        echo "Failed to upload the file.";
    }
}
?>
