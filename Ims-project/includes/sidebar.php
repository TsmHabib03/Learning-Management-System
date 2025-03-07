<?php
include("../database/database.php");



$user_id = $_SESSION["user_id"]; // Correct session variable

// Fetch user details
$sql_user = "SELECT fullname FROM user WHERE Id = ?";  // Ensure 'Id' exists in 'user' table
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$fullname = $user['fullname'] ?? 'Learner';
?>
<style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --accent-color: #7c3aed;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            
            min-height: 100vh;
           
            color: var(--text-dark);
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            padding: 1.5rem;
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100%;
        }

        
        .btn-primary {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .sidebar-nav li {
            margin: 0.5rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-nav a:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .sidebar-nav a.active {
            background: #eef2ff;
            color: var(--primary-color);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            
        }
    </style>
<aside class="sidebar">
    <br><br><br>
<h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h2>
        <nav>
            <ul class="sidebar-nav">
               <?php
                    if (isset($_SESSION['user_id'])) {
                        if ($_SESSION['role'] === 'student') {
                            echo '<li><a href="../student/student_dashboard.php" class="active"><i class="fas fa-home"></i>Dashboard</a></li>';
                        } elseif ($_SESSION['role'] === 'teacher') {
                            echo '<li><a href="../teacher/teacher_dashboard.php"class="active"><i class="fas fa-home"></i>Dashboard</a></li>';
                            
                            echo '<li><a href="teacher_classes.php"><i class="fas fa-chalkboard-teacher"></i> My Classes</a></li>';
                            echo'<li><a href="assignments.php"><i class="fas fa-tasks"></i> Assignments</a></li>';
                            echo '<li><a href="submissions.php"><i class="fas fa-file-alt"></i> Grade Submissions</a></li>';
                            echo'<li><a href="students.php"><i class="fas fa-users"></i> Student Progress</a></li>';
                            echo'<li><a href="announcements.php"><i class="fas fa-bullhorn"></i> Announcements</a></li>';
                           
                            echo '<li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>';
                           
                        } elseif ($_SESSION['role'] === 'admin') {
                            echo '<li><a href="../admin/admin_dashboard.php"class="active"><i class="fas fa-home"></i>Dashboard</a></li>';
                           
                            
                            echo '<li><a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a></li>';
                            echo '<li><a href="manage_courses.php"><i class="fas fa-book"></i> Manage Courses</a></li>';
                            echo '<li><a href="reports.php"><i class="fas fa-chart-bar"></i> Reports</a></li>';
echo '<li><a href="announcements.php"><i class="fas fa-bullhorn"></i> Announcements</a></li>';
echo '<li><a href="system_logs.php"><i class="fas fa-clipboard-list"></i> System Logs</a></li>';
echo '<li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>';








                             




                        }
                      
                    }
                    
                    ?>
                <li><a href="../profile/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </aside>