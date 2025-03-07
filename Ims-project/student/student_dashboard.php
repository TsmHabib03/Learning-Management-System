<?php
//session_start();
include("../includes/header.php");
include("../database/database.php");
include("../includes/sidebar.php");

// Ensure user is logged in and is a student
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "student") {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION["user_id"]; // Correct session variable

// Fetch user details
$sql_user = "SELECT fullname FROM user WHERE Id = ?";  // Ensure 'Id' exists in 'user' table
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$fullname = $user['fullname'] ?? 'Learner'; // Handle null values

// Fetch enrolled courses
$sql_courses = "SELECT courses.course_name FROM enrollments 
                INNER JOIN courses ON enrollments.course_id = courses.course_id 
                WHERE enrollments.user_id = ?";  // FIXED: Use the correct column name from `enrollments`
$stmt_courses = $conn->prepare($sql_courses);
$stmt_courses->bind_param("i", $user_id);
$stmt_courses->execute();
$result_courses = $stmt_courses->get_result();
$enrolled_courses = $result_courses->fetch_all(MYSQLI_ASSOC);
$total_courses = count($enrolled_courses);

// Fetch assignments count
$sql_assignments = "SELECT COUNT(*) AS total FROM assignments WHERE user_id = ?";  // Use correct column name
$stmt_assignments = $conn->prepare($sql_assignments);
$stmt_assignments->bind_param("i", $user_id);
$stmt_assignments->execute();
$result_assignments = $stmt_assignments->get_result();
$total_assignments = $result_assignments->fetch_assoc()['total'];

// Fetch certifications count
$sql_certifications = "SELECT COUNT(*) AS total FROM certifications WHERE user_id = ?";  // Use correct column name
$stmt_certifications = $conn->prepare($sql_certifications);
$stmt_certifications->bind_param("i", $user_id);
$stmt_certifications->execute();
$result_certifications = $stmt_certifications->get_result();
$total_certifications = $result_certifications->fetch_assoc()['total'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - E-Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/style.css">
</head>
<style>
    .main-content {
            margin-left: 280px;
            padding: 2rem 3rem;
            flex: 1;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.6) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 2.5rem;
            background: linear-gradient(45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
        }

        .card h3 {
            font-size: 1.4rem;
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 80%;
            }

            .main-content {
                margin-left: 0;
                padding: 2rem 1.5rem;
            }

            .cards-container {
                grid-template-columns: 1fr;
            }
        }
        .dashboard-header{
            padding-top: 3.5rem;
        }




    </style>
<body>
    <div class="dashboard-container">
        <main class="main-content">
            <h1 class="dashboard-header">Dashboard Overview</h1>
            <div class="cards-container">
                <div class="card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Enrolled Courses</h3>
                    <p><?php echo $total_courses; ?> Active Courses</p>
                </div>
                <div class="card">
                    <i class="fas fa-tasks"></i>
                    <h3>Assignments</h3>
                    <p><?php echo $total_assignments; ?> Pending Tasks</p>
                </div>
                <div class="card">
                    <i class="fas fa-calendar"></i>
                    <h3>Schedule</h3>
                    <p>Upcoming Events</p>
                </div>
                <div class="card">
                    <i class="fas fa-certificate"></i>
                    <h3>Certifications</h3>
                    <p><?php echo $total_certifications; ?> Achievements</p>
                </div>
                <div class="card">
                    <i class="fas fa-book"></i>
                    <h3>My Courses</h3>
                    <ul>
                        <?php if ($total_courses > 0): ?>
                            <?php foreach ($enrolled_courses as $course): ?>
                                <li><?php echo htmlspecialchars($course['course_name']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No courses enrolled.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


<?php
//include("../includes/footer.php");
?>
