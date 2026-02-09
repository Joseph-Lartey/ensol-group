<?php
/**
 * Database Debugger Tool (db-debug.php)
 * This script dumps the raw content of .env to debug why variables are missing.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('auto_detect_line_endings', true);

echo "<h1>Ensol Group - Database Debugger v3</h1>";
echo "<p>Generated at: " . date('Y-m-d H:i:s') . "</p>";

$envPath = __DIR__ . '/.env';

echo "<h2>1. File Inspection</h2>";
echo "Looking for .env at: <code>" . $envPath . "</code><br>";

if (!file_exists($envPath)) {
    die("<h3 style='color:red'>ERROR: .env file NOT found!</h3>");
}

echo "<p style='color:green'>Found .env file.</p>";
echo "File size: " . filesize($envPath) . " bytes<br>";
echo "File permissions: " . substr(sprintf('%o', fileperms($envPath)), -4) . "<br>";

echo "<h2>2. Raw Content Dump</h2>";
echo "<p>Below is the exact content of your .env file as PHP sees it. <br><strong>Check if your DB credentials are visible here.</strong></p>";

$content = file_get_contents($envPath);
$lines = explode("\n", $content);

echo "<div style='background:#f5f5f5; padding:10px; border:1px solid #ccc; font-family:monospace;'>";
$lineNumber = 1;

foreach ($lines as $line) {
    if (trim($line) === '') continue;
    
    // Mask sensitive values for display
    $displayLine = $line;
    if (preg_match('/(DB_PASS|MAIL_PASSWORD|DB_USER|DB_NAME|DB_HOST)=/', $line)) {
        $parts = explode('=', $line, 2);
        if (count($parts) == 2) {
            $value = trim($parts[1]);
            // Show first 2 chars of value to confirm it exists
            $displayLine = $parts[0] . "=" . substr($value, 0, 2) . "**** (length: " . strlen($value) . ")";
        }
    }
    
    echo sprintf("%02d: %s", $lineNumber, htmlspecialchars($displayLine)) . "<br>";
    $lineNumber++;
}
echo "</div>";

echo "<h2>3. Connection Test</h2>";

// Manual parsing to be sure
$config = [];
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    if (strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $config[trim($key)] = trim(trim($value), "\"'");
    }
}

$host = $config['DB_HOST'] ?? null;
$name = $config['DB_NAME'] ?? null;
$user = $config['DB_USER'] ?? null;
$pass = $config['DB_PASS'] ?? null;

echo "<strong>Parsed Configuration:</strong><br>";
echo "DB_HOST: " . ($host ?? '<span style="color:red">MISSING</span>') . "<br>";
echo "DB_NAME: " . ($name ?? '<span style="color:red">MISSING</span>') . "<br>";
echo "DB_USER: " . ($user ?? '<span style="color:red">MISSING</span>') . "<br>";

if ($host && $name && $user) {
    try {
        $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        echo "<h3 style='color:green'>✅ CONNECTION SUCCESSFUL</h3>";
    } catch (PDOException $e) {
        echo "<h3 style='color:red'>❌ CONNECTION FAILED</h3>";
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<h3 style='color:red'>❌ SKIPPING CONNECTION TEST (Missing Config)</h3>";
}
?>
