<?php
require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

try {
    // Get current status
    $stmt = $pdo->prepare("SELECT is_active FROM job_postings WHERE id = ?");
    $stmt->execute([$id]);
    $job = $stmt->fetch();

    if (!$job) {
        echo json_encode(['success' => false, 'message' => 'Job not found']);
        exit;
    }

    // Toggle status
    $newStatus = $job['is_active'] ? 0 : 1;

    $updateStmt = $pdo->prepare("UPDATE job_postings SET is_active = ? WHERE id = ?");
    $updateStmt->execute([$newStatus, $id]);

    echo json_encode([
        'success' => true,
        'is_active' => (bool)$newStatus,
        'message' => 'Status updated successfully'
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
