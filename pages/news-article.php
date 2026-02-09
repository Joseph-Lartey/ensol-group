<?php
require_once __DIR__ . '/../includes/config.php';

// Get article by slug
$slug = $_GET['slug'] ?? '';
if (empty($slug)) {
    header('Location: news.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM news_articles 
    WHERE slug = ? AND is_published = 1
");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: news.php');
    exit;
}

// Increment view count
$pdo->prepare("UPDATE news_articles SET views = views + 1 WHERE id = ?")->execute([$article['id']]);

// Get related articles
$relatedStmt = $pdo->prepare("
    SELECT id, title, slug, featured_image, created_at 
    FROM news_articles 
    WHERE category = ? AND id != ? AND is_published = 1 
    ORDER BY published_at DESC 
    LIMIT 2
");
$relatedStmt->execute([$article['category'], $article['id']]);
$relatedArticles = $relatedStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($article['summary']); ?>">
    <title><?php echo htmlspecialchars($article['title']); ?> | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                    <li><a href="about.php" class="nav- link">About us</a></li>
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

    <!-- Article Hero Image -->
    <section class="article-hero">
        <img src="../<?php echo htmlspecialchars($article['featured_image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-hero-img">
        <div class="article-hero-overlay"></div>
        <div class="article-tag-wrapper">
            <span class="article-tag"><?php echo htmlspecialchars($article['category']); ?></span>
        </div>
    </section>

    <!-- Article Content -->
    <article class="article-content-section">
        <div class="container">
            <div class="article-wrapper">
                <a href="news.php" class="back-to-news animate-on-scroll">
                    <i class="fas fa-arrow-left"></i> Back to News
                </a>

                <header class="article-header animate-on-scroll">
                    <div class="article-meta">
                        <span class="article-date"><i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($article['created_at'])); ?></span>
                        <span class="article-author"><i class="far fa-user"></i> Ensol Group</span>
                        <span class="article-read-time"><i class="far fa-clock"></i> <?php echo $article['read_time']; ?> min read</span>
                    </div>
                    <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
                </header>

                <div class="article-body animate-on-scroll delay-1">
                    <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                </div>

                <!-- Like/Dislike Section -->
                <div class="article-reactions animate-on-scroll delay-2">
                    <h4>Was this article helpful?</h4>
                    <div class="reaction-buttons">
                        <button class="reaction-btn like-btn" id="like-btn" onclick="handleReaction('like', <?php echo $article['id']; ?>)">
                            <i class="far fa-thumbs-up"></i>
                            <span class="reaction-count" id="like-count"><?php echo $article['likes']; ?></span>
                        </button>
                        <button class="reaction-btn dislike-btn" id="dislike-btn" onclick="handleReaction('dislike', <?php echo $article['id']; ?>)">
                            <i class="far fa-thumbs-down"></i>
                            <span class="reaction-count" id="dislike-count"><?php echo $article['dislikes']; ?></span>
                        </button>
                    </div>
                </div>

                <!-- Related Articles -->
                <?php if (!empty($relatedArticles)): ?>
                <div class="related-articles animate-on-scroll delay-3">
                    <h3>Related Articles</h3>
                    <div class="related-grid">
                        <?php foreach ($relatedArticles as $related): ?>
                        <a href="news-article.php?slug=<?php echo urlencode($related['slug']); ?>" class="related-card">
                            <img src="../<?php echo htmlspecialchars($related['featured_image']); ?>" alt="Related Article">
                            <div class="related-content">
                                <span class="related-date"><?php echo date('M j, Y', strtotime($related['created_at'])); ?></span>
                                <h4><?php echo htmlspecialchars($related['title']); ?></h4>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </article>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script src="../script.js"></script>
    <script>
        let userReaction = localStorage.getItem('article_<?php echo $article['id']; ?>_reaction');
        
        if (userReaction) {
            const btn = document.getElementById(userReaction + '-btn');
            btn.classList.add('active');
            btn.querySelector('i').classList.remove('far');
            btn.querySelector('i').classList.add('fas');
        }
        
        async function handleReaction(type, articleId) {
            const likeBtn = document.getElementById('like-btn');
            const dislikeBtn = document.getElementById('dislike-btn');
            const likeCount = document.getElementById('like-count');
            const dislikeCount = document.getElementById('dislike-count');
            
            // Toggle reaction
            if (userReaction === type) {
                userReaction = null;
                localStorage.removeItem('article_' + articleId + '_reaction');
            } else {
                userReaction = type;
                localStorage.setItem('article_' + articleId + '_reaction', type);
            }
            
            // Send to server
            const response = await fetch('api/news-reaction.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({article_id: articleId, reaction: userReaction})
            });
            
            const data = await response.json();
            if (data.success) {
                likeCount.textContent = data.likes;
                dislikeCount.textContent = data.dislikes;
                
                // Update UI
                [likeBtn, dislikeBtn].forEach(btn => {
                    btn.classList.remove('active');
                    btn.querySelector('i').classList.remove('fas');
                    btn.querySelector('i').classList.add('far');
                });
                
                if (userReaction) {
                    const activeBtn = document.getElementById(userReaction + '-btn');
                    activeBtn.classList.add('active');
                    activeBtn.querySelector('i').classList.remove('far');
                    activeBtn.querySelector('i').classList.add('fas');
                }
            }
        }
    </script>
</body>

</html>