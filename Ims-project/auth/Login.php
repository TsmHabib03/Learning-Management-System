<?php
//session_start(); // Start the session
include("../includes/header.php");  // Fixed path
include("../database/database.php"); // Fixed path

$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; 
    $role = $_POST["role"];

    // ✅ Ensure database connection exists
    if (!isset($conn)) {
        die("Database connection error! Please check database.php.");
    }

    // Prepare SQL query
    $sql = "SELECT id, password, role, fullname FROM user WHERE email = ? AND role = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $role);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id, $hashed_password, $user_role, $fullname);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $hashed_password)) {
                // Store user info in session
                $_SESSION["user_id"] = $id;
                $_SESSION["email"] = $email;
                $_SESSION["name"] = $fullname;
                $_SESSION["role"] = $user_role;

                // Redirect based on role
                if ($user_role == "student") {
                        header("Location: ../student/student_dashboard.php");
                }
                 elseif ($user_role == "teacher") {
                    header("Location: ../teacher/teacher_dashboard.php");
                } else {
                    header("Location: ../admin/admin_dashboard.php");
                }
                exit;
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "Email or role mismatch!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Database error!";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - E-Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #4f46e5;
            --accent-color: #f59e0b;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
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
        body { background-color: var(--light-color); color: var(--dark-color); display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; text-align: center; }
        .login-container h2 { margin-bottom: 1rem; color: var(--primary-color); }
        .input-group { margin-bottom: 1rem; text-align: left; }
        .input-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .input-group input { width: 100%; padding: 0.8rem; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; }
        .btn { width: 100%; padding: 0.8rem; background: var(--primary-color); color: white; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; transition: background 0.3s ease; }
        .btn:hover { background: var(--secondary-color); }
        .register-link { margin-top: 1rem; font-size: 0.9rem; }
        .register-link a { color: var(--primary-color); text-decoration: none; }
    </style>
    </header>
    <div class="login-container">
    <h2>Login</h2>
    <form method="POST">
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn">Login</button>
    </form>
    <p style="color: red;"><?php echo $error ?? ''; ?></p> <!-- ✅ Show errors -->
    <p class="register-link">Don't have an account? <a href="../auth/register.php">Register here</a></p>
</div>

</body>
</html>
