<?php
/**
 * Ensol Group Configuration
 * Robsust version: Reads .env directly, bypasses getenv() issues, forces 127.0.0.1
 */

// Enable error reporting for debugging (disable in production)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Handle line endings for cross-OS compatibility
ini_set('auto_detect_line_endings', true);

// 1. Manually parse .env into a local array
$envFilePath = __DIR__ . '/../.env';
$envConfig = [];

if (file_exists($envFilePath)) {
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '#') === 0) continue; // Skip comments
        
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            
            $envConfig[$key] = $value;
        }
    }
} else {
    // If .env is missing, we can't proceed
    die("Configuration Error: .env file not found at $envFilePath");
}

// 2. Define Helper to get values from our local array
function getEnvVal($key, $default = null) {
    global $envConfig;
    return isset($envConfig[$key]) && $envConfig[$key] !== '' ? $envConfig[$key] : $default;
}

// 3. Database Configuration
// FORCE 127.0.0.1 to fix "No such file or directory" socket error
$dbHost = getEnvVal('DB_HOST', '127.0.0.1');
if ($dbHost === 'localhost') $dbHost = '127.0.0.1';

define('DB_HOST', $dbHost);
define('DB_NAME', getEnvVal('DB_NAME'));
define('DB_USER', getEnvVal('DB_USER'));
define('DB_PASS', getEnvVal('DB_PASS'));
define('DB_CHARSET', 'utf8mb4');

// 4. Verify Critical Config
if (!defined('DB_NAME') || !DB_NAME || !defined('DB_USER') || !DB_USER) {
    die("Database configuration missing. Please check your .env file. parsed_host=" . DB_HOST);
}

// 5. Email Configuration
define('MAIL_HOST', getEnvVal('MAIL_HOST'));
define('MAIL_PORT', getEnvVal('MAIL_PORT', 587));
define('MAIL_USERNAME', getEnvVal('MAIL_USERNAME'));
define('MAIL_PASSWORD', getEnvVal('MAIL_PASSWORD'));
define('MAIL_FROM_EMAIL', getEnvVal('MAIL_FROM_EMAIL'));
define('MAIL_FROM_NAME', getEnvVal('MAIL_FROM_NAME', 'Ensol Group'));
define('MAIL_TO', getEnvVal('MAIL_TO'));

// 6. Site Configuration
define('SITE_URL', getEnvVal('SITE_URL', 'https://ensolgroup.com.gh'));
define('SITE_NAME', getEnvVal('SITE_NAME', 'Ensol Group'));

// 7. Database Connection
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

// 8. Session & Auth Helpers
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
    $projectRoot = dirname(__DIR__) . '/'; // Goes up from includes/
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
        throw new Exception('Failed to upload image. Path: ' . $absoluteFilepath);
    }
    
    return $uploadDir . $filename;
}

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}
?>
