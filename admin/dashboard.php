<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

// Get statistics
$statsQuery = "
    SELECT 
        (SELECT COUNT(*) FROM news_articles) as total_articles,
        (SELECT COUNT(*) FROM news_articles WHERE is_published = 1) as published_articles,
        (SELECT SUM(views) FROM news_articles) as total_views,
        (SELECT SUM(likes) FROM news_articles) as total_likes
";
$stats = $pdo->query($statsQuery)->fetch();

// Get recent articles
$recentArticles = $pdo->query("
    SELECT id, title, category, is_published, views, created_at 
    FROM news_articles 
    ORDER BY created_at DESC 
    LIMIT 10
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Ensol Group News</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/ensol-group/admin/styles.css">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <img src="../assets/ensol_logo.jpg" alt="Ensol" class="admin-logo">
                <h3>News Admin</h3>
            </div>
            
            <nav class="admin-nav">
                <a href="/ensol-group/admin/dashboard.php" class="admin-nav-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/ensol-group/admin/news-list.php" class="admin-nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>All Articles</span>
                </a>
                <a href="/ensol-group/admin/news-editor.php" class="admin-nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Article</span>
                </a>
                <a href="../index.php" class="admin-nav-item" target="_blank">
                    <i class="fas fa-globe"></i>
                    <span>View Website</span>
                </a>
            </nav>
            
            <div class="admin-sidebar-footer">
                <div class="admin-user-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                </div>
                <a href="/ensol-group/admin/logout.php" class="admin-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #DC1609;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $stats['total_articles'] ?? 0; ?></h3>
                        <p>Total Articles</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #28a745;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $stats['published_articles'] ?? 0; ?></h3>
                        <p>Published</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #17a2b8;">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['total_views'] ?? 0); ?></h3>
                        <p>Total Views</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #ffc107;">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['total_likes'] ?? 0); ?></h3>
                        <p>Total Likes</p>
                    </div>
                </div>
            </div>
            
            <!-- Recent Articles -->
            <div class="admin-content-box">
                <div class="content-box-header">
                    <h2>Recent Articles</h2>
                    <a href="/ensol-group/admin/news-editor.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Article
                    </a>
                </div>
                
                <div class="articles-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentArticles as $article): ?>
                            <tr>
                                <td class="article-title"><?php echo htmlspecialchars($article['title']); ?></td>
                                <td><span class="category-badge"><?php echo htmlspecialchars($article['category']); ?></span></td>
                                <td>
                                    <?php if ($article['is_published']): ?>
                                        <span class="status-badge status-published">Published</span>
                                    <?php else: ?>
                                        <span class="status-badge status-draft">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo number_format($article['views']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($article['created_at'])); ?></td>
                                <td class="table-actions">
                                    <a href="/ensol-group/admin/news-editor.php?id=<?php echo $article['id']; ?>" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/ensol-group/admin/news-delete.php?id=<?php echo $article['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($recentArticles)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No articles yet. <a href="/ensol-group/admin/news-editor.php">Create your first article</a></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
