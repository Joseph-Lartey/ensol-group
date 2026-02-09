<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

try {
    // Get form data
    $articleId = isset($_POST['article_id']) && !empty($_POST['article_id']) ? (int)$_POST['article_id'] : null;
    $title = sanitize($_POST['title'] ?? '');
    $category = sanitize($_POST['category'] ?? '');
    $summary = sanitize($_POST['summary'] ?? '');
    $content = $_POST['content'] ?? ''; // Don't sanitize - preserve HTML formatting
    $isPublished = isset($_POST['is_published']) ? 1 : 0;
    
    // Validation
    if (empty($title) || empty($category) || empty($summary) || empty($content)) {
        throw new Exception('Please fill in all required fields');
    }
    
    // Generate slug
    $slug = generateSlug($title);
    
    // Calculate read time
    $readTime = calculateReadTime($content);
    
    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = uploadImage($_FILES['featured_image']);
    } elseif ($articleId) {
        // Keep existing image if editing
        $stmt = $pdo->prepare("SELECT featured_image FROM news_articles WHERE id = ?");
        $stmt->execute([$articleId]);
        $existing = $stmt->fetch();
        $imagePath = $existing['featured_image'] ?? null;
    }
    
    if (!$imagePath) {
        throw new Exception('Featured image is required');
    }
    
    // Check for duplicate slug (excluding current article if editing)
    if ($articleId) {
        $stmt = $pdo->prepare("SELECT id FROM news_articles WHERE slug = ? AND id != ?");
        $stmt->execute([$slug, $articleId]);
    } else {
        $stmt = $pdo->prepare("SELECT id FROM news_articles WHERE slug = ?");
        $stmt->execute([$slug]);
    }
    
    if ($stmt->fetch()) {
        $slug .= '-' . time(); // Make unique
    }
    
    // Save to database
    if ($articleId) {
        // Update existing article
        $stmt = $pdo->prepare("
            UPDATE news_articles 
            SET title = ?, slug = ?, summary = ?, content = ?, 
                featured_image = ?, category = ?, read_time = ?, 
                is_published = ?, published_at = ?
            WHERE id = ?
        ");
        
        $publishedAt = $isPublished ? ($existing['published_at'] ?? date('Y-m-d H:i:s')) : null;
        
        $stmt->execute([
            $title, $slug, $summary, $content, 
            $imagePath, $category, $readTime, 
            $isPublished, $publishedAt, $articleId
        ]);
        
        $message = 'Article updated successfully!';
    } else {
        // Create new article
        $stmt = $pdo->prepare("
            INSERT INTO news_articles 
            (title, slug, summary, content, featured_image, category, 
             author_id, read_time, is_published, published_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $publishedAt = $isPublished ? date('Y-m-d H:i:s') : null;
        
        $stmt->execute([
            $title, $slug, $summary, $content, $imagePath, $category,
            $_SESSION['admin_id'], $readTime, $isPublished, $publishedAt
        ]);
        
        $message = 'Article created successfully!';
    }
    
    echo json_encode(['success' => true, 'message' => $message]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
