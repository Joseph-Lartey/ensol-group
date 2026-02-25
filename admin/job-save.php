<?php
require_once __DIR__ . '/../includes/config.php';

// Ensure user is logged in
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: jobs-list.php');
    exit;
}

try {
    $id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
    $title = trim($_POST['title']);
    $subsidiary = trim($_POST['subsidiary']);
    $category = trim($_POST['category']);
    $location = trim($_POST['location']);
    $job_type = trim($_POST['job_type']);
    $description = trim($_POST['description']);
    $requirements = trim($_POST['requirements']);
    $application_link = isset($_POST['application_link']) ? trim($_POST['application_link']) : null;
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Generate slug from title
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    // Ensure slug is unique
    $slugBase = $slug;
    $counter = 1;
    while (true) {
        $checkStmt = $pdo->prepare("SELECT id FROM job_postings WHERE slug = ? AND id != ?");
        $checkStmt->execute([$slug, $id ?? 0]);
        if ($checkStmt->rowCount() == 0) {
            break;
        }
        $slug = $slugBase . '-' . $counter;
        $counter++;
    }

    if ($id) {
        // Update existing job
        $stmt = $pdo->prepare("
            UPDATE job_postings 
            SET title = ?, slug = ?, subsidiary = ?, category = ?, location = ?, 
                job_type = ?, description = ?, requirements = ?, application_link = ?, is_active = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $title,
            $slug,
            $subsidiary,
            $category,
            $location,
            $job_type,
            $description,
            $requirements,
            $application_link,
            $is_active,
            $id
        ]);
        $_SESSION['success_msg'] = "Job posting updated successfully.";
    } else {
        // Insert new job
        $stmt = $pdo->prepare("
            INSERT INTO job_postings 
            (title, slug, subsidiary, category, location, job_type, description, requirements, application_link, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $title,
            $slug,
            $subsidiary,
            $category,
            $location,
            $job_type,
            $description,
            $requirements,
            $application_link,
            $is_active
        ]);
        $_SESSION['success_msg'] = "Job posting created successfully.";
    }
} catch (Exception $e) {
    $_SESSION['error_msg'] = "Error saving job: " . $e->getMessage();
}

header('Location: jobs-list.php');
exit;
