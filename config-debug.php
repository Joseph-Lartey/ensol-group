<?php
// config-debug.php
// Debugging the inclusion of includes/config.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Config Loading Debug</h1>";
echo "<p>Starting debug process...</p>";

// 1. Check file existence
$configPath = __DIR__ . '/includes/config.php';
if (file_exists($configPath)) {
    echo "<p>✅ includes/config.php found.</p>";
} else {
    die("<p>❌ includes/config.php NOT found at $configPath</p>");
}

// 2. define a test mode to avoid redirects in config.php if any
// (config.php doesn't seem to have redirects on load, but good practice)

// 3. Include config.php inside a try-catch to catch Dotenv exceptions
echo "<p>Attempting to include config.php...</p>";
try {
    require_once $configPath;
    echo "<p>✅ config.php included successfully.</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Exception during config.php include: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ Fatal Error during config.php include: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

// 4. Check if Constants are defined
echo "<h2>Constants Check</h2>";
$constants = ['DB_HOST', 'DB_NAME', 'DB_USER', 'MAIL_HOST'];
echo "<ul>";
foreach ($constants as $const) {
    if (defined($const)) {
        echo "<li>✅ <strong>$const</strong> is defined as: " . htmlspecialchars(constant($const)) . "</li>";
    } else {
        echo "<li>❌ <strong>$const</strong> is NOT defined.</li>";
    }
}
echo "</ul>";

// 5. Check Database Connection
echo "<h2>Database Connection Check</h2>";
if (isset($pdo)) {
    echo "<p>✅ \$pdo object exists.</p>";
    try {
        $stmt = $pdo->query("SELECT 1");
        if ($stmt) {
            echo "<p style='color:green'>✅ Database connection successful (SELECT 1 returned).</p>";
        } else {
            echo "<p style='color:red'>❌ Database query failed.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>❌ Database connection error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red'>❌ \$pdo object is NOT set (config.php failed to initialize it).</p>";
}

// 6. Environment Variable Availability Check
echo "<h2>Environment Variable Diagnostic</h2>";
echo "<p>Checking <code>\$_ENV['DB_HOST']</code>: " . (isset($_ENV['DB_HOST']) ? 'Set' : 'Not Set') . "</p>";
echo "<p>Checking <code>getenv('DB_HOST')</code>: " . (getenv('DB_HOST') !== false ? 'Set' : 'Not Set') . "</p>";

?>
