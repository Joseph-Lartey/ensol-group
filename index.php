<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Ensol Group - Powering Energy Solutions at Scale. We deliver high-quality, innovative engineering and project support services tailored to the oil, gas, and mining industries.">
    <title>Ensol Group | Powering Energy Solutions at Scale</title>
    <link rel="icon" type="image/png" href="assets/favicon.png">

    <!-- Google Fonts - Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header Navigation -->
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">
                    <img src="assets/ensol_logo.jpg" alt="Ensol Group Logo">
                </a>

                <ul class="nav-links" id="nav-links">
                    <li><a href="#home" class="nav-link active">Home</a></li>
                    <li><a href="pages/about.php" class="nav-link">About us</a></li>
                    <li><a href="pages/services.php" class="nav-link">Services</a></li>
                    <li><a href="pages/clients.php" class="nav-link">Clients</a></li>
                    <li><a href="pages/news.php" class="nav-link">News</a></li>
                    <li><a href="pages/contact.php" class="nav-link btn-contact">Contact Us</a></li>
                </ul>

                <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-background">
            <div class="hero-gradient"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="title-highlight animate-slide-up">Powering</span>
                        <span class="animate-slide-up delay-1">Energy</span><br>
                        <span class="animate-slide-up delay-2">Solutions at</span>
                        <span class="title-accent animate-slide-up delay-3">Scale</span>
                    </h1>
                    <p class="hero-description animate-fade-in delay-4">
                        We deliver high-quality, innovative engineering and project support services tailored to the
                        oil, gas, and mining industries.
                    </p>
                    <div class="hero-buttons animate-fade-in delay-5">
                        <a href="pages/clients.php" class="btn btn-primary">
                            <span>Partner With Us</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="pages/contact.php" class="btn btn-secondary">
                            <span>Contact Us</span>
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                <div class="hero-image animate-float">
                    <div class="image-container">
                        <img src="assets/heroimg.jpg" alt="Oil Rig Platform">
                        <div class="image-glow"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated particles -->
        <div class="particles" id="particles"></div>
    </section>

    <!-- Partners Section -->
    <section class="partners" id="partners">
        <div class="container">
            <div class="partners-header animate-on-scroll">
                <h2 class="section-title">Our <span class="title-accent">Subsidiaries</span></h2>
                <div class="title-underline"></div>
            </div>
            <div class="partners-grid">
                <a href="https://www.linkedin.com/company/ensolengineeringtechnologyservices/" target="_blank" class="partner-card animate-on-scroll delay-1">
                    <div class="partner-logo">
                        <img src="assets/ensol_enginerring.jpeg" alt="Ensol Engineering & Technology">
                    </div>
                    <div class="partner-overlay">
                        <span>Engineering & Technology</span>
                        <i class="fab fa-linkedin" style="margin-left: 8px;"></i>
                    </div>
                </a>
                <a href="https://energy.ensolgroup.com.gh" target="_blank" class="partner-card animate-on-scroll delay-2">
                    <div class="partner-logo">
                        <img src="assets/ensol_energy.jpeg" alt="Ensol Energy">
                    </div>
                    <div class="partner-overlay">
                        <span>Ensol Energy</span>
                        <i class="fas fa-external-link-alt" style="margin-left: 8px;"></i>
                    </div>
                </a>
                <a href="https://www.linkedin.com/company/southdeycontractingltd/" target="_blank" class="partner-card animate-on-scroll delay-3">
                    <div class="partner-logo">
                        <img src="assets/Southey_no_background.png" alt="Southey Contracting">
                    </div>
                    <div class="partner-overlay">
                        <span>Southey Contracting</span>
                        <i class="fab fa-linkedin" style="margin-left: 8px;"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Our Clients Slider Section -->
    <section class="partners-slider-section" id="our-partners-slider">
        <div class="container">
            <div class="partners-header animate-on-scroll">
                <h2 class="section-title">Our <span class="title-accent">Clients</span></h2>
                <div class="title-underline"></div>
            </div>
            <div class="slider-container">
                <div class="slider-track">
                    <!-- Partner Logos Set 1 -->
                    <div class="partner-slide">
                        <img src="assets/tullow.webp" alt="Tullow Oil">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/ghana mining .png" alt="Ghana Mining Competencies">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/modec.png" alt="MODEC">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/newmount.webp" alt="Newmont">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/anglogold-ashanti-logo.jpg" alt="AngloGold Ashanti">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/eni.png" alt="ENI Ghana">
                    </div>

                    <!-- Partner Logos Set 2 (Duplicate for Infinite Scroll) -->
                    <div class="partner-slide">
                        <img src="assets/tullow.webp" alt="Tullow Oil">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/ghana mining .png" alt="Ghana Mining Competencies">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/modec.png" alt="MODEC">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/newmount.webp" alt="Newmont">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/anglogold-ashanti-logo.jpg" alt="AngloGold Ashanti">
                    </div>
                    <div class="partner-slide">
                        <img src="assets/eni.png" alt="ENI Ghana">
                    </div>
                </div>
            </div>
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
                        <img src="assets/ensolGroup_logo_alt_nobackground.png" alt="Ensol Group">
                    </div>
                    <p class="footer-description">
                        Your trusted partner for engineering, maintenance, and energy solutions across Ghana and West
                        Africa.
                    </p>
                </div>

                <div class="footer-section footer-links animate-on-scroll delay-1">
                    <h3 class="footer-title">Links</h3>
                    <ul>
                        <li><a href="pages/about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="pages/services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="pages/clients.php"><i class="fas fa-chevron-right"></i> Clients</a></li>
                        <li><a href="pages/news.php"><i class="fas fa-chevron-right"></i> News</a></li>
                    </ul>
                </div>

                <div class="footer-section footer-contact animate-on-scroll delay-2">
                    <h3 class="footer-title">Contact us</h3>
                    <p>Ready to discuss your next project? Reach out to our team for expert solutions and reliable
                        partnerships.</p>
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
                <p>&copy; 2025 Copyright by EnsolGroup. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
        <span>Top</span>
    </a>

    <!-- Scripts -->
    <script src="script.js"></script>
</body>

</html>