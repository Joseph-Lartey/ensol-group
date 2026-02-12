<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Ensol Energy - Leading provider of renewable energy solutions, solar power systems, and energy efficiency services in Ghana.">
    <title>Ensol Energy | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">

    <!-- Google Fonts - Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Specific styles for subsidiary pages to reuse existing components */
        .subsidiary-hero {
            position: relative;
            height: 60vh;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-align: center;
            background-color: var(--dark-gray);
            overflow: hidden;
        }

        .subsidiary-hero-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }

        .subsidiary-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
            z-index: 1;
        }

        .subsidiary-hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 var(--spacing-md);
        }

        .subsidiary-hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: var(--spacing-sm);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
         .service-card {
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="logo">
                    <img src="../assets/ensol_logo.jpg" alt="Ensol Group Logo">
                </a>

                <ul class="nav-links" id="nav-links">
                    <li><a href="../index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link active">About us</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="clients.php" class="nav-link">Clients</a></li>
                    <li><a href="news.php" class="nav-link">News</a></li>
                    <li><a href="contact.php" class="nav-link btn-contact">Contact Us</a></li>
                </ul>

                <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="subsidiary-hero">
        <div class="subsidiary-hero-overlay"></div>
        <img src="../assets/ensol_energy.jpeg" alt="Ensol Energy" class="subsidiary-hero-img">
        <div class="subsidiary-hero-content animate-on-scroll">
            <h1 class="subsidiary-hero-title">Ensol Energy</h1>
            <p class="hero-description" style="color: var(--white); font-size: 1.2rem;">Powering the future with sustainable renewable energy solutions.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-group" style="padding: var(--spacing-2xl) 0;">
        <div class="container">
            <div class="about-group-content">
                <div class="about-group-text animate-on-scroll">
                    <h2 class="section-title-left">About <span class="title-accent">Ensol Energy</span></h2>
                    <p>Ensol Energy is at the forefront of the renewable energy revolution in West Africa. We design, install, and maintain solar power systems and energy efficiency solutions that help businesses and communities reduce their carbon footprint and energy costs.</p>
                    <p>Our commitment to sustainability drives us to deliver innovative energy solutions that are both localized and world-class. Whether for industrial applications or commercial projects, Ensol Energy provides reliable, clean power you can trust.</p>
                </div>
                <div class="story-image animate-on-scroll delay-2">
                    <img src="../assets/img6.jpeg" alt="Renewable Energy">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-intro" style="background-color: var(--off-white); padding: var(--spacing-2xl) 0;">
        <div class="container">
            <h2 class="section-title animate-on-scroll" style="text-align: center;">Our <span class="title-accent">Services</span></h2>
            <div class="partners-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--spacing-lg); margin-top: var(--spacing-lg); justify-content: center;">
                
                <!-- Renewable Energy Solutions -->
                <div class="service-card animate-on-scroll" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon">
                            <i class="fas fa-solar-panel"></i>
                        </div>
                    </div>
                    <h3 class="service-card-title">Renewable Energy Solutions</h3>
                    <p class="service-card-description">
                        Our renewable energy services help reduce energy costs and environmental impact by
                        delivering sustainable solar-powered alternatives.
                    </p>
                </div>

                 <!-- Energy Efficiency (Adding implied service based on description) -->
                 <div class="service-card animate-on-scroll delay-1" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                    </div>
                    <h3 class="service-card-title">Energy Efficiency Services</h3>
                    <p class="service-card-description">
                        We analyze and optimize your energy usage to implement efficiency measures that lower operational costs and improve sustainability.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Partners/Clients Section -->
    <section class="partners-logos-section" style="padding: var(--spacing-2xl) 0;">
        <div class="container">
            <h2 class="section-title animate-on-scroll" style="text-align: center; margin-bottom: var(--spacing-lg);">Our <span class="title-accent">Partners & Clients</span></h2>
            <div class="partners-logos-grid">
                <div class="partner-logo-card animate-on-scroll">
                    <img src="../assets/newmount.webp" alt="Newmont" class="partner-logo-img">
                </div>
                <div class="partner-logo-card animate-on-scroll delay-1">
                    <img src="../assets/anglogold-ashanti-logo.jpg" alt="AngloGold Ashanti" class="partner-logo-img">
                </div>
                 <div class="partner-logo-card animate-on-scroll delay-2">
                    <img src="../assets/ghana mining .png" alt="Ghana Mining" class="partner-logo-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" style="background-color: var(--jet-black); color: var(--white); padding: var(--spacing-2xl) 0;">
        <div class="container" style="text-align: center;">
            <h2 class="section-title animate-on-scroll" style="color: var(--white);">Get In <span class="title-accent">Touch</span></h2>
            <p class="animate-on-scroll width-100" style="max-width: 600px; margin: 0 auto var(--spacing-lg) auto;">
                Looking for sustainable energy solutions? Contact Ensol Energy today.
            </p>
            <a href="contact.php" class="btn btn-primary animate-on-scroll" style="background: var(--vivid-red); border: none;">Contact Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#000000" fill-opacity="1"
                    d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section footer-about animate-on-scroll">
                    <div class="footer-logo">
                        <img src="../assets/ensol_logo.jpg" alt="Ensol Group">
                        <h4 style="margin-top: 10px; color: var(--white);">Ensol Energy</h4>
                    </div>
                    <p class="footer-description">
                        Leading provider of renewable energy and solar solutions.
                    </p>
                </div>

                <div class="footer-section footer-links animate-on-scroll delay-1">
                    <h3 class="footer-title">Links</h3>
                    <ul>
                        <li><a href="about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="clients.php"><i class="fas fa-chevron-right"></i> Clients</a></li>
                        <li><a href="news.php"><i class="fas fa-chevron-right"></i> News</a></li>
                    </ul>
                </div>

                <div class="footer-section footer-contact animate-on-scroll delay-2">
                    <h3 class="footer-title">Contact us</h3>
                    <p>Ready to discuss your next project?</p>
                    <a href="tel:0302290798" class="contact-phone">
                        <i class="fas fa-phone"></i>
                        030 229 0798
                    </a>
                </div>

                <div class="footer-section footer-map animate-on-scroll delay-3">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.4085632013343!2d-0.14812382483792785!3d5.653889832657222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf83efc1100ccf%3A0x961f56daf43786df!2sEnsol%20Group%20Ltd!5e0!3m2!1sen!2sgh!4v1769617248947!5m2!1sen!2sgh"
                            width="100%" height="150" style="border:0; border-radius: 8px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                     <div class="social-links">
                        <a href="https://www.linkedin.com/company/ensolgrouptd/" target="_blank" class="social-icon" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2025 Copyright by JosephLartey. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
        <span>Top</span>
    </a>

    <!-- Scripts -->
    <script src="../script.js"></script>
</body>

</html>
