<?php
/**
 * Load environment variables from .env file
 */
function loadEnv($path) {
    if (!file_exists($path)) {
        die('.env file not found. Please copy .env.example to .env and configure it.');
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            
            // Set in both $_ENV and putenv for compatibility
            if (!isset($_ENV[$key])) {
                $_ENV[$key] = $value;
            }
            if (!getenv($key)) {
                putenv("$key=$value");
            }
        }
    }
}

// Enable support for mac/legacy line endings
ini_set('auto_detect_line_endings', true);

// Load .env file
loadEnv(__DIR__ . '/../.env');

// Helper function to get env variable with default
function env($key, $default = null) {
    if (!isset($_ENV[$key]) && !getenv($key)) {
        return $default;
    }
    $value = $_ENV[$key] ?? getenv($key);
    return $value !== false ? $value : $default;
}

// Database configuration - read from .env
// Default to 127.0.0.1 to avoid socket errors on cPanel
define('DB_HOST', env('DB_HOST', '127.0.0.1'));
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASS', env('DB_PASS'));

// Verify critical configuration
if (!DB_NAME || !DB_USER) {
    // Check if we are in a debug script context to avoid double output
    if (basename($_SERVER['SCRIPT_NAME']) !== 'db-debug.php') {
        die("Configuration Error: DB_NAME or DB_USER is missing. Please check your .env file.");
    }
}

define('DB_CHARSET', 'utf8mb4');

// Email configuration
define('MAIL_HOST', env('MAIL_HOST'));
define('MAIL_PORT', env('MAIL_PORT'));
define('MAIL_USERNAME', env('MAIL_USERNAME'));
define('MAIL_PASSWORD', env('MAIL_PASSWORD'));
define('MAIL_FROM_EMAIL', env('MAIL_FROM_EMAIL'));
define('MAIL_FROM_NAME', env('MAIL_FROM_NAME'));
define('MAIL_TO', env('MAIL_TO'));

// Site configuration
define('SITE_URL', env('SITE_URL'));
define('SITE_NAME', env('SITE_NAME'));

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

// Admin session management
session_start();

/**
 * Check if user is logged in as admin
 */
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

/**
 * Require admin login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Sanitize input
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Generate URL slug from title
 */
function generateSlug($title) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    return $slug;
}

/**
 * Calculate read time from content
 */
function calculateReadTime($content) {
    $wordCount = str_word_count(strip_tags($content));
    $minutes = ceil($wordCount / 200); // Average reading speed: 200 words per minute
    return max(1, $minutes);
}

/**
 * Upload image
 */
function uploadImage($file, $uploadDir = 'uploads/news/') {
    // Use absolute path from project root
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
    
    // Return relative path for database storage
    return $uploadDir . $filename;
}

/**
 * Get client IP address
 */
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>
