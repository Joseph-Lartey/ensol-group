<?php
/**
 * Ensol Group Configuration
 * FINAL WORKING VERSION - Localhost Email & 127.0.0.1 DB
 */

// Enable error reporting for debugging (disable in production if needed)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// ============================================
// DATABASE CREDENTIALS
// ============================================
// Check if vendor/autoload.php exists and load it (for Dotenv)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // Load .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();
}

// ============================================
// DATABASE CREDENTIALS
// ============================================
define('DB_HOST', $_ENV['DB_HOST'] ?? '127.0.0.1');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'ensolgroupe_ensol_news');
define('DB_USER', $_ENV['DB_USER'] ?? 'ensolgroupe_ensol_admin');
define('DB_PASS', $_ENV['DB_PASS'] ?? 'Freshboy8!');
define('DB_CHARSET', $_ENV['DB_CHARSET'] ?? 'utf8mb4');

// ============================================
// SITE CONFIGURATION
// ============================================
define('SITE_URL', $_ENV['SITE_URL'] ?? 'https://ensolgroup.com.gh');
define('SITE_NAME', $_ENV['SITE_NAME'] ?? 'Ensol Group');

// ============================================
// EMAIL CONFIGURATION
// ============================================
define('MAIL_HOST', $_ENV['MAIL_HOST'] ?? 'localhost');
define('MAIL_PORT', $_ENV['MAIL_PORT'] ?? 25);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME'] ?? 'noreply@ensolgroup.com.gh');
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD'] ?? 'Ensouth2025');

define('MAIL_FROM_EMAIL', $_ENV['MAIL_FROM_EMAIL'] ?? 'noreply@ensolgroup.com.gh');
define('MAIL_FROM_NAME', $_ENV['MAIL_FROM_NAME'] ?? 'Ensol Group Website');
define('MAIL_TO', $_ENV['MAIL_TO'] ?? 'j.lartey@ensolenergygh.com');


// ============================================
// LOGIC
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
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
