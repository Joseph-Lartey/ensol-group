<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Ensol Energy - Leading provider of integrated engineering, logistics, and supply chain solutions to the extractive and infrastructure sectors.">
    <title>Ensol Energy - Integrated Solutions | Ensol Group</title>
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
    <link rel="stylesheet" href="styles.css?v=3">
    <style>
        /* Specific styles for subsidiary pages */
        :root {
            --ensol-primary: #e31e24;
            --ensol-dark: #1a1a1a;
            --text-gray: #4a4a4a;
            --light-bg: #f8f9fa;
        }

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
            max-width: 900px;
            padding: 0 var(--spacing-md);
        }

        .subsidiary-hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: var(--spacing-sm);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        /* Section Styling */
        .section-padding {
            padding: var(--spacing-2xl) 0;
        }

        .bg-light {
            background-color: var(--light-bg);
        }

        .text-center {
            text-align: center;
        }

        .content-block {
            margin-bottom: var(--spacing-lg);
        }

        .list-check ul {
            list-style: none;
            padding: 0;
        }

        .list-check ul li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
        }

        .list-check ul li::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--vivid-red);
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .service-item {
            background: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .service-icon-large {
            font-size: 2.5rem;
            color: var(--vivid-red);
            margin-bottom: var(--spacing-md);
        }

        /* Gallery Slider */
        .gallery-section {
            position: relative;
            overflow: hidden;
            background: var(--dark-gray);
        }

        .gallery-container {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
        }

        .gallery-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
        }

        .gallery-slide.active {
            opacity: 1;
        }
        
        .gallery-content {
            position: absolute;
            bottom: 50px;
            left: 50px;
            z-index: 10;
            color: white;
            padding: 20px;
            background: rgba(0,0,0,0.5);
            border-left: 5px solid var(--vivid-red);
            max-width: 600px;
        }

        /* Values Grid */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
        }

        .value-card {
            text-align: center;
            padding: var(--spacing-lg);
            background: var(--white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            border-bottom: 4px solid transparent;
            transition: border-color 0.3s;
        }

        .value-card:hover {
            border-bottom-color: var(--vivid-red);
        }

        .value-icon {
            font-size: 2rem;
            color: var(--vivid-red);
            margin-bottom: var(--spacing-md);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gallery-container {
                height: 400px;
            }
            .subsidiary-hero-title {
                font-size: 2.5rem;
            }
            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Banner -->
    <section class="subsidiary-hero">
        <div class="subsidiary-hero-overlay"></div>
        <img src="assets/ensol_energy.jpeg" alt="Ensol Energy" class="subsidiary-hero-img">
        <div class="subsidiary-hero-content animate-on-scroll">
            <h1 class="subsidiary-hero-title">Ensol Energy</h1>
            <p class="hero-description" style="color: var(--white); font-size: 1.2rem;">Integrated Engineering, Logistics & Supply Chain Solutions</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="section-padding">
        <div class="container">
            <div class="about-group-content">
                <div class="about-group-text animate-on-scroll">
                    <h2 class="section-title-left">About <span class="title-accent">Ensol Energy</span></h2>
                    <p>Ensol Energy is a 100% indigenous Ghanaian company delivering integrated engineering, logistics, and supply chain solutions to the extractive and infrastructure sectors. In partnership with major global OEMs, we provide specialized manpower and tailored distribution services across the Oil & Gas, Energy, and Mining industries. We prioritize precision and reliability, ensuring our clients get exactly what they need, when and where they need it.</p>
                    
                    <div class="content-block" style="margin-top: 20px;">
                        <h3>Why Choose Us?</h3>
                        <div class="list-check">
                            <ul>
                                <li>A Dedicated, Experienced (100%) Ghanaian Team.</li>
                                <li>Well-equipped Office In Accra & Takoradi.</li>
                                <li>Well-resourced Storage Facility In Takoradi (Apowa).</li>
                                <li>Highly Networked Partners And Suppliers Globally.</li>
                                <li>A Management That Is Committed To Quality & Efficiency.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="story-image animate-on-scroll delay-2">
                    <img src="assets/img6.jpeg" alt="Ensol Energy Operations">
                </div>
            </div>
            
            <!-- Vision & Mission -->
             <div class="services-grid" style="margin-top: 40px;">
                <div class="service-item animate-on-scroll" style="background: var(--light-bg);">
                   <h3 style="color: var(--vivid-red);">Vision Statement</h3>
                   <p>To be a global player in the energy and extractive industries with a focus on integrated solutions.</p>
                </div>
                <div class="service-item animate-on-scroll delay-1" style="background: var(--light-bg);">
                    <h3 style="color: var(--vivid-red);">Mission Statement</h3>
                    <p>To provide world-class engineering and logistics solutions to organizations across the energy and extractive value chain.</p>
                 </div>
             </div>

        </div>
    </section>

    <!-- Core Values Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Our <span class="title-accent">Core Values</span></h2>
            <p class="text-center" style="max-width: 800px; margin: 0 auto 40px auto;">We hold in high esteem our core values of Commitment to Safety & Quality, Partnership, Integrity, and Trust (CQ PIT).</p>
            
            <div class="values-grid">
                <div class="value-card animate-on-scroll">
                    <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4>Commitment to Safety & Quality</h4>
                    <p>We prioritize safety and quality in our operations.</p>
                </div>
                <div class="value-card animate-on-scroll delay-1">
                    <div class="value-icon"><i class="fas fa-handshake"></i></div>
                    <h4>Partnership</h4>
                    <p>To effectively consolidate resources via strategic and fair partnerships to deliver world-class service.</p>
                </div>
                <div class="value-card animate-on-scroll delay-2">
                     <div class="value-icon"><i class="fas fa-balance-scale"></i></div>
                    <h4>Integrity</h4>
                    <p>We believe in carrying out all our dealings and transactions with utmost transparency.</p>
                </div>
                <div class="value-card animate-on-scroll delay-3">
                     <div class="value-icon"><i class="fas fa-users"></i></div>
                    <h4>Trust</h4>
                    <p>To trust in our team because teamwork is essential in the success of every business.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Our <span class="title-accent">Services</span></h2>
            
            <div class="services-grid">
                <!-- Chemical Management -->
                <div class="service-item animate-on-scroll">
                    <div class="service-icon-large"><i class="fas fa-flask"></i></div>
                    <h3>Chemical Management</h3>
                    <p>Supply and management of commodity chemicals for offshore production and mining. Includes chemical blending and lubricant services backed by global technical partnerships.</p>
                </div>

                <!-- Filtration -->
                <div class="service-item animate-on-scroll delay-1">
                     <div class="service-icon-large"><i class="fas fa-filter"></i></div>
                    <h3>Filtration</h3>
                    <p>Expert fluid filtration (chemicals to lubricants) improving product cleanliness to industry standards (e.g., SAE AS4059) using ultramodern equipment.</p>
                </div>

                <!-- Blending -->
                <div class="service-item animate-on-scroll delay-2">
                     <div class="service-icon-large"><i class="fas fa-blender"></i></div>
                    <h3>Blending</h3>
                    <p>State-of-the-art 15-ton plant blending solvent chemicals (Caustic Soda, HCl, Citric Acid, MEG) to precise client concentrations for the West African region.</p>
                </div>

                <!-- Asset Integrity Services -->
                <div class="service-item animate-on-scroll">
                     <div class="service-icon-large"><i class="fas fa-tools"></i></div>
                    <h3>Asset Integrity Services</h3>
                    <p>Optimizing asset performance and safety through inspection, topside repairs, pipe repairs, tank repairs, and coating services.</p>
                </div>

                <!-- Warehousing -->
                <div class="service-item animate-on-scroll delay-1">
                     <div class="service-icon-large"><i class="fas fa-warehouse"></i></div>
                    <h3>Warehousing</h3>
                    <p>International standard storage including a 6x1086sqm Takoradi facility with 10,000sqm yard, plus committed chemical and lubricant warehouses.</p>
                </div>

                 <!-- Equipment Rental -->
                 <div class="service-item animate-on-scroll delay-2">
                    <div class="service-icon-large"><i class="fas fa-truck-loading"></i></div>
                   <h3>Equipment Rental</h3>
                   <p>Rental of specialized equipment including pneumatic pumps, filtration skids, and forklifts (3-ton) to support your operations.</p>
               </div>
            </div>
        </div>
    </section>

    <!-- Interactive Gallery Slider -->
    <section class="gallery-section">
        <div class="gallery-container" id="gallery-slider">
            <div class="gallery-slide active" style="background-image: url('assets/ensolgallaryimg1.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg2.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg3.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg4.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg5.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg6.jpg');"></div>
            <div class="gallery-slide" style="background-image: url('assets/ensolgallaryimg7.jpg');"></div>
            
            <div class="subsidiary-hero-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 40%); pointer-events: none;"></div>

            <div class="gallery-content">
                <h3>Our Operations Gallery</h3>
                <p>A glimpse into our state-of-the-art facilities and operations.</p>
            </div>
        </div>
    </section>

    <!-- Experience & Projects Section -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Proven <span class="title-accent">Experience</span></h2>
             
            <div class="content-block animate-on-scroll">
                <h4>Methanol Decanting (Offshore & Onshore)</h4>
                <p>Ensol Energy is the first indigenous Ghanaian company to successfully decant Methanol for Tullow Oil Ghana Limited. Our highly skilled team ensures all jobs are carried out without accidents, specializing in transfers from ISO Tanks to supply vessel methanol tanks, ISO Tanks to ISO Tanks, and ISO Tanks to Tote tanks, all under strict industry practice.</p>
            </div>

            <div class="content-block animate-on-scroll">
                <h4>Chemical Management</h4>
                <p>We offer chemical storage and handling for Oil & Gas and Mining industries. We supply chemicals such as Hydrochloric Acid, Sodium Hydroxide, Sodium Hypochlorite, Citric Acid, MEG, and TEG using state-of-the-art technology to meet quality assurance standards.</p>
            </div>

            <div class="content-block animate-on-scroll">
                <h4>Lubricants Storage and Handling</h4>
                <p>Ensol Energy has a 4,000sqm capacity warehouse for the storage of industrial lubricants used by widespread industries.</p>
            </div>
            
            <div class="content-block animate-on-scroll">
                <h4>Key Clients & Projects</h4>
                <p>We have provided services for major clients and assets including:</p>
                <div class="list-check">
                    <ul>
                        <li>Tullow Ghana (Chemical and Lubricant supply)</li>
                        <li>FPSO KNK</li>
                        <li>FPSO JEAM</li>
                        <li>FPSO JAK</li>
                        <li>MAERSK Venturer</li>
                    </ul>
                </div>
            </div>
            
            <div class="content-block animate-on-scroll" style="margin-top: 30px; background: var(--light-bg); padding: 20px; border-radius: 8px;">
                <h4 style="color: var(--vivid-red);">Social Investment</h4>
                <p>Ensol Energy is committed and determined to support STEM Education in its operational areas. In 2023, 100 science Books were donated to St. Mary Boys Senior High School and Ahantaman Girls High School in Sekondi-Takoradi Municipality.</p>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="section-title animate-on-scroll">Our <span class="title-accent">Certifications</span></h2>
            <p class="animate-on-scroll" style="max-width: 800px; margin: 0 auto var(--spacing-lg) auto;">
                Ensol Energy Ghana Limited is committed to delivering excellent and world-class service while employing the best safety standards, protecting the environment, and meeting customer requirements.
            </p>
            <div class="values-grid" style="justify-content: center;">
                 <div class="value-card animate-on-scroll">
                    <i class="fas fa-certificate fa-3x" style="color: #4CAF50; margin-bottom: 15px;"></i>
                    <h4>ISO 45001:2018</h4>
                    <p>Occupational Health & Safety Management System</p>
                </div>
                <div class="value-card animate-on-scroll delay-1">
                    <i class="fas fa-globe-americas fa-3x" style="color: #2196F3; margin-bottom: 15px;"></i>
                    <h4>ISO 14001:2015</h4>
                    <p>Environmental Management System</p>
                </div>
                <div class="value-card animate-on-scroll delay-2">
                    <i class="fas fa-award fa-3x" style="color: #FFC107; margin-bottom: 15px;"></i>
                    <h4>ISO 9001:2015</h4>
                    <p>Quality Management System</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" style="background-color: var(--jet-black); color: var(--white); padding: var(--spacing-2xl) 0;">
        <div class="container" style="text-align: center;">
            <h2 class="section-title animate-on-scroll" style="color: var(--white);">Get In <span class="title-accent">Touch</span></h2>
            <p class="animate-on-scroll width-100" style="max-width: 600px; margin: 0 auto var(--spacing-lg) auto;">
                <strong>Accra Office:</strong> Hse/No. E3, Nii Osae Ntiful Avenue, East Legon, Accra<br>
                <strong>Phone:</strong> +233-302 263 119 | +233-242 219 407<br>
                <strong>Email:</strong> info@ensolenergy.com
            </p>
            <a href="https://ensolgroup.com.gh/pages/contact.php" class="btn btn-primary animate-on-scroll" style="background: var(--vivid-red); border: none;">Contact Us</a>
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
                        <img src="assets/ensol_logo.jpg" alt="Ensol Group">
                        <h4 style="margin-top: 10px; color: var(--white);">Ensol Energy</h4>
                    </div>
                    <p class="footer-description">
                        Leading provider of renewable energy and integrated solutions.
                    </p>
                </div>

                <div class="footer-section footer-links animate-on-scroll delay-1">
                    <h3 class="footer-title">Links</h3>
                    <ul>
                        <li><a href="https://ensolgroup.com.gh/pages/about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="https://ensolgroup.com.gh/pages/services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="https://ensolgroup.com.gh/pages/clients.php"><i class="fas fa-chevron-right"></i> Clients</a></li>
                        <li><a href="https://ensolgroup.com.gh/pages/news.php"><i class="fas fa-chevron-right"></i> News</a></li>
                    </ul>
                </div>

                <div class="footer-section footer-contact animate-on-scroll delay-2">
                    <h3 class="footer-title">Contact us</h3>
                    <p>Ready to discuss your next project?</p>
                    <a href="tel:+233302263119" class="contact-phone">
                        <i class="fas fa-phone"></i>
                        +233 302 263 119
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
    <script src="script.js?v=3"></script>
    <script>
        // Gallery Slider Script
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.gallery-slide');
            const totalSlides = slides.length;
            let currentSlide = 0;
            const slideInterval = 5000;

            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % totalSlides;
                slides[currentSlide].classList.add('active');
            }

            if (totalSlides > 1) {
                setInterval(nextSlide, slideInterval);
            }
        });
    </script>
</body>

</html>
