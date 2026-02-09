<?php
/**
 * Database Connection Test Script
 * Upload this file to your server root (where .env is located) to debug connection issues.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Debugger</h1>";

// 1. Check .env file location
$envPath = __DIR__ . '/.env';
echo "<h2>1. Environment File</h2>";
echo "Looking for .env at: " . $envPath . "<br>";

if (file_exists($envPath)) {
    echo "<span style='color:green'>Found .env file.</span><br>";
    
    // Read .env content manually to verify what PHP sees
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo "<h3>.env Contents (values masked):</h3>";
    echo "<pre>";
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            // Mask sensitive data
            if (in_array($key, ['DB_PASS', 'MAIL_PASSWORD', 'DB_USER', 'DB_NAME', 'DB_HOST'])) {
                echo "$key = " . substr($value, 0, 2) . "****" . "<br>";
            } else {
                echo "$key = $value<br>";
            }
        }
    }
    echo "</pre>";

} else {
    echo "<span style='color:red'>ERROR: .env file NOT found.</span><br>";
    echo "Current directory: " . __DIR__ . "<br>";
    echo "Please ensure .env is uploaded to this directory.<br>";
}

// 2. Load Config logic (simulated)
echo "<h2>2. Connection Attempt</h2>";

function loadEnvDebug($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) $value = $matches[2];
            if (!isset($_ENV[$key])) $_ENV[$key] = $value;
            if (!getenv($key)) putenv("$key=$value");
        }
    }
}

loadEnvDebug($envPath);

$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
$name = $_ENV['DB_NAME'] ?? getenv('DB_NAME');
$user = $_ENV['DB_USER'] ?? getenv('DB_USER');
$pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');

echo "Attempting to connect with:<br>";
echo "Host: " . ($host ? htmlspecialchars($host) : 'NULL') . "<br>";
echo "Database: " . ($name ? htmlspecialchars($name) : 'NULL') . "<br>";
echo "User: " . ($user ? htmlspecialchars($user) : 'NULL') . "<br>";
echo "Password: " . ($pass ? "****" : 'NULL') . "<br>";

try {
    $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<h3 style='color:green'>SUCCESS! Connected to database.</h3>";
} catch (PDOException $e) {
    echo "<h3 style='color:red'>CONNECTION FAILED</h3>";
    echo "Error: " . $e->getMessage() . "<br>";
}
?>
