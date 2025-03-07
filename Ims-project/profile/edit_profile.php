<?php
//session_start();
include("../database/database.php");
include("../includes/header.php");
//include("../includes/sidebar.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = "SELECT fullname, email FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_fullname = $_POST['fullname'];
    $new_email = $_POST['email'];

    // Update user information
    $update_query = "UPDATE user SET fullname = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $new_fullname, $new_email, $user_id);

    if ($stmt->execute()) {
        header("Location: profile.php?success=Profile updated successfully!");
        exit();
    } else {
        echo "Error updating profile.";
    }
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
    <h2>Edit Your Profile</h2>
    <form method="POST">
        <div class="input-group">
            <label for="email">Fullname:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

       
        <button type="submit" name="submit" class="btn">Change</button>
    </form>
   
</div>

</body>
</html>
