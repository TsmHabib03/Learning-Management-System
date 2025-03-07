<?php
session_start();
include("../database/database.php");

if (!isset($_SESSION["Id"])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_SESSION["Id"];
    $course_id = $_POST["course_id"];

    // Check if the student is already enrolled
    $check_enrollment = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?";
    $stmt = $conn->prepare($check_enrollment);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["message"] = "You are already enrolled in this course.";
    } else {
        // Enroll the student
        $enroll_sql = "INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($enroll_sql);
        $stmt->bind_param("ii", $student_id, $course_id);
        
        if ($stmt->execute()) {
            $_SESSION["message"] = "Successfully enrolled in the course!";
        } else {
            $_SESSION["message"] = "Enrollment failed. Try again.";
        }
    }
}

// Redirect back to the course details page
header("Location: course_details.php?id=" . $course_id);
exit;
?>
