<?php
include("../includes/header.php");
include("../database/database.php");

$registrationMessage = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $role = $_POST["role"] ?? "student"; // ✅ Capture role

    if (empty($email) || empty($name) || empty($password) || empty($confirmPassword) || empty($role)) {
        $registrationMessage = "❌ All fields are required!";
    } elseif ($password !== $confirmPassword) {
        $registrationMessage = "❌ Passwords do not match!";
    } else {
        // ✅ Check for duplicate user
        $checkSql = "SELECT * FROM user WHERE fullname = ? OR email = ?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "ss", $name, $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $registrationMessage = "❌ User with this name or email already exists!";
        } else {
            // ✅ Insert user into database
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (fullname, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hash, $role);
                if (mysqli_stmt_execute($stmt)) {
                    $registrationMessage = "✅ You are now registered!";
                } else {
                    $registrationMessage = "❌ Error: " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $registrationMessage = "❌ Database error!";
            }
        }
        mysqli_stmt_close($checkStmt);
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Learning Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        body { background-color: var(--light-color); color: var(--dark-color); display: flex; justify-content: center; align-items: center; height: 115vh; }
        .register-container { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; text-align: center; }
        .register-container h2 { margin-bottom: 1rem; color: var(--primary-color); }
        .input-group { margin-bottom: 1rem; text-align: left; }
        .input-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .input-group input { width: 100%; padding: 0.8rem; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; }
        .btn { width: 100%; padding: 0.8rem; background: var(--primary-color); color: white; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; transition: background 0.3s ease; }
        .btn:hover { background: var(--secondary-color); }
        .login-link { margin-top: 1rem; font-size: 0.9rem; }
        .login-link a { color: var(--primary-color); text-decoration: none; }
        .message { margin-top: 1rem; font-size: 0.9rem; color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
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
            <input type="submit" name="register" value="Register" class="btn">
        </form>

        <!-- ✅ Registration message will be displayed here -->
        <p class="message <?php echo (strpos($registrationMessage, "❌") !== false) ? 'error' : ''; ?>">
            <?php echo $registrationMessage; ?>
        </p>

        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
