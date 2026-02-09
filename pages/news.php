<?php
require_once __DIR__ . '/../includes/config.php';

// Get all published articles
$stmt = $pdo->prepare("
    SELECT id, title, slug, summary, featured_image, category, read_time, created_at 
    FROM news_articles 
    WHERE is_published = 1 
    ORDER BY published_at DESC
");
$stmt->execute();
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay updated with the latest news from Ensol Group - partnerships, projects, awards, and company updates.">
    <title>News | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">

    <!-- Google Fonts - Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

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
                    <li><a href="partners.php" class="nav-link">Partners</a></li>
                    <li><a href="news.php" class="nav-link active">News</a></li>
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

    <!-- News Hero Banner -->
    <section class="news-hero">
        <img src="../assets/img3.jpeg" alt="News" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5);"></div>
        <div class="container" style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center;">
            <div class="animate-on-scroll">
                <h1 style="color: white; font-size: clamp(2rem, 5vw, 3.5rem); margin-bottom: 16px;">Latest News</h1>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; max-width: 600px;">
                    Stay updated with our latest partnerships, projects, and company announcements
                </p>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <div class="news-intro animate-on-scroll">
                <p>Explore our recent updates and success stories</p>
            </div>

            <div class="news-grid">
                <?php foreach ($articles as $article): ?>
                <div class="news-card animate-on-scroll">
                    <a href="news-article.php?slug=<?php echo urlencode($article['slug']); ?>" class="news-card-link">
                        <div class="news-card-image">
                            <img src="../<?php echo htmlspecialchars($article['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($article['title']); ?>">
                            <span class="news-tag"><?php echo htmlspecialchars($article['category']); ?></span>
                        </div>
                        <div class="news-card-content">
                            <div class="news-meta">
                                <span><i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($article['created_at'])); ?></span>
                                <span><i class="far fa-clock"></i> <?php echo $article['read_time']; ?> min read</span>
                            </div>
                            <h3 class="news-card-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                            <p class="news-card-excerpt"><?php echo htmlspecialchars($article['summary']); ?></p>
                            <span class="read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
                
                <?php if (empty($articles)): ?>
                <div class="col-span-3" style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-newspaper" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                    <h3>No news articles yet</h3>
                    <p style="color: #666;">Check back soon for updates!</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="../script.js"></script>
</body>

</html>