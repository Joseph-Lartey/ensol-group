<?php
// env-debug-v2.php
// Purpose: Deep debugging of .env loading and Caching issues

// 1. Disable internal caching if possible
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 2. Enable Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Environment & Cache Debug (v2)</h1>";
echo "<p><strong>Server Time:</strong> " . date('Y-m-d H:i:s') . "</p>";

// 3. Try to clear OPcache
if (function_exists('opcache_reset')) {
    try {
        if (opcache_reset()) {
            echo "<p style='color:green'>✅ OPcache reset successfully.</p>";
        } else {
            echo "<p style='color:orange'>⚠️ OPcache reset returned false.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ Error resetting OPcache: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:gray'>ℹ️ OPcache functions not available.</p>";
}

// 4. Check .env file details on disk
$envPath = __DIR__ . '/.env';
echo "<h2>File System Check</h2>";
if (file_exists($envPath)) {
    echo "<p style='color:green'>✅ .env found.</p>";
    echo "<p><strong>Last Modified:</strong> " . date('Y-m-d H:i:s', filemtime($envPath)) . "</p>";
    echo "<p><strong>File Size:</strong> " . filesize($envPath) . " bytes</p>";
    
    // READ RAW CONTENT (Masked for security)
    echo "<h3>Raw .env Content (First 5 chars of values shown)</h3>";
    $content = file_get_contents($envPath);
    $lines = explode("\n", $content);
    echo "<pre style='background:#f4f4f4; padding:10px;'>";
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) {
            echo htmlspecialchars($line) . "\n";
            continue;
        }
        
        $parts = explode('=', $line, 2);
        if (count($parts) == 2) {
            $key = $parts[0];
            $val = $parts[1];
            // Mask value
            $maskedVal = substr($val, 0, 5) . '...';
            echo htmlspecialchars("$key=$maskedVal") . "\n";
        } else {
            echo htmlspecialchars($line) . "\n";
        }
    }
    echo "</pre>";
} else {
    echo "<p style='color:red'>❌ .env file NOT found at $envPath</p>";
}

// 5. Load Dotenv (Mutable to overwrite any existing env vars)
echo "<h2>Dotenv Loading</h2>";
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    
    try {
        // Use createMutable to force update if variables are somehow already set by server
        $dotenv = Dotenv\Dotenv::createMutable(__DIR__);
        $dotenv->load();
        echo "<p style='color:green'>✅ Dotenv loaded (Mutable mode)</p>";
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ Dotenv Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red'>❌ vendor/autoload.php missing. Try running 'composer install'.</p>";
}

// 6. Config Value Verification
echo "<h2>Loaded Variables</h2>";
$checkVars = ['DB_HOST', 'DB_NAME', 'DB_USER', 'MAIL_HOST', 'MAIL_USERNAME'];

echo "<table border='1' cellpadding='5'><tr><th>Variable</th><th>\$_ENV Value</th><th>getenv() Value</th></tr>";
foreach ($checkVars as $var) {
    $envVal = isset($_ENV[$var]) ? substr($_ENV[$var], 0, 5) . '...' : '<span style="color:red">NOT SET</span>';
    $getEnvVal = getenv($var) ? substr(getenv($var), 0, 5) . '...' : '<span style="color:red">NOT SET</span>';
    
    echo "<tr><td>$var</td><td>$envVal</td><td>$getEnvVal</td></tr>";
}
echo "</table>";
?>
