<?php
session_start();
include("../includes/header.php");
include("../database/database.php");

if (!isset($_GET['id'])) {
    echo "Invalid course.";
    exit;
}

$course_id = $_GET['id'];
$sql = "SELECT * FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    echo "Course not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $course['course_name']; ?> - Course Details</title>
</head>
<body>

<section>
<?php if (isset($_SESSION["message"])): ?>
    <p style="color: green;"><?php echo $_SESSION["message"]; ?></p>
    <?php unset($_SESSION["message"]); ?>
<?php endif; ?>

    <h2><?php echo $course['course_name']; ?></h2>
    <img src="../asset/image/<?php echo $course['image'] ?? 'default.jpg'; ?>" alt="<?php echo $course['course_name']; ?>" width="400px">
    <p><?php echo $course['description']; ?></p>

    <?php if (isset($_SESSION["Id"])) { ?>
        <form action="enroll.php" method="POST">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <button type="submit" class="btn">Enroll Now</button>
        </form>
    <?php } else { ?>
        <p><a href="../auth/login.php">Login</a> to enroll in this course.</p>
    <?php } ?>
</section>

</body>
</html>
<?php
include('../includes/footer.php');
?>
