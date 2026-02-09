<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        // Get article image to delete file
        $stmt = $pdo->prepare("SELECT featured_image FROM news_articles WHERE id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch();
        
        if ($article) {
            // Delete article
            $stmt = $pdo->prepare("DELETE FROM news_articles WHERE id = ?");
            $stmt->execute([$id]);
            
            // Delete image file
            if ($article['featured_image'] && file_exists($article['featured_image'])) {
                unlink($article['featured_image']);
            }
        }
        
        header('Location: /ensol-group/admin/dashboard.php?deleted=1');
    } catch (PDOException $e) {
        header('Location: /ensol-group/admin/dashboard.php?error=1');
    }
} else {
    header('Location: /ensol-group/admin/dashboard.php');
}
?>
