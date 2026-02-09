<?php
require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$articleId = (int)($input['article_id'] ?? 0);
$reaction = $input['reaction'] ?? null; // 'like', 'dislike', or null to remove

if ($articleId <= 0) {
    echo json_encode(['success' => false]);
    exit;
}

try {
    $userIp = getClientIP();
    
    // Remove existing reaction
    $pdo->prepare("DELETE FROM news_reactions WHERE article_id = ? AND user_ip = ?")->execute([$articleId, $userIp]);
    
    // Add new reaction if provided
    if ($reaction === 'like' || $reaction === 'dislike') {
        $pdo->prepare("INSERT INTO news_reactions (article_id, user_ip, reaction_type) VALUES (?, ?, ?)")
            ->execute([$articleId, $userIp, $reaction]);
    }
    
    // Recalculate counts
    $likes = $pdo->query("SELECT COUNT(*) FROM news_reactions WHERE article_id = $articleId AND reaction_type = 'like'")->fetchColumn();
    $dislikes = $pdo->query("SELECT COUNT(*) FROM news_reactions WHERE article_id = $articleId AND reaction_type = 'dislike'")->fetchColumn();
    
    // Update article
    $pdo->prepare("UPDATE news_articles SET likes = ?, dislikes = ? WHERE id = ?")->execute([$likes, $dislikes, $articleId]);
    
    echo json_encode(['success' => true, 'likes' => $likes, 'dislikes' => $dislikes]);
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}
?>
