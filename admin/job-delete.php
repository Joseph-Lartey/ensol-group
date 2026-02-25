<?php
require_once __DIR__ . '/../includes/config.php';

// Ensure user is logged in
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: jobs-list.php');
    exit;
}

try {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM job_postings WHERE id = ?");
        if ($stmt->execute([$id])) {
            $_SESSION['success_msg'] = "Job posting deleted successfully.";
        } else {
            $_SESSION['error_msg'] = "Failed to delete job posting.";
        }
    } else {
        $_SESSION['error_msg'] = "Invalid job ID.";
    }
} catch (Exception $e) {
    $_SESSION['error_msg'] = "Error deleting job: " . $e->getMessage();
}

header('Location: jobs-list.php');
exit;
