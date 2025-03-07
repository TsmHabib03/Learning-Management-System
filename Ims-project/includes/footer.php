<footer>
    <div class="footer-container">
        <div class="footer-top">
            <a href="#" class="footer-logo">TVL-LMS</a>
            <ul class="footer-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-social">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 TVL-LMS. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #4f46e5;
        --accent-color: #f59e0b;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
    }

    footer {
        background: var(--dark-color);
        color: var(--light-color);
        padding: 3rem 0;
        text-align: center;
        position: relative;
        margin-top: 4rem;
    }

    .footer-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
    }

    .footer-top {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .footer-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .footer-logo:hover {
        transform: scale(1.1);
    }

    .footer-links {
        display: flex;
        gap: 1.5rem;
        list-style: none;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 1rem;
    }

    .footer-links a {
        color: var(--light-color);
        text-decoration: none;
        font-weight: 400;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: var(--accent-color);
    }

    .footer-social {
        display: flex;
        gap: 1rem;
    }

    .social-icon {
        color: var(--light-color);
        font-size: 1.5rem;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icon:hover {
        color: var(--accent-color);
        transform: translateY(-3px);
    }

    .footer-bottom {
        font-size: 0.9rem;
        color: #cbd5e1;
    }
</style>
