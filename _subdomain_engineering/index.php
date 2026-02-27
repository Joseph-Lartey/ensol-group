<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Ensol Engineering & Technology - Providing industrial maintenance, fabrication, welding, and equipment leasing solutions.">
    <title>Ensol Engineering | Ensol Group</title>
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
    <link rel="stylesheet" href="styles.css">
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
            /* Fallback */
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
            /* Ensure cards stretch */
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="#hero-banner" class="logo">
                    <img src="assets/ensol_enginerring.jpeg" alt="Ensol Engineering Logo">
                </a>

                <ul class="nav-links" id="nav-links">
                    <li><a href="#hero-banner" class="nav-link active">Home</a></li>
                    <li><a href="#about" class="nav-link">About Us</a></li>
                    <li><a href="#services" class="nav-link">Services</a></li>
                    <li><a href="#projects" class="nav-link">Projects</a></li>
                    <li><a href="#contact" class="nav-link btn-contact">Contact Us</a></li>
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
    <section class="subsidiary-hero" id="hero-banner">
        <div class="subsidiary-hero-overlay"></div>
        <!-- Using a relevant image for Engineering -->
        <img src="assets/ensol_enginerring.jpeg" alt="Ensol Engineering" class="subsidiary-hero-img">
        <div class="subsidiary-hero-content animate-on-scroll">
            <h1 class="subsidiary-hero-title">Ensol Engineering & Technology</h1>
            <p class="hero-description" style="color: var(--white); font-size: 1.2rem;">Detailed engineering, maintenance, and technical solutions.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-group" id="about" style="padding: var(--spacing-2xl) 0;">
        <div class="container">
            <div class="about-group-content">
                <div class="about-group-text animate-on-scroll">
                    <h2 class="section-title-left">About <span class="title-accent">Ensol Engineering</span></h2>
                    <p>Ensol Engineering and Technology Services is a wholly indigenous Ghanaian company that provides high quality and value-driven engineering and support services across multiple industries and the entire value chain. We provide services in Fabric Maintenance, Cold Repair, Non-Destructive Testing, Lifting Equipment Inspection, Engineering Consultancy, Engineering Procurement and Contractor Services.</p>
                    <p>Headquartered in Accra, with operational site in Takoradi. Ensol Engineering is a leader in Composite Pipe repair Systems with optimized repair of pipes and piping systems with the use of FORTEC system (Composite wrap material) which has already been introduced to MODEC on the FPSO KNK and has been known to provide high-quality performance in pipe repair. The FORTEC has been duly approved by ABS and DNV and used widely by BP, Total etc.</p>
                </div>
                <div class="story-image animate-on-scroll delay-2">
                    <img src="assets/img2.jpeg" alt="Engineering Team">
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="services-grid" style="margin-top: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: var(--spacing-lg);">
                <div class="service-item animate-on-scroll" style="background: var(--light-bg); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                    <h3 style="color: var(--vivid-red);">Our Vision</h3>
                    <p>To become a leading engineering firm in Asset Integrity & Management Services (Pipe Repair, NDT, LEI) and Engineering Consultancy (Engineering Support Services, FEED, Project feasibility) suited as a choice for quality, integrity, responsiveness and excellent work execution.</p>
                </div>
                <div class="service-item animate-on-scroll delay-1" style="background: var(--light-bg); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                    <h3 style="color: var(--vivid-red);">Our Mission</h3>
                    <p>To build a lasting working relationship with clients through delivery of reliable and valuable engineering, training and consultancy services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-intro" id="services" style="background-color: var(--off-white); padding: var(--spacing-2xl) 0;">
        <div class="container">
            <h2 class="section-title animate-on-scroll" style="text-align: center;">Our <span class="title-accent">Services</span></h2>
            <div class="partners-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--spacing-lg); margin-top: var(--spacing-lg);">

                <div class="service-card animate-on-scroll" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-tools"></i></div>
                    </div>
                    <h3 class="service-card-title">Fabric Maintenance</h3>
                    <p class="service-card-description">Comprehensive maintenance solutions to preserve and extend the lifespan of industrial structures and equipment.</p>
                </div>

                <div class="service-card animate-on-scroll delay-1" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-snowflake"></i></div>
                    </div>
                    <h3 class="service-card-title">Cold Repair & Fastening</h3>
                    <p class="service-card-description">Durable composite bonding and fastening solutions using Coldpad technology, facilitating safe maintenance without hot work.</p>
                </div>

                <div class="service-card animate-on-scroll delay-2" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-search-plus"></i></div>
                    </div>
                    <h3 class="service-card-title">Non-Destructive Testing (NDT)</h3>
                    <p class="service-card-description">Advanced testing methods to evaluate properties of materials, components, or systems without causing damage.</p>
                </div>

                <div class="service-card animate-on-scroll" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-weight-hanging"></i></div>
                    </div>
                    <h3 class="service-card-title">Lifting Equipment Inspection</h3>
                    <p class="service-card-description">Thorough inspection and certification of all types of lifting equipment to ensure safety and regulatory compliance.</p>
                </div>

                <div class="service-card animate-on-scroll delay-1" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-user-tie"></i></div>
                    </div>
                    <h3 class="service-card-title">Engineering Consultancy</h3>
                    <p class="service-card-description">Expert engineering support services, FEED (Front End Engineering Design), and project feasibility studies.</p>
                </div>

                <div class="service-card animate-on-scroll delay-2" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-hard-hat"></i></div>
                    </div>
                    <h3 class="service-card-title">Engineering Procurement & Construction</h3>
                    <p class="service-card-description">End-to-end EPC services, managing the entire lifecycle of industrial and infrastructure projects.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Projects / Solutions Section -->
    <section class="section-padding" id="projects">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Our <span class="title-accent">Solutions</span></h2>

            <div class="project-block animate-on-scroll" style="margin-top: 40px;">
                <h3 style="color: var(--vivid-red); margin-bottom: 20px;">FORTEC Composite Pipe Repair Solution</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start;">
                    <div style="flex: 1; min-width: 300px;">
                        <ul style="list-style-type: none; padding: 0;">
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> The Fortec system is specifically designed to repair defects on pipelines in service onshore or offshore as a provisional or permanent repair.</li>
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> It provides a long-term solution for non through wall defects and a short-term solution for through wall defects.</li>
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> The Fortec composite system consist of a glass fibre fabric, designed by PROKEM, impregnated with a high quality, non-toxic, proprietary solvent free epoxy that can cure underwater.</li>
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> It provides high anticorrosion protection as well as high mechanical reinforcement.</li>
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> It is particularly suitable for dented or corrode pipelines as well as corroded risers, piping or casing located in the splash zone or top sides of oil rigs/platforms.</li>
                            <li style="margin-bottom: 10px; padding-left: 20px; position: relative;"><i class="fas fa-check" style="color: var(--vivid-red); position: absolute; left: 0; top: 5px;"></i> The Fortec system eliminates the need to shut down and replace defective steelworks and it is considered the best technical offer, along with the best cost-effective material.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-block animate-on-scroll" style="margin-top: 60px;">
                <h3 style="color: var(--vivid-red); margin-bottom: 20px;">ColdRepair Solutions (Coldpad S300 & S1000)</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start; flex-direction: row-reverse;">
                    <div style="flex: 1; min-width: 300px;">
                        <p style="margin-bottom: 15px;">The need for non-intrusive cold works which offers durable composite bonding and fastening cannot be overlooked in industries such as Oil and Gas, Storage and Process Facilities.</p>
                        <p style="margin-bottom: 15px;">Ensol Engineering has partnered with Coldpad, a leader in cold repair and fastening solutions, to provides durable composite bonding & fastening solutions to facilitate structural maintenance, retrofit & upgrade operations while reducing OPEX by eradicating associated cost.</p>
                        <p style="margin-bottom: 15px;">C-Claw™ is specially designed for offshore environments like FPSO. It is truly revolutionary in the marine world and inspired by composite techniques that have been used for decades in aeronautics.</p>
                        <p>C-Claw™ offers a quick, reliable and durable fastening solution for all your FPSO outfitting, maintenance & modification operations: cable trays, pipe supports, skids, handrails, ladders, and more.</p>
                    </div>
                </div>
            </div>

            <div class="project-block animate-on-scroll" style="margin-top: 60px;">
                <h3 style="color: var(--vivid-red); margin-bottom: 20px;">Safety Tools Allmet</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start;">
                    <div style="flex: 1; min-width: 300px;">
                        <p style="margin-bottom: 15px;">Safety Tools Allmet specializes in unique cold work surface preparation and cutting tools. Our equipment follows ATEX guidelines and is safe to use in EX Zones 1 and 2 without a Hot Work Permit.</p>
                        <p style="margin-bottom: 20px;">Safety Tools have been safely used around the world for over a decade and offer substantial Health Safety & Environmental benefits.</p>

                        <h4 style="margin-bottom: 15px;">Benefits of Safety Tools Allmet:</h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> No Need For Hot Work Permit</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> No Need For Job Postponement</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> Low Noise (80-85dB Average)</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> No Demanding Risk Evaluation</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> No Need For Habitats</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> Low Heat (30C -60C Average)</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> Low Vibration (2.5m/s Average)</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> Roughness Profile (40-70 microns)</div>
                            <div><i class="fas fa-check-circle" style="color: var(--vivid-red);"></i> No Hot Spark</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Partners/Clients Section -->
    <section class="partners-logos-section" id="clients" style="padding: var(--spacing-2xl) 0; background-color: var(--light-bg);">
        <div class="container">
            <h2 class="section-title animate-on-scroll" style="text-align: center; margin-bottom: var(--spacing-lg);">Our <span class="title-accent">Partners & Clients</span></h2>
            <div class="partners-logos-grid" style="display: flex; flex-wrap: wrap; justify-content: center; gap: var(--spacing-lg);">
                <div class="partner-logo-card animate-on-scroll" style="flex: 1; min-width: 200px; max-width: 250px;">
                    <img src="assets/tullow.webp" alt="Tullow Oil" class="partner-logo-img">
                </div>
                <div class="partner-logo-card animate-on-scroll delay-1" style="flex: 1; min-width: 200px; max-width: 250px;">
                    <img src="assets/modec.png" alt="MODEC" class="partner-logo-img">
                </div>
                <div class="partner-logo-card animate-on-scroll delay-2" style="flex: 1; min-width: 200px; max-width: 250px;">
                    <img src="assets/eni.png" alt="ENI Ghana" class="partner-logo-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="section-padding" id="certifications">
        <div class="container text-center">
            <h2 class="section-title animate-on-scroll">Our <span class="title-accent">Certifications</span></h2>
            <div class="values-grid" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 40px;">
                <div class="value-card animate-on-scroll" style="flex: 1; min-width: 250px; max-width: 300px; padding: 20px; background: var(--white); border-radius: 8px; box-shadow: var(--shadow-sm);">
                    <img src="assets/iso_45001.jpeg" alt="ISO 45001:2018" style="width: 100%; height: auto; margin-bottom: 15px; border-radius: 8px;">
                    <h4>ISO 45001:2018</h4>
                    <p>Occupational Health & Safety Management System</p>
                </div>
                <div class="value-card animate-on-scroll delay-1" style="flex: 1; min-width: 250px; max-width: 300px; padding: 20px; background: var(--white); border-radius: 8px; box-shadow: var(--shadow-sm);">
                    <img src="assets/iso_14001.jpeg" alt="ISO 14001:2015" style="width: 100%; height: auto; margin-bottom: 15px; border-radius: 8px;">
                    <h4>ISO 14001:2015</h4>
                    <p>Environmental Management System</p>
                </div>
                <div class="value-card animate-on-scroll delay-2" style="flex: 1; min-width: 250px; max-width: 300px; padding: 20px; background: var(--white); border-radius: 8px; box-shadow: var(--shadow-sm);">
                    <img src="assets/iso_9001.jpeg" alt="ISO 9001:2015" style="width: 100%; height: auto; margin-bottom: 15px; border-radius: 8px;">
                    <h4>ISO 9001:2015</h4>
                    <p>Quality Management System</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact" style="background-color: var(--jet-black); color: var(--white); padding: var(--spacing-2xl) 0;">
        <div class="container" style="text-align: center;">
            <h2 class="section-title animate-on-scroll" style="color: var(--white);">Get In <span class="title-accent">Touch</span></h2>
            <p class="animate-on-scroll width-100" style="max-width: 600px; margin: 0 auto var(--spacing-lg) auto;">
                Have a project in mind or need expert engineering advice? Contact Ensol Engineering & Technology today.
            </p>
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
                        <img src="assets/ensol_enginerring.jpeg" alt="Ensol Engineering Logo">
                        <h4 style="margin-top: 10px; color: var(--white);">Engineering & Technology</h4>
                    </div>
                    <p class="footer-description">
                        Providing top-tier engineering, maintenance, and fabrication solutions.
                    </p>
                </div>

                <div class="footer-section footer-links animate-on-scroll delay-1">
                    <h3 class="footer-title">Locations</h3>
                    <ul>
                        <li style="margin-bottom: 10px;">
                            <strong>Ghana Office:</strong><br>
                            East Legon, E3, Nii Osea Ntiful Avenue
                        </li>
                        <li>
                            <strong>Cote D'Ivoire Office:</strong><br>
                            Abidjan, Cocody, Abidjan Commune De<br>
                            Cocody 2 Plateaux, Cite Versant 1,<br>
                            Lot: 59, Ilot: 4
                        </li>
                    </ul>
                </div>

                <div class="footer-section footer-contact animate-on-scroll delay-2">
                    <h3 class="footer-title">Contact us</h3>
                    <p>Ready to discuss your next project?</p>
                    <a href="tel:+233501490149" class="contact-phone" style="display: block; margin-bottom: 5px;">
                        <i class="fas fa-phone"></i>
                        +233 50 149 0149 0645
                    </a>
                    <a href="tel:+22507022214" class="contact-phone" style="display: block; margin-bottom: 15px;">
                        <i class="fas fa-phone"></i>
                        +225 07 02 22 14
                    </a>
                    <a href="mailto:info@ensolengineeering.com" class="contact-phone" style="display: block;">
                        <i class="fas fa-envelope"></i>
                        info@ensolengineeering.com
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