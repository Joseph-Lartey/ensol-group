<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Contact Ensol Group - Get in touch with us for engineering, maintenance, and energy solutions. Fill out our contact form or reach us via email and phone.">
    <title>Contact Us | Ensol Group</title>
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
                    <li><a href="about.php" class="nav-link">About us</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="clients.php" class="nav-link">Clients</a></li>
                    <li><a href="news.php" class="nav-link">News</a></li>
                    <li><a href="contact.php" class="nav-link btn-contact active">Contact Us</a></li>
                </ul>

                <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content animate-on-scroll">
                <span class="contact-label">CONTACT US</span>
                <h1 class="contact-title">Get in touch with us</h1>
                <p class="contact-subtitle">Fill out the form below or schedule a meeting with us at your convenience.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Main Section -->
    <section class="contact-main">
        <div class="container">
            <div class="contact-grid">
                <!-- Left Side - Contact Form -->
                <div class="contact-form-wrapper animate-on-scroll">
                    <form class="contact-form" id="contact-form" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Your name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Enter Your Message" rows="4"
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            Send Your Request
                        </button>
                    </form>

                    <div class="contact-via animate-on-scroll delay-1">
                        <h4>You can also Contact Us Via</h4>
                        <div class="contact-methods">
                            <a href="mailto:info@ensolgroup.com.gh" class="contact-method">
                                <div class="contact-method-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <span>info@ensolgroup.com.gh</span>
                            </a>
                            <a href="tel:0302290798" class="contact-method">
                                <div class="contact-method-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <span>030 229 0798</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Services & Locations -->
                <div class="contact-info-wrapper">
                    <div class="services-benefits animate-on-scroll delay-1">
                        <h3>With our services you can</h3>
                        <ul class="benefits-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Improve usability of your product</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Enhance operational efficiency</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Reduce maintenance costs</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Ensure safety compliance</span>
                            </li>
                        </ul>
                    </div>

                    <div class="location-cards animate-on-scroll delay-2">
                        <a href="https://maps.app.goo.gl/mbZTGVHJhbZHgypd7" target="_blank" class="location-card">
                            <div class="location-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-details">
                                <p>Ensol Group Ltd</p>
                                <p>Nii Osae Ntiful Ave, Accra</p>
                            </div>
                        </a>
                        <a href="https://maps.app.goo.gl/gpaEZZgnYeGVKosLA" target="_blank" class="location-card">
                            <div class="location-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-details">
                                <p>Southey Contracting - Takoradi Base</p>
                                <p>V6XJ+54G, Takoradi</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="footer">
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
                    </div>
                    <p class="footer-description">
                        Your trusted partner for engineering, maintenance, and energy solutions across Ghana and West
                        Africa.
                    </p>
                </div>

                <div class="footer-section footer-links animate-on-scroll delay-1">
                    <h3 class="footer-title">Links</h3>
                    <ul>
                        <li><a href="about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="clients.php"><i class="fas fa-chevron-right"></i> Clients</a></li>
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
    <script src="../script.js"></script>
    <script>
        // Form submission with PHP email handler
        document.getElementById('contact-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = this.querySelector('.btn-submit');
            const form = this;
            const formData = new FormData(form);
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            btn.disabled = true;

            fetch('../api/send-email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
                    btn.style.background = '#28a745';
                    
                    setTimeout(() => {
                        btn.innerHTML = 'Send Your Request';
                        btn.style.background = '';
                        btn.disabled = false;
                        form.reset();
                    }, 3000);
                } else {
                    btn.innerHTML = '<i class="fas fa-times"></i> Failed. Try Again';
                    btn.style.background = '#dc3545';
                    
                    setTimeout(() => {
                        btn.innerHTML = 'Send Your Request';
                        btn.style.background = '';
                        btn.disabled = false;
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.innerHTML = '<i class="fas fa-times"></i> Failed. Try Again';
                btn.style.background = '#dc3545';
                
                setTimeout(() => {
                    btn.innerHTML = 'Send Your Request';
                    btn.style.background = '';
                    btn.disabled = false;
                }, 3000);
            });
        });
    </script>
</body>

</html>