<?php
/**
 * Ensol Group Configuration
 * HARDCODED VERSION - No .env file dependency
 */

// Enable error reporting for debugging (disable in production if needed)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// ============================================
// DATABASE CREDENTIALS (UPDATE THESE!)
// ============================================
define('DB_HOST', '127.0.0.1');             // Keep as 127.0.0.1 for cPanel
define('DB_NAME', 'ensolgroupe_ensol_news'); // UPDATE THIS with your cPanel DB name
define('DB_USER', 'ensolgroupe_ensol_admin'); // UPDATE THIS with your cPanel DB user
define('DB_PASS', 'ENTER_PASSWORD_HERE');     // UPDATE THIS with your cPanel DB password
define('DB_CHARSET', 'utf8mb4');

// ============================================
// SITE CONFIGURATION
// ============================================
define('SITE_URL', 'https://ensolgroup.com.gh');
define('SITE_NAME', 'Ensol Group');

// ============================================
// EMAIL CONFIGURATION
// ============================================
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'josephlartey414@gmail.com');
define('MAIL_PASSWORD', 'ENTER_MAIL_PASSWORD_HERE'); // UPDATE THIS
define('MAIL_FROM_EMAIL', 'josephlartey414@gmail.com');
define('MAIL_FROM_NAME', 'Ensol Group');
define('MAIL_TO', 'info@ensolgroup.com.gh');


// ============================================
// LOGIC (DO NOT EDIT BELOW)
// ============================================

// Database connection
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Session & Auth
session_start();

function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function generateSlug($title) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
}

function calculateReadTime($content) {
    $wordCount = str_word_count(strip_tags($content));
    $minutes = ceil($wordCount / 200);
    return max(1, $minutes);
}

function uploadImage($file, $uploadDir = 'uploads/news/') {
    $projectRoot = dirname(__DIR__) . '/';
    $absoluteUploadDir = $projectRoot . $uploadDir;
    
    if (!file_exists($absoluteUploadDir)) {
        mkdir($absoluteUploadDir, 0755, true);
    }
    
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPG, PNG, and WebP allowed.');
    }
    
    if ($file['size'] > $maxSize) {
        throw new Exception('File too large. Maximum size is 5MB.');
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('news_', true) . '.' . $extension;
    $absoluteFilepath = $absoluteUploadDir . $filename;
    
    if (!move_uploaded_file($file['tmp_name'], $absoluteFilepath)) {
        throw new Exception('Failed to upload image.');
    }
    
    return $uploadDir . $filename;
}

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}
?>
