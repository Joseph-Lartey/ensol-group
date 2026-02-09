<?php
require_once __DIR__ . '/../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        header('Location: /ensol-group/admin/login.php?error=1');
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ? AND is_active = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            
            // Update last login
            $updateStmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$user['id']]);
            
            header('Location: /ensol-group/admin/dashboard.php');
            exit;
        } else {
            header('Location: /ensol-group/admin/login.php?error=1');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: /ensol-group/admin/login.php?error=1');
        exit;
    }
} else {
    header('Location: /ensol-group/admin/login.php');
    exit;
}
?>
