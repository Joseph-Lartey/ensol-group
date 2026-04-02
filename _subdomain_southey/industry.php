<?php
$activePage = 'industry';
$pageTitle = 'Industries We Serve';
$pageDescription = 'SCL Ghana provides mission-critical industrial support to the Oil & Gas and Mining sectors with specialized solutions for asset integrity and operational uptime.';
include 'includes/header.php';
?> 

    <!-- Hero Banner -->
    <section class="page-hero" style="background-image: url('assets/oil_rig.jpg');">
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content reveal-up">
            <p class="text-accent font-medium" style="margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.9rem;">By Industry</p>
            <h1 class="h2 font-medium">Industries We Serve</h1>
            <p style="color: rgba(255,255,255,0.8); max-width: 600px; font-size: 1.1rem; margin-top: 1rem;">Mission-critical support for some of the world's most demanding sectors.</p>
        </div>
    </section>

    <!-- Industry Intro -->
    <section class="section" style="background: #fff;">
        <div class="reveal-up" style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 class="h3 font-medium" style="margin-bottom: 1.5rem;">Expertise Across Demanding Sectors</h2>
            <p class="text-light" style="font-size: 1.1rem; line-height: 1.8;">For executives in the Mining and Oil &amp; Gas sectors, asset integrity and operational uptime are the primary drivers of profitability. Southey Contracting offers specialized industrial solutions designed to safeguard valuable infrastructure, reduce expensive shutdowns, and meet top international safety standards, such as ISO 9001:2015, ISO 14001:2015, and ISO 45001:2018.</p>
        </div>
    </section>

    <!-- Oil & Gas Industry -->
    <section class="section industry-detail-section" id="oil-gas">
        <div class="industry-detail reveal-up">
            <div class="industry-detail-image">
                <img src="assets/oil_gas_industry.png" alt="Oil & Gas Operations">
                <div class="industry-detail-badge">
                    <i class="fas fa-oil-well"></i>
                </div>
            </div>
            <div class="industry-detail-content">
                <p class="text-accent font-medium" style="margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.85rem;">Sector</p>
                <h2 class="font-medium" style="font-size: 2rem; margin-bottom: 1.5rem;">Oil &amp; Gas</h2>
                <p class="text-light" style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.5rem;">In a sector where a single leak or unplanned shutdown can cost millions, we provide advanced technologies to maintain constant production. Our solutions include zero-downtime pipeline repairs, precision flange management, and specialized commissioning services.</p>
                
                <div class="industry-highlights">
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Zero-downtime pipeline repairs with Metalyte Composite Wrap</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Precision Helium Leak Detection &amp; SRJ Bolting</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Hot Nitrogen Purging &amp; system inerting</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>IRATA-certified rope access &amp; CISRS scaffolding</span>
                    </div>
                </div>

                <a href="oil-gas.php" class="btn btn-primary" style="margin-top: 2rem; border-radius: 50px; background: var(--brand-red);">Read More About Oil &amp; Gas &rarr;</a>
            </div>
        </div>
    </section>

    <!-- Mining Industry -->
    <section class="section industry-detail-section" id="mining" style="background: #fff;">
        <div class="industry-detail reverse reveal-up">
            <div class="industry-detail-image">
                <img src="assets/mining_industry.png" alt="Mining Operations">
                <div class="industry-detail-badge">
                    <i class="fas fa-helmet-safety"></i>
                </div>
            </div>
            <div class="industry-detail-content">
                <p class="text-accent font-medium" style="margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.85rem;">Sector</p>
                <h2 class="font-medium" style="font-size: 2rem; margin-bottom: 1.5rem;">Mining</h2>
                <p class="text-light" style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.5rem;">To ensure the longevity of heavy-duty mining infrastructure and process plants, we offer high-performance maintenance solutions. From automated tank cleaning to advanced corrosion protection, our services keep mining operations running efficiently.</p>
                
                <div class="industry-highlights">
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>MAGTRACK automated crawler for safer tank cleaning</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>HUMIDUR single-coat anti-corrosion (sole distributor in Ghana)</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Expert welding, repair &amp; tube bundle cleaning</span>
                    </div>
                    <div class="industry-highlight">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>NDT including ultrasonic &amp; phased array inspections</span>
                    </div>
                </div>

                <a href="mining.php" class="btn btn-primary" style="margin-top: 2rem; border-radius: 50px; background: var(--brand-red);">Read More About Mining &rarr;</a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="background-color: var(--brand-black); color: #fff; text-align: center;">
        <div class="reveal-up">
            <h2 class="h3 font-medium" style="margin-bottom: 1.5rem;">Ready to Secure Your Operations?</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 2.5rem;">Partner with Southey Contracting to leverage our specialized solutions and maximize your plant's uptime and protect your bottom line.</p>
            <a href="contact.php" class="btn btn-primary" style="background-color: var(--brand-red);">Schedule an Integrity Audit &rarr;</a>
        </div>
    </section>

<?php include 'includes/footer.php'; ?> 
</body>
</html>
