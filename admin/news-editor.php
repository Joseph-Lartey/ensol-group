<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

$editMode = false;
$article = null;

// Check if editing existing article
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM news_articles WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch();
    $editMode = $article ? true : false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editMode ? 'Edit' : 'Create'; ?> Article | Ensol News Admin</title>
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
                <a href="/ensol-group/admin/dashboard.php" class="admin-nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/ensol-group/admin/news-list.php" class="admin-nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>All Articles</span>
                </a>
                <a href="/ensol-group/admin/news-editor.php" class="admin-nav-item active">
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
            <div class="editor-container">
                <div class="admin-header">
                    <h1><?php echo $editMode ? 'Edit Article' : 'Create New Article'; ?></h1>
                    <p><?php echo $editMode ? 'Update your article details below' : 'Fill in the details to create a new article'; ?></p>
                </div>
                
                <div id="message-box" style="display: none; padding: 16px; border-radius: 8px; margin-bottom: 20px;"></div>
                
                <form id="article-form" class="editor-form" enctype="multipart/form-data">
                    <input type="hidden" name="article_id" value="<?php echo $article['id'] ?? ''; ?>">
                    
                    <div class="form-group">
                        <label for="title">Article Title *</label>
                        <input type="text" id="title" name="title" class="form-control" 
                               placeholder="Enter article title" 
                               value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select category</option>
                            <option value="Partnership" <?php echo ($article['category'] ?? '') === 'Partnership' ? 'selected' : ''; ?>>Partnership</option>
                            <option value="Award" <?php echo ($article['category'] ?? '') === 'Award' ? 'selected' : ''; ?>>Award</option>
                            <option value="Project" <?php echo ($article['category'] ?? '') === 'Project' ? 'selected' : ''; ?>>Project</option>
                            <option value="Renewable Energy" <?php echo ($article['category'] ?? '') === 'Renewable Energy' ? 'selected' : ''; ?>>Renewable Energy</option>
                            <option value="Company News" <?php echo ($article['category'] ?? '') === 'Company News' ? 'selected' : ''; ?>>Company News</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="summary">Summary *</label>
                        <textarea id="summary" name="summary" class="form-control" rows="3" 
                                  placeholder="Brief summary of the article (2-3 sentences)" 
                                  required><?php echo htmlspecialchars($article['summary'] ?? ''); ?></textarea>
                        <small style="color: #666;">This will appear on the news listing page</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Article Content *</label>
                        <textarea id="content" name="content" class="form-control" rows="15" 
                                  placeholder="Write your article content here..." 
                                  required><?php echo htmlspecialchars($article['content'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="featured_image">Featured Image *</label>
                        <?php if ($editMode && $article['featured_image']): ?>
                            <div style="margin-bottom: 12px;">
                                <img src="<?php echo htmlspecialchars($article['featured_image']); ?>" 
                                     alt="Current image" style="max-width: 300px; border-radius: 8px;">
                                <p style="color: #666; font-size: 14px; margin-top: 8px;">Current image. Upload a new one to replace it.</p>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="featured_image" name="featured_image" class="form-control" 
                               accept="image/jpeg,image/jpg,image/png,image/webp" 
                               <?php echo $editMode ? '' : 'required'; ?>>
                        <small style="color: #666;">JPG, PNG, or WebP. Max 5MB</small>
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_published" value="1" 
                                   <?php echo ($article['is_published'] ?? false) ? 'checked' : ''; ?>>
                            Publish immediately
                        </label>
                    </div>
                    
                    <div class="form-actions">
                        <a href="/ensol-group/admin/dashboard.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <i class="fas fa-save"></i> <?php echo $editMode ? 'Update' : 'Create'; ?> Article
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <script>
        document.getElementById('article-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submit-btn');
            const messageBox = document.getElementById('message-box');
            const formData = new FormData(this);
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            try {
                const response = await fetch('/ensol-group/admin/news-save.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageBox.style.display = 'block';
                    messageBox.style.background = '#d4edda';
                    messageBox.style.color = '#155724';
                    messageBox.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                    
                    setTimeout(() => {
                        window.location.href = '/ensol-group/admin/dashboard.php';
                    }, 1500);
                } else {
                    messageBox.style.display = 'block';
                    messageBox.style.background = '#f8d7da';
                    messageBox.style.color = '#721c24';
                    messageBox.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + data.message;
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo $editMode ? 'Update' : 'Create'; ?> Article';
                }
            } catch (error) {
                messageBox.style.display = 'block';
                messageBox.style.background = '#f8d7da';
                messageBox.style.color = '#721c24';
                messageBox.innerHTML = '<i class="fas fa-exclamation-circle"></i> An error occurred. Please try again.';
                
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo $editMode ? 'Update' : 'Create'; ?> Article';
            }
        });
    </script>
</body>
</html>
