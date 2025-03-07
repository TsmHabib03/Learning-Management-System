<?php
//session_start();
include('../includes/header.php');
include("../database/database.php");
include("../includes/sidebar.php");

// Modified authorization check
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../auth/Login.php");
    exit;
}

// Rest of your admin dashboard code...


// ✅ Fetch admin name from session
$admin_name = $_SESSION["name"] ?? "Administrator";
//
// ✅ Ensure database connection exists
if (!$conn) {
    die("Database connection error! Please check database.php.");
}

// ✅ Get total users and subjects
$totalUsers = $totalCourses = 0;

$sql = "SELECT 
        (SELECT COUNT(*) FROM user) AS users,
        (SELECT COUNT(*) FROM courses) AS courses";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalUsers = $row["users"];
    $totalCourses = $row["courses"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - E-Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        .dashboard-header {
            padding-top: 3.5rem;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <h1 class="dashboard-header">Admin Dashboard</h1>
        <div class="cards-container">
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Total Users</h3>
                <p><?php echo $totalUsers; ?> registered users</p>
            </div>
            <div class="card">
                <i class="fas fa-book"></i>
                <h3>Total Courses</h3>
                <p><?php echo $totalCourses; ?> available Courses</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-bar"></i>
                <h3>View Reports</h3>
                <p>Check user activity and performance</p>
            </div>
            <div class="card">
                <i class="fas fa-cog"></i>
                <h3>System Settings</h3>
                <p>Manage site configurations</p>
            </div>
        </div>
    </main>
</body>
</html>

