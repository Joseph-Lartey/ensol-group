<?php
require_once __DIR__ . '/../includes/config.php';

// Handle filters
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$categoryF = isset($_GET['category']) ? trim($_GET['category']) : '';
$locationF = isset($_GET['location']) ? trim($_GET['location']) : '';
$jobTypeF = isset($_GET['type']) ? trim($_GET['type']) : '';
$subsidiaryF = isset($_GET['subsidiary']) ? trim($_GET['subsidiary']) : '';

// Build query
$queryStr = "SELECT * FROM job_postings WHERE 1=1";
$params = [];

if (!empty($search)) {
    $queryStr .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if (!empty($categoryF)) {
    $queryStr .= " AND category = ?";
    $params[] = $categoryF;
}
if (!empty($locationF)) {
    $queryStr .= " AND location = ?";
    $params[] = $locationF;
}
if (!empty($jobTypeF)) {
    $queryStr .= " AND job_type = ?";
    $params[] = $jobTypeF;
}
if (!empty($subsidiaryF)) {
    $queryStr .= " AND subsidiary = ?";
    $params[] = $subsidiaryF;
}

$queryStr .= " ORDER BY is_featured DESC, created_at DESC";

$stmt = $pdo->prepare($queryStr);
$stmt->execute($params);
$jobs = $stmt->fetchAll();

// Get unique filter options for Sidebar
$categories = $pdo->query("SELECT DISTINCT category FROM job_postings")->fetchAll(PDO::FETCH_COLUMN);
$locations = $pdo->query("SELECT DISTINCT location FROM job_postings")->fetchAll(PDO::FETCH_COLUMN);
$jobTypes = $pdo->query("SELECT DISTINCT job_type FROM job_postings")->fetchAll(PDO::FETCH_COLUMN);
$subsidiaries = $pdo->query("SELECT DISTINCT subsidiary FROM job_postings")->fetchAll(PDO::FETCH_COLUMN);

// Function to get logo based on subsidiary
function getSubsidiaryLogo($subsidiary)
{
    switch (trim($subsidiary)) {
        case 'Ensol Energy':
            return '../assets/ensol_energy.jpeg';
        case 'Southey Contracting':
            return '../assets/Southey_no_background.png';
        case 'Ensol Engineering':
            return '../assets/ensol_enginerring.jpeg';
        default:
            return '../assets/ensol_logo.jpg';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Join Ensol Group. Discover open positions and career opportunities in engineering, energy, and contracting across Ghana and West Africa.">
    <title>Careers | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">

    <style>
        .career-page-wrapper {
            background-color: #fafafa;
            min-height: 80vh;
            padding: 4rem 1rem;
            font-family: 'Inter', sans-serif;
        }

        .career-container {
            display: flex;
            gap: 3rem;
        }

        .career-sidebar {
            flex: 0 0 280px;
            padding-top: 10px;
        }

        .career-main {
            flex: 1;
        }

        .career-header {
            margin-bottom: 2.5rem;
        }

        .career-header h4 {
            color: #888;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .career-header h1 {
            font-size: 2.5rem;
            color: #222;
            font-family: 'Merriweather', serif;
        }

        .filter-controls {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            color: #555;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eaeaea;
            justify-content: space-between;
        }

        .filter-controls span {
            font-weight: 500;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .clear-filters {
            font-size: 0.85rem;
            color: var(--vivid-red);
            text-decoration: none;
            font-weight: 500;
        }

        .clear-filters:hover {
            text-decoration: underline;
        }

        .filter-section {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 1rem;
        }

        .filter-section h3 {
            font-size: 1rem;
            color: #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .filter-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .filter-list li {
            margin-bottom: 8px;
        }

        .filter-list a {
            color: #666;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s;
            display: block;
        }

        .filter-list a:hover,
        .filter-list a.active {
            color: var(--vivid-red);
            font-weight: 500;
        }

        .search-form {
            display: flex;
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .search-container {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            transition: box-shadow 0.3s;
            width: 100%;
        }

        .search-container:focus-within {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-color: #ccc;
        }

        .search-container input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 1.05rem;
            color: #333;
            font-family: 'Inter', sans-serif;
            background: transparent;
            padding-left: 15px;
        }

        .search-btn {
            background: var(--vivid-red);
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 6px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: #c8181f;
        }

        .jobs-count {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .jobs-count strong {
            color: #222;
            font-weight: 600;
        }

        .job-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .job-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 10px;
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-color: #e0e0e0;
        }

        .job-card-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex: 1;
        }

        .job-logo {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #f0f0f0;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            padding: 5px;
        }

        .job-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .job-details {
            flex: 1;
        }

        .job-title {
            font-size: 1.15rem;
            color: #2c3e50;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }

        .job-meta {
            color: #777;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .badge-featured {
            background: #e6f4ea;
            color: #1e8e3e;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .badge-available {
            background: #e6f4ea;
            color: #1e8e3e;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .badge-unavailable {
            background: #fce8e6;
            color: #d93025;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: 8px;
            border: 1px dashed #ddd;
        }

        .no-results i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .no-results h3 {
            color: #444;
            margin-bottom: 0.5rem;
        }

        .no-results p {
            color: #888;
        }

        @media (max-width: 768px) {
            .career-container {
                flex-direction: column;
                gap: 2rem;
            }

            .career-sidebar {
                flex: none;
                width: 100%;
            }

            .job-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.5rem;
            }

            .job-card-left {
                width: 100%;
            }

            .badge-featured {
                margin-left: 75px;
            }
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
                    <li><a href="about.php" class="nav-link">About us</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="clients.php" class="nav-link">Clients</a></li>
                    <li><a href="news.php" class="nav-link">News</a></li>
                    <li><a href="career.php" class="nav-link active">Career</a></li>
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

    <!-- Career Hero Banner -->
    <section class="news-hero">
        <img src="../assets/career.jpg" alt="Careers" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5);"></div>
        <div style="width: 100%; max-width: 1200px; margin: 0 auto; position: relative; z-index: 1; height: 100%; display: flex; align-items: flex-end; padding: 0 var(--spacing-md) 1.5rem var(--spacing-md);">
            <div class="animate-on-scroll" style="margin-left: -15px;">
                <h1 style="color: white; font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 8px; font-family: 'Merriweather', serif; font-weight: 700;">Careers</h1>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.15rem; max-width: 600px;">
                    Discover open positions and join the Ensol Group team
                </p>
            </div>
        </div>
    </section>

    <div class="career-page-wrapper">
        <div class="container">
            <div class="career-header animate-on-scroll" style="margin-left: -15px;">
                <h4>Ensol Group Careers</h4>
                <h1>Open Positions</h1>
            </div>

            <div class="career-container">
                <!-- Sidebar Filters -->
                <aside class="career-sidebar animate-on-scroll delay-1">
                    <div class="filter-controls">
                        <span><i class="fas fa-sliders-h"></i> Filters</span>
                        <?php if (!empty($search) || !empty($categoryF) || !empty($locationF) || !empty($jobTypeF) || !empty($subsidiaryF)): ?>
                            <a href="career.php" class="clear-filters">Clear All</a>
                        <?php endif; ?>
                    </div>

                    <?php
                    // Helper function to build filter URLs
                    function buildFilterUrl($param, $value)
                    {
                        $queryParams = $_GET;
                        if ($value === '') {
                            unset($queryParams[$param]);
                        } else {
                            $queryParams[$param] = $value;
                        }
                        return 'career.php?' . http_build_query($queryParams);
                    }
                    ?>

                    <!-- Categories -->
                    <?php if (!empty($categories)): ?>
                        <div class="filter-section">
                            <h3>Categories</h3>
                            <ul class="filter-list">
                                <li><a href="<?php echo buildFilterUrl('category', ''); ?>" class="<?php echo empty($categoryF) ? 'active' : ''; ?>">All Categories</a></li>
                                <?php foreach ($categories as $cat): ?>
                                    <li><a href="<?php echo buildFilterUrl('category', $cat); ?>" class="<?php echo $categoryF === $cat ? 'active' : ''; ?>"><?php echo htmlspecialchars($cat); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Subsidiaries -->
                    <?php if (!empty($subsidiaries)): ?>
                        <div class="filter-section">
                            <h3>Subsidiaries</h3>
                            <ul class="filter-list">
                                <li><a href="<?php echo buildFilterUrl('subsidiary', ''); ?>" class="<?php echo empty($subsidiaryF) ? 'active' : ''; ?>">All Subsidiaries</a></li>
                                <?php foreach ($subsidiaries as $sub): ?>
                                    <li><a href="<?php echo buildFilterUrl('subsidiary', $sub); ?>" class="<?php echo $subsidiaryF === $sub ? 'active' : ''; ?>"><?php echo htmlspecialchars($sub); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Locations -->
                    <?php if (!empty($locations)): ?>
                        <div class="filter-section">
                            <h3>Locations</h3>
                            <ul class="filter-list">
                                <li><a href="<?php echo buildFilterUrl('location', ''); ?>" class="<?php echo empty($locationF) ? 'active' : ''; ?>">All Locations</a></li>
                                <?php foreach ($locations as $loc): ?>
                                    <li><a href="<?php echo buildFilterUrl('location', $loc); ?>" class="<?php echo $locationF === $loc ? 'active' : ''; ?>"><?php echo htmlspecialchars($loc); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Job Types -->
                    <?php if (!empty($jobTypes)): ?>
                        <div class="filter-section">
                            <h3>Job Types</h3>
                            <ul class="filter-list">
                                <li><a href="<?php echo buildFilterUrl('type', ''); ?>" class="<?php echo empty($jobTypeF) ? 'active' : ''; ?>">All Types</a></li>
                                <?php foreach ($jobTypes as $type): ?>
                                    <li><a href="<?php echo buildFilterUrl('type', $type); ?>" class="<?php echo $jobTypeF === $type ? 'active' : ''; ?>"><?php echo htmlspecialchars($type); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </aside>

                <!-- Main Content -->
                <main class="career-main">
                    <form action="career.php" method="GET" class="search-form animate-on-scroll delay-2">
                        <?php if (!empty($categoryF)) echo '<input type="hidden" name="category" value="' . htmlspecialchars($categoryF) . '">'; ?>
                        <?php if (!empty($locationF)) echo '<input type="hidden" name="location" value="' . htmlspecialchars($locationF) . '">'; ?>
                        <?php if (!empty($jobTypeF)) echo '<input type="hidden" name="type" value="' . htmlspecialchars($jobTypeF) . '">'; ?>
                        <?php if (!empty($subsidiaryF)) echo '<input type="hidden" name="subsidiary" value="' . htmlspecialchars($subsidiaryF) . '">'; ?>

                        <div class="search-container">
                            <i class="fas fa-search"></i>
                            <input type="text" name="q" placeholder="Search jobs by title or keyword..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <button type="submit" class="search-btn">Search</button>
                    </form>

                    <div class="jobs-count animate-on-scroll delay-2">
                        <strong><?php echo count($jobs); ?></strong> jobs available
                    </div>

                    <div class="job-list">
                        <?php if (empty($jobs)): ?>
                            <div class="no-results animate-on-scroll delay-3">
                                <i class="fas fa-search-minus"></i>
                                <h3>No jobs found</h3>
                                <p>Try adjusting your search or filters to find what you're looking for.</p>
                                <?php if (!empty($_GET)): ?>
                                    <a href="career.php" class="btn btn-primary" style="margin-top: 15px;">Clear Filters</a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <?php $delay = 3;
                            foreach ($jobs as $job): ?>
                                <a href="job-details.php?slug=<?php echo urlencode($job['slug']); ?>" class="job-card animate-on-scroll delay-<?php echo $delay; ?>">
                                    <div class="job-card-left">
                                        <div class="job-logo">
                                            <img src="<?php echo getSubsidiaryLogo($job['subsidiary']); ?>" alt="<?php echo htmlspecialchars($job['subsidiary']); ?>">
                                        </div>
                                        <div class="job-details">
                                            <h2 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h2>
                                            <div class="job-meta">
                                                <span><i class="fas fa-briefcase" style="width: 15px;"></i> <?php echo htmlspecialchars($job['category']); ?></span>
                                                <span><i class="fas fa-map-marker-alt" style="width: 15px;"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                                                <span style="color:var(--vivid-red); font-size: 0.8rem; margin-top:2px;">
                                                    <?php echo htmlspecialchars($job['subsidiary']); ?> &bull; <?php echo htmlspecialchars($job['job_type']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                                        <?php if ($job['is_active']): ?>
                                            <span class="badge-available">Available</span>
                                        <?php else: ?>
                                            <span class="badge-unavailable">Unavailable</span>
                                        <?php endif; ?>

                                        <?php if ($job['is_featured']): ?>
                                            <span class="badge-featured">Featured</span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            <?php $delay = $delay >= 5 ? 3 : $delay + 1;
                            endforeach; ?>
                        <?php endif; ?>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <a href="#" class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
        <span>Top</span>
    </a>

    <script src="../script.js"></script>
</body>

</html>