<?php
/**
 * Database Connection Test Script v2
 * Bypasses getenv() to test direct connection with parsed values.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Debugger v2</h1>";

$envPath = __DIR__ . '/.env';
$config = [];

if (file_exists($envPath)) {
    echo "<p style='color:green'>Found .env file.</p>";
    
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            // Remove quotes
            if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            $config[$key] = $value;
        }
    }
} else {
    echo "<p style='color:red'>.env file NOT found.</p>";
}

echo "<h2>Configuration Loaded (Direct Read)</h2>";
echo "<pre>";
foreach ($config as $k => $v) {
    if (in_array($k, ['DB_PASS', 'MAIL_PASSWORD'])) {
        echo "$k = [MASKED]\n";
    } else {
        echo "$k = " . htmlspecialchars($v) . "\n";
    }
}
echo "</pre>";

$host = $config['DB_HOST'] ?? 'NOT_SET';
$name = $config['DB_NAME'] ?? 'NOT_SET';
$user = $config['DB_USER'] ?? 'NOT_SET';
$pass = $config['DB_PASS'] ?? 'NOT_SET';

echo "<h2>Connection Attempt</h2>";
echo "Host: " . htmlspecialchars($host) . "<br>";
echo "User: " . htmlspecialchars($user) . "<br>";

try {
    $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";
    echo "DSN: $dsn<br>";
    
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<h3 style='color:green'>SUCCESS! Connected to database.</h3>";
    echo "<p>The issue is likely that PHP's <code>getenv()</code> or <code>\$_ENV</code> is not persisting on this server.</p>";
    echo "<p><strong>Recommendation:</strong> We should update <code>config.php</code> to use a more robust loading mechanism.</p>";
} catch (PDOException $e) {
    echo "<h3 style='color:red'>CONNECTION FAILED</h3>";
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Check your credentials in .env carefully.";
}
?>
