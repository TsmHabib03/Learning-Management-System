<?php
include("../includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses - E-Learning Management System</title>
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

        .subject-section {
            padding: 6rem 2rem 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .subject-section h2 {
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-color);
        }

        .subject-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .subject-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .subject-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .subject-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .subject-content {
            padding: 1.5rem;
        }

        .subject-content h3 {
            font-size: 1.5rem;
            margin-bottom: 0.8rem;
            color: var(--secondary-color);
        }

        .subject-content p {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <section class="subject-section">
        <h2>Explore Our Courses</h2>
        <div class="subject-grid">
            <div class="subject-card">
                <img src="../asset/image/programming.jpg" alt="TVL-Programming" class="subject-image">
                <div class="subject-content">
                    <h3>TVL - Programming</h3>
                    <p>Develop your coding skills in various programming languages and software development.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>
            
            <div class="subject-card">
                <img src="../asset/image/animation.jpg" alt="TVL-Animation" class="subject-image">
                <div class="subject-content">
                    <h3>TVL - Animation</h3>
                    <p>Explore the world of digital arts and animation, including 2D and 3D design.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>
            
            <div class="subject-card">
                <img src="../asset/image/humms.jpg" alt="HUMSS" class="subject-image">
                <div class="subject-content">
                    <h3>HUMSS</h3>
                    <p>Enhance your communication, research, and critical thinking skills in the humanities.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>

            <div class="subject-card">
                <img src="../asset/image/abm.jpg" alt="ABM" class="subject-image">
                <div class="subject-content">
                    <h3>ABM</h3>
                    <p>Learn the fundamentals of business management, marketing, and entrepreneurship.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>

            <div class="subject-card">
                <img src="../asset/image/stem.jpg" alt="STEM" class="subject-image">
                <div class="subject-content">
                    <h3>STEM</h3>
                    <p>Strengthen your knowledge in Science, Technology, Engineering, and Mathematics.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>
            
            <div class="subject-card">
                <img src="../asset/image/gas.jpg" alt="GAS" class="subject-image">
                <div class="subject-content">
                    <h3>GAS</h3>
                    <p>Gain a well-rounded education in various disciplines with the General Academic Strand.</p>
                    <a href="#" class="btn">Enroll Now</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
include("../includes/footer.php");
?>
