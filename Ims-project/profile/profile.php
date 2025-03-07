<?php
//session_start();
include("../includes/header.php");
include("../database/database.php");
include("../includes/sidebar.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$query = "SELECT fullname, email, profile_pic FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - User Profile</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            display: flex;
            min-height: 100vh;
            margin: 0;
            color: var(--text-dark);
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .profile-pic-container {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .profile-info h2 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--text-dark);
        }

        .profile-info p {
            color: var(--text-light);
            margin: 0.5rem 0 1.5rem;
        }

        .upload-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .file-upload {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            margin: 1.5rem 0;
        }

        .upload-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .upload-label:hover {
            background: var(--secondary-color);
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

        .user{
            padding-top: 3.5rem;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <div class="dashboard-header">
            <h1 class="user">User Profile</h1>
        </div>

        <div class="profile-card">
            <div class="profile-pic-container">
                <img src="uploads/<?php echo htmlspecialchars($user['profile_pic']); ?>" class="profile-pic" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                <a href="edit_profile.php" class="btn-primary">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>

        <div class="upload-section">
            <h3>Update Profile Picture</h3>
            <form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
                <div class="file-upload">
                    <label for="profile_pic" class="upload-label">
                        <i class="fas fa-cloud-upload-alt"></i> Choose File
                    </label>
                    <input type="file" id="profile_pic" name="profile_pic" class="custom-file-input" required style="display: none;">
                    <p class="file-name" style="margin-top: 1rem; color: var(--text-light);"></p>
                </div>
                <button type="submit" name="upload" class="btn-primary">
                    <i class="fas fa-upload"></i> Upload Photo
                </button>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('profile_pic').addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            document.querySelector('.file-name').textContent = `Selected file: ${fileName}`;
        });
    </script>
</body>
</html>
