<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'No article ID provided']);
    exit;
}

$id = (int)$_GET['id'];

try {
    // Toggle publish status
    $stmt = $pdo->prepare("SELECT is_published FROM news_articles WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();
    
    if (!$article) {
        echo json_encode(['success' => false, 'message' => 'Article not found']);
        exit;
    }
    
    $newStatus = $article['is_published'] ? 0 : 1;
    $publishedAt = $newStatus ? date('Y-m-d H:i:s') : null;
    
    $stmt = $pdo->prepare("UPDATE news_articles SET is_published = ?, published_at = ? WHERE id = ?");
    $stmt->execute([$newStatus, $publishedAt, $id]);
    
    $statusText = $newStatus ? 'published' : 'unpublished';
    echo json_encode([
        'success' => true, 
        'message' => 'Article ' . $statusText . ' successfully',
        'is_published' => $newStatus
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error toggling publish status']);
}
?>
