<?php
//session_start();
include("includes/header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Management System</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="asset/css/style.css">
    
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

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
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
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(45deg, rgba(37, 99, 235, 0.9), rgba(79, 70, 229, 0.9)), 
            url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); no-repeat center center / cover;
            color: white;
            margin-top: 70px;
        }

        .hero h2 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h2 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
   


<main>
    <section class="hero">
        <div class="hero-content">
            <h2>Empower Your Technical Skills</h2>
            <p>Master vocational skills with industry-standard training and real-world projects.</p>
            <a href="auth/Register.php" class="btn">Start Learning Now</a>
        </div>
    </section>
</main>



</body>
</html>
<?php include("includes/footer.php"); ?>