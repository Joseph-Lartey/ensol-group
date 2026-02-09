<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

// Get all articles with pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;
$offset = ($page - 1) * $perPage;

// Get total count
$totalCount = $pdo->query("SELECT COUNT(*) FROM news_articles")->fetchColumn();
$totalPages = ceil($totalCount / $perPage);

// Get articles
$stmt = $pdo->prepare("
    SELECT id, title, category, is_published, views, likes, created_at 
    FROM news_articles 
    ORDER BY created_at DESC 
    LIMIT ? OFFSET ?
");
$stmt->execute([$perPage, $offset]);
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles | Ensol News Admin</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
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
                <a href="dashboard.php" class="admin-nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="news-list.php" class="admin-nav-item active">
                    <i class="fas fa-newspaper"></i>
                    <span>All Articles</span>
                </a>
                <a href="news-editor.php" class="admin-nav-item">
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
                <a href="logout.php" class="admin-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>All Articles</h1>
                <p>Manage all your news articles</p>
            </div>
            
            <!-- Articles Table -->
            <div class="admin-content-box">
                <div class="content-box-header">
                    <h2>Articles (<?php echo $totalCount; ?>)</h2>
                    <a href="news-editor.php" class="btn btn-primary">
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
                                <th>Likes</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
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
                                <td><?php echo number_format($article['likes']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($article['created_at'])); ?></td>
                                <td class="table-actions">
                                    <?php if (!$article['is_published']): ?>
                                        <button onclick="togglePublish(<?php echo $article['id']; ?>, this)" class="btn-action btn-publish" title="Publish" style="background: #d4edda; color: #28a745;">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    <?php else: ?>
                                        <button onclick="togglePublish(<?php echo $article['id']; ?>, this)" class="btn-action btn-unpublish" title="Unpublish" style="background: #fff3cd; color: #856404;">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    <?php endif; ?>
                                    <a href="news-editor.php?id=<?php echo $article['id']; ?>" class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="news-delete.php?id=<?php echo $article['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this article?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($articles)): ?>
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px;">
                                    No articles yet. <a href="news-editor.php">Create your first article</a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div style="padding: 20px; text-align: center;">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" 
                           class="btn <?php echo $i === $page ? 'btn-primary' : 'btn-secondary'; ?>" 
                           style="margin: 0 4px;">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <script>
        async function togglePublish(articleId, button) {
            const row = button.closest('tr');
            const statusBadge = row.querySelector('.status-badge');
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            try {
                const response = await fetch('news-toggle-publish.php?id=' + articleId);
                const data = await response.json();
                
                if (data.success) {
                    // Update status badge
                    if (data.is_published) {
                        statusBadge.className = 'status-badge status-published';
                        statusBadge.textContent = 'Published';
                        button.style.background = '#fff3cd';
                        button.style.color = '#856404';
                        button.title = 'Unpublish';
                        button.innerHTML = '<i class="fas fa-eye-slash"></i>';
                    } else {
                        statusBadge.className = 'status-badge status-draft';
                        statusBadge.textContent = 'Draft';
                        button.style.background = '#d4edda';
                        button.style.color = '#28a745';
                        button.title = 'Publish';
                        button.innerHTML = '<i class="fas fa-upload"></i>';
                    }
                } else {
                    alert('Error: ' + data.message);
                    button.innerHTML = '<i class="fas fa-upload"></i>';
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
                button.innerHTML = '<i class="fas fa-upload"></i>';
            }
            
            button.disabled = false;
        }
    </script>
</body>
</html>
