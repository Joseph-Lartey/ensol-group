<?php
/**
 * Generate Admin Password Hash
 * Run this script once to generate a password hash for your admin user
 * Then copy the hash and update it in database/setup.sql
 */

// Set your desired password here
$password = 'admin123';  // CHANGE THIS!

// Generate hash
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password Hash Generator\n";
echo "======================\n\n";
echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n\n";
echo "Copy the hash above and update it in database/setup.sql\n";
echo "Replace: '\$2y\$10\$YourHashedPasswordHere'\n";
echo "With: '" . $hash . "'\n\n";
echo "Then run the SQL script in PHPMyAdmin to create the database and admin user.\n";
?>
