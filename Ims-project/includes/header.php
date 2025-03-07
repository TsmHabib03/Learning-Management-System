<?php
session_start();

$base_url = "http://localhost/Ims-project"; // Change this to match your domain
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning Management System</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #4f46e5;
            --accent-color: #f59e0b;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            scroll-behavior: smooth;
        }

        /* Animated Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            color: var(--primary-color);
            font-size: 1.7rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Learning Management System</a>
            <nav>
                <ul class="nav-links">
                <li><a href="<?= $base_url ?>/index.php">Home</a></li>
                  <li><a href="<?= $base_url ?>/courses/courses.php">Courses</a></li>

                    <?php
                    if (isset($_SESSION['user_id'])) {
                        if ($_SESSION['role'] === 'student') {
                            echo '<li><a href="../student/student_dashboard.php">Dashboard</a></li>';
                        } elseif ($_SESSION['role'] === 'teacher') {
                            echo '<li><a href="../teacher/teacher_dashboard.php">Dashboard</a></li>';
                        } elseif ($_SESSION['role'] === 'admin') {
                            echo '<li><a href="../admin/admin_dashboard.php">Dashboard</a></li>';
                        }
                      
                    }
                     
                    ?>
                     <li><a href="<?= $base_url ?>/auth/Login.php">Login</a></li>
                     <li><a href="<?= $base_url ?>/auth/Register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
