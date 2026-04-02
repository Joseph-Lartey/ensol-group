<?php if (!isset($activePage)) $activePage = ''; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>SCL Ghana | Southey Contracting</title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : 'SCL Ghana Limited – Specialized industrial solutions for asset protection, inspection, mechanical integrity, and more across Mining and Oil & Gas sectors.'; ?>">
    <link rel="icon" type="image/png" href="assets/Southey_no_background.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <?php if (isset($pageStyles)) echo $pageStyles; ?>
</head>
<body>

<?php if (!isset($hideHeader) || !$hideHeader): ?>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <a href="index.php" class="logo"><img src="assets/Southey_no_background.png" alt="Southey Contracting Logo"></a>
        </div>
        <nav class="nav-links dynamic-island">
            <a href="index.php" class="nav-link <?php echo $activePage === 'home' ? 'active' : ''; ?>">Home</a>
            <a href="about.php" class="nav-link <?php echo $activePage === 'about' ? 'active' : ''; ?>">About Us</a>
            <div class="nav-item-services">
                <a href="services.php" class="nav-link <?php echo in_array($activePage, ['services','industry','oil-gas','mining']) ? 'active' : ''; ?>">Services <i class="fas fa-chevron-down" style="font-size: 0.6rem; opacity: 0.7; margin-left: 2px;"></i></a>
                <div class="services-dropdown">
                    <div class="dropdown-section">
                        <h4>What We Do</h4>
                        <a href="services.php"><i class="fas fa-cogs" style="margin-right: 6px; font-size: 0.75rem; opacity: 0.5;"></i>Services List</a>
                    </div>
                    <div class="dropdown-section">
                        <h4>By Industry</h4>
                        <a href="industry.php"><i class="fas fa-industry" style="margin-right: 6px; font-size: 0.75rem; opacity: 0.5;"></i>Overview</a>
                        <a href="oil-gas.php"><i class="fas fa-oil-well" style="margin-right: 6px; font-size: 0.75rem; opacity: 0.5;"></i>Oil &amp; Gas</a>
                        <a href="mining.php"><i class="fas fa-helmet-safety" style="margin-right: 6px; font-size: 0.75rem; opacity: 0.5;"></i>Mining</a>
                    </div>
                </div>
            </div>
            <a href="contact.php" class="nav-link <?php echo $activePage === 'contact' ? 'active' : ''; ?>">Contact</a>
            <div class="nav-pill-indicator"></div>
        </nav>

        <button class="menu-toggle" id="menu-toggle"><i class="fas fa-bars"></i></button>
    </header>

    <!-- Mobile Nav Overlay -->
    <div class="mobile-nav-overlay" id="mobile-nav-overlay">
        <div class="mobile-nav-content">
            <button class="mobile-nav-close" id="mobile-nav-close"><i class="fas fa-times"></i></button>
            <nav class="mobile-nav-links">
                <a href="index.php" class="<?php echo $activePage === 'home' ? 'active' : ''; ?>">Home</a>
                <a href="about.php" class="<?php echo $activePage === 'about' ? 'active' : ''; ?>">About Us</a>
                <div class="mobile-nav-group">
                    <span class="mobile-nav-label">Services</span>
                    <a href="services.php" class="mobile-nav-sub <?php echo $activePage === 'services' ? 'active' : ''; ?>">Services List</a>
                    <a href="industry.php" class="mobile-nav-sub <?php echo $activePage === 'industry' ? 'active' : ''; ?>">By Industry</a>
                    <a href="oil-gas.php" class="mobile-nav-sub <?php echo $activePage === 'oil-gas' ? 'active' : ''; ?>">Oil &amp; Gas</a>
                    <a href="mining.php" class="mobile-nav-sub <?php echo $activePage === 'mining' ? 'active' : ''; ?>">Mining</a>
                </div>
                <a href="contact.php" class="<?php echo $activePage === 'contact' ? 'active' : ''; ?>">Contact</a>
            </nav>
        </div>
    </div>
<?php endif; ?>
