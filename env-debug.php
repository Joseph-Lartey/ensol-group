<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Environment Loading Debug</h1>";

// 1. Check if vendor autoload exists
$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    echo "<p style='color:green'>✅ vendor/autoload.php found at $autoloadPath</p>";
    require_once $autoloadPath;
} else {
    echo "<p style='color:red'>❌ vendor/autoload.php NOT found at $autoloadPath</p>";
    exit;
}

// 2. Check if .env file exists
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    echo "<p style='color:green'>✅ .env file found at $envPath</p>";
    
    // Check permissions
    $perms = substr(sprintf('%o', fileperms($envPath)), -4);
    echo "<p>File permissions: $perms</p>";
    
    // Check if readable
    if (is_readable($envPath)) {
        echo "<p style='color:green'>✅ .env file is readable</p>";
    } else {
        echo "<p style='color:red'>❌ .env file is NOT readable</p>";
    }
} else {
    echo "<p style='color:red'>❌ .env file NOT found at $envPath</p>";
}

// 3. Attempt to load .env
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    echo "<p style='color:green'>✅ Dotenv loaded successfully</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Dotenv failed to load: " . $e->getMessage() . "</p>";
}

// 4. Check specific variables (masked)
$varsToCheck = ['DB_HOST', 'DB_NAME', 'DB_USER', 'MAIL_HOST'];
echo "<h2>Variable Check</h2>";
echo "<ul>";
foreach ($varsToCheck as $var) {
    if (isset($_ENV[$var])) {
        echo "<li>✅ <strong>$var</strong> is set: " . htmlspecialchars($_ENV[$var]) . "</li>";
    } else {
        echo "<li>❌ <strong>$var</strong> is NOT set</li>";
    }
}
echo "</ul>";

// 5. Check constants from config.php
echo "<h2>Config Constant Check</h2>";
// Only include if you want to test the full config file logic
// require_once __DIR__ . '/includes/config.php'; 
// echo "DB_HOST Constant: " . (defined('DB_HOST') ? DB_HOST : 'Not Defined');

?>
