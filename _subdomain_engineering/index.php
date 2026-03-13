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
            margin-top: 78px;
            /* Offset for fixed header */
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

        .hero-slide {
            position: absolute;
            top: 0;
            left: 100%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: left 1.2s ease-in-out;
            z-index: 1;
        }

        .hero-slide.active {
            left: 0;
            z-index: 2;
        }

        .hero-slide.prev {
            left: -100%;
            z-index: 1;
        }

        .subsidiary-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
            z-index: 5;
        }

        .subsidiary-hero-content {
            position: relative;
            z-index: 10;
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

        /* Gallery Slider */
        .gallery-section {
            position: relative;
            overflow: hidden;
            background: var(--dark-gray);
        }

        .gallery-container {
            position: relative;
            width: 100%;
            height: 800px;
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
            background: rgba(0, 0, 0, 0.5);
            border-left: 5px solid var(--vivid-red);
            max-width: 600px;
        }

        @media (max-width: 768px) {
            .gallery-container {
                height: 400px;
            }
        }

        /* Team Section Styles */
        .team-member {
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            text-align: center;
            position: relative;
        }

        .team-img-wrapper {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .team-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .team-member:hover .team-img {
            transform: scale(1.1);
        }

        .team-tooltip {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(15px);
            width: 320px;
            max-height: 250px;
            overflow-y: auto;
            background-color: var(--white, #ffffff);
            color: var(--text-gray, #4a4a4a);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 10;
            text-align: left;
            font-size: 0.9rem;
            line-height: 1.5;
            border: 1px solid #f0f0f0;
            border-bottom: 4px solid var(--vivid-red, #e31e24);
        }

        /* Custom scrollbar for tooltip */
        .team-tooltip::-webkit-scrollbar {
            width: 6px;
        }

        .team-tooltip::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .team-tooltip::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .team-tooltip::-webkit-scrollbar-thumb:hover {
            background: var(--vivid-red, #e31e24);
        }

        .team-member:hover .team-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .team-name {
            margin-bottom: 5px;
            font-size: 1.2rem;
            color: var(--jet-black, #1a1a1a);
        }

        .team-role {
            color: var(--vivid-red, #e31e24);
            font-weight: bold;
            font-size: 0.95rem;
            margin-top: 0;
        }
    </style>
</head>

<body style="padding-top: 80px;">
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
        <!-- Slider Images -->
        <img src="assets/slider1.avif" alt="Ensol Engineering" class="hero-slide active">
        <img src="assets/slider2.jpg" alt="Ensol Engineering" class="hero-slide">
        <img src="assets/slider3.jpg" alt="Ensol Engineering" class="hero-slide">
    </section>

    <!-- About Section -->
    <section class="about-group" id="about" style="padding: var(--spacing-2xl) 0;">
        <div class="container">
            <div class="about-group-content">
                <div class="about-group-text animate-on-scroll">
                    <h2 class="section-title-left">About <span class="title-accent">Ensol Engineering and Technology Services</span></h2>
                    <p style="font-weight: bold; font-style: italic; color: var(--vivid-red); margin-bottom: 15px;">Driving Industrial Excellence through Indigenous Innovation.</p>
                    <p>Ensol Engineering and Technology Services is a premier, wholly indigenous Ghanaian engineering firm dedicated to delivering high-quality, safe, and value-driven technical solutions. Since our incorporation, we have positioned ourselves as a critical partner in the energy, marine, and industrial value chains, bridging the gap between global technical standards and local expertise.</p>
                    <p>We don't just provide services; we manage the integrity of your most critical assets. By leveraging cutting-edge technology and a highly competent local workforce, Ensol ensures that your operations remain efficient, compliant, and sustainable.</p>
                </div>
                <div class="story-image animate-on-scroll delay-2">
                    <img src="assets/img2.jpeg" alt="Engineering Team">
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="services-grid" style="margin-top: 50px; display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: var(--spacing-xl);">
                <div class="service-item animate-on-scroll" style="background: var(--slate-blue); color: var(--white); padding: var(--spacing-xl); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); text-align: center; transform: translateY(-10px); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-15px)'; this.style.boxShadow='var(--shadow-xl)';" onmouseout="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-lg)';">
                    <div style="font-size: 2.5rem; margin-bottom: 15px;"><i class="fas fa-bullseye"></i></div>
                    <h3 style="color: var(--white); font-size: 1.8rem; margin-bottom: 15px;">Our Mission</h3>
                    <p style="font-size: 1.1rem; line-height: 1.6;">To provide bespoke, technology-driven engineering solutions that enhance the performance and safety of our clients' assets while creating sustainable value for our stakeholders.</p>
                </div>
                <div class="service-item animate-on-scroll delay-1" style="background: var(--vivid-orange); color: var(--white); padding: var(--spacing-xl); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); text-align: center; transform: translateY(-10px); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-15px)'; this.style.boxShadow='var(--shadow-xl)';" onmouseout="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-lg)';">
                    <div style="font-size: 2.5rem; margin-bottom: 15px;"><i class="fas fa-eye"></i></div>
                    <h3 style="color: var(--white); font-size: 1.8rem; margin-bottom: 15px;">Our Vision</h3>
                    <p style="font-size: 1.1rem; line-height: 1.6;">To be the preferred indigenous engineering partner in West Africa, recognized for excellence, innovation, and an unwavering commitment to quality.</p>
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
                        <div class="service-icon"><i class="fas fa-shield-alt"></i></div>
                    </div>
                    <h3 class="service-card-title">Asset Integrity Management</h3>
                    <p class="service-card-description">Ensuring the ultimate safety and performance of your critical assets through advanced structural health monitoring, non-intrusive cold repair techniques, and specialized corrosion control services.</p>
                </div>

                <div class="service-card animate-on-scroll delay-1" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-drafting-compass"></i></div>
                    </div>
                    <h3 class="service-card-title">Engineering Consultancy & Design</h3>
                    <p class="service-card-description">Supporting full project lifecycles from initial feasibility studies and FEED to providing real-time engineering support and conducting rigorous technical audits.</p>
                </div>

                <div class="service-card animate-on-scroll delay-2" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-hard-hat"></i></div>
                    </div>
                    <h3 class="service-card-title">Contractor & EPC Services</h3>
                    <p class="service-card-description">Executing multi-disciplined Engineering, Procurement, and Construction (EPC) projects across Ghana, handling plant upgrades, modifications, and engineered pipe repair solutions.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Projects / Solutions Section -->
    <section class="services-intro" id="projects" style="padding: var(--spacing-2xl) 0;">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Our <span class="title-accent">Solutions</span></h2>

            <div class="partners-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--spacing-lg); margin-top: var(--spacing-lg);">
                <div class="service-card animate-on-scroll" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-xl)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)';">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-tools"></i></div>
                    </div>
                    <h3 class="service-card-title">FORTEC</h3>
                    <p class="service-card-description">A specialized fiberglass composite system designed to repair defects on pipelines in service onshore or offshore. It uses non-toxic proprietary epoxy to provide high anticorrosion protection and mechanical reinforcement. Ideal for dented or corroded pipelines, risers, and caissons in splash zones.</p>
                </div>

                <div class="service-card animate-on-scroll delay-1" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-xl)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)';">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-stopwatch"></i></div>
                    </div>
                    <h3 class="service-card-title">STOPTEC (UP & HD)</h3>
                    <p class="service-card-description">Fast and durable repair of pipe leaks (1” to 36” diameter) in just 20 minutes. Heat resistant to over 200°C and pressure resistant up to 30 Bar. Perfect emergency standby for all pipes, featuring excellent chemical resistance.</p>
                </div>

                <div class="service-card animate-on-scroll delay-2" style="background: var(--white); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-xl)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)';">
                    <div class="service-card-header">
                        <div class="service-icon"><i class="fas fa-anchor"></i></div>
                    </div>
                    <h3 class="service-card-title">C-CLAW Fastening Solution</h3>
                    <p class="service-card-description">A quick, reliable, and durable fastening solution for FPSO outfitting, maintenance, and modification operations. It provides a Class Approved, permanent structural repair that is entirely non-intrusive, requiring no hot works to maximize operational uptime.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Gallery Slider -->
    <section class="section-padding" id="projects" style="padding-bottom: 2rem;">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Our <span class="title-accent">Projects</span></h2>
        </div>
    </section>

    <section class="gallery-section">
        <div class="gallery-container" id="gallery-slider">
            <div class="gallery-slide active" style="background-image: url('assets/PB 2C1 DEFECT.jpg');">
                <div class="gallery-content">
                    <h3>Hatch Cover Restoration</h3>
                    <p>Repairing severely corroded and leaking hatch covers (PA2C1) on the FPSO KNK.</p>
                </div>
            </div>
            <div class="gallery-slide" style="background-image: url('assets/PB2C2 DEFECT.jpg');">
                <div class="gallery-content">
                    <h3>Hatch Cover Restoration</h3>
                    <p>Securing the integrity of PB2C2 hatch cover with advanced composites.</p>
                </div>
            </div>
            <div class="gallery-slide" style="background-image: url('assets/2CF HATCH REPAIR.jpg');">
                <div class="gallery-content">
                    <h3>Class-Approved Repair</h3>
                    <p>Extending asset service life without the need for operational shutdown.</p>
                </div>
            </div>
            <div class="gallery-slide" style="background-image: url('assets/Riser 9 Defect.png');">
                <div class="gallery-content">
                    <h3>Riser Sheath Repair</h3>
                    <p>Addressing localized dents to prevent progressive deterioration of risers.</p>
                </div>
            </div>
            <div class="gallery-slide" style="background-image: url('assets/Riser 9 fortec repair.png');">
                <div class="gallery-content">
                    <h3>Composite Engineering</h3>
                    <p>Successful engineered restoration of riser outer sheath integrity on time and within budget.</p>
                </div>
            </div>

            <div class="subsidiary-hero-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 40%); pointer-events: none;"></div>
        </div>
    </section>

    <!-- Experience & Projects Section -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title text-center animate-on-scroll">Proven <span class="title-accent">Experience</span></h2>

            <div class="content-block animate-on-scroll">
                <h4>Hatch Cover Integrity Restoration – FPSO KNK (Tullow Ghana)</h4>
                <p>Ensol Engineering, in collaboration with Cold Pad, successfully executed the permanent repair of two severely corroded and leaking hatch covers on the FPSO KNK. Utilizing advanced composite systems, we achieved a full restoration of the hatch integrity with a permanent, class-approved repair solution. The project was completed with zero safety incidents, successfully extending the asset service life without the need for operational shutdown or hot work.</p>
            </div>

            <div class="content-block animate-on-scroll" style="margin-top: 40px;">
                <h4>Riser 3 & Riser 9 Outer Sheath Repair – FPSO Operations</h4>
                <p>Following damage caused by a vessel collision, Ensol Engineering successfully executed an engineered repair of the outer sheath of Riser 3 and Riser 9 on a Tullow FPSO. We successfully restored the riser outer sheath integrity, fully reinforcing all dents to prevent further growth. The project was delivered safely, on time, and within budget, highlighting our expertise in composite repair technologies, rope-access execution, and rapid response to offshore asset damage.</p>
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
                    <img src="assets/Southey_no_background.png" alt="Southey Contracting" class="partner-logo-img">
                </div>
                <div class="partner-logo-card animate-on-scroll delay-3" style="flex: 1; min-width: 200px; max-width: 250px;">
                    <img src="assets/yinson.png" alt="Yinson" class="partner-logo-img">
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

    <!-- Our Team Section -->
    <section class="section-padding bg-light" id="team" style="padding-bottom: var(--spacing-2xl);">
        <div class="container text-center">
            <h2 class="section-title animate-on-scroll">Our <span class="title-accent">Team</span></h2>
            <div class="team-grid" style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin-top: 40px;">
                <!-- Team Member 1 -->
                <div class="team-member animate-on-scroll">
                    <div class="team-tooltip">
                        <p style="margin: 0;">Experienced professional with over 10 years in the industry, specializing in operational excellence and strategic leadership.</p>
                    </div>
                    <div class="team-img-wrapper">
                        <img src="assets/rafeeq_amadu.jpeg" alt="Rafeeq Amadu" class="team-img">
                    </div>
                    <h4 class="team-name">Rafeeq Amadu</h4>
                    <p class="team-role">Managing Partner</p>
                </div>
                <!-- Team Member 2 -->
                <div class="team-member animate-on-scroll delay-1">
                    <div class="team-tooltip">
                        <p style="margin: 0;">Dedicated specialist committed to delivering high-quality solutions and driving project success through innovation.</p>
                    </div>
                    <div class="team-img-wrapper">
                        <img src="assets/Nelly_Korley_Appertey.jpeg" alt="Nelly Korley Appertey" class="team-img">
                    </div>
                    <h4 class="team-name">Nelly Korley Appertey</h4>
                    <p class="team-role">Technical Project Coordinator</p>
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
                    <div class="social-links">
                        <a href="https://www.linkedin.com/company/ensolengineeringtechnologyservices/?viewAsMember=true" target="_blank" class="social-icon" aria-label="LinkedIn">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gallery Slider
            const gallerySlides = document.querySelectorAll('.gallery-slide');
            let currentGallery = 0;

            function nextGallerySlide() {
                if (gallerySlides.length === 0) return;
                gallerySlides[currentGallery].classList.remove('active');
                currentGallery = (currentGallery + 1) % gallerySlides.length;
                gallerySlides[currentGallery].classList.add('active');
            }
            if (gallerySlides.length > 1) setInterval(nextGallerySlide, 5000);

            // Hero Slider
            const heroSlides = document.querySelectorAll('.hero-slide');
            let currentHero = 0;

            function nextHeroSlide() {
                // Remove all classes first
                heroSlides.forEach(slide => {
                    slide.classList.remove('active', 'prev');
                });

                // Set the current slide as prev
                heroSlides[currentHero].classList.add('prev');

                // Move to next slide
                currentHero = (currentHero + 1) % heroSlides.length;

                // Make the next slide active
                heroSlides[currentHero].classList.add('active');
            }
            if (heroSlides.length > 1) setInterval(nextHeroSlide, 8000);
        });
    </script>
</body>

</html>