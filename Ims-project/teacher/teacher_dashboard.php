<?php
//session_start();
include("../includes/header.php");
include("../database/database.php");
include("../includes/sidebar.php");

// Modified authorization check

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "teacher") {
    header("Location: ../auth/Login.php");
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
$fullname = $user['fullname'] ?? 'Teacher'; // Handle null values

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard - E-Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
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

.dash{
    padding-top: 3.5rem;
}

</style>
<body>
   

        <main class="main-content">
            
            <h1 class="dash">Teacher Dashboard</h1>
            <div class="cards-container">
                <div class="card">
                    <i class="fas fa-chalkboard"></i>
                    <h3>My Classes</h3>
                    <p>Manage your assigned classes</p>
                </div>
                <div class="card">
                    <i class="fas fa-tasks"></i>
                    <h3>Pending Assignments</h3>
                    <p>Check and grade assignments</p>
                </div>
            </div>
        </main>
    </div>
    
</body>
</html>
