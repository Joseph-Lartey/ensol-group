<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/ensol-group/admin/styles.css">
    <style>
        .admin-login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .admin-login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
            padding: 48px 40px;
        }
        
        .admin-login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .admin-login-logo {
            width: 120px;
            margin-bottom: 20px;
        }
        
        .admin-login-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }
        
        .admin-login-subtitle {
            color: #666;
            font-size: 14px;
        }
        
        .admin-form-group {
            margin-bottom: 24px;
        }
        
        .admin-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }
        
        .admin-input-wrapper {
            position: relative;
        }
        
        .admin-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .admin-input:focus {
            outline: none;
            border-color: #DC1609;
            box-shadow: 0 0 0 4px rgba(220, 22, 9, 0.1);
        }
        
        .admin-input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        .admin-btn {
            width: 100%;
            padding: 16px;
            background: #DC1609;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .admin-btn:hover {
            background: #b01207;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 22, 9, 0.3);
        }
        
        .admin-btn:active {
            transform: translateY(0);
        }
        
        .admin-error {
            background: #fee;
            border: 1px solid #fcc;
            color: #c00;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }
        
        .admin-error.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-login-card">
            <div class="admin-login-header">
                <img src="../assets/ensol_logo.jpg" alt="Ensol Group" class="admin-login-logo">
                <h1 class="admin-login-title">Admin Login</h1>
                <p class="admin-login-subtitle">News Management Dashboard</p>
            </div>
            
            <div class="admin-error" id="error-message"></div>
            
            <form id="login-form" method="POST" action="/ensol-group/admin/auth.php">
                <div class="admin-form-group">
                    <label for="username">Username</label>
                    <div class="admin-input-wrapper">
                        <i class="fas fa-user admin-input-icon"></i>
                        <input type="text" id="username" name="username" class="admin-input" placeholder="Enter your username" required>
                    </div>
                </div>
                
                <div class="admin-form-group">
                    <label for="password">Password</label>
                    <div class="admin-input-wrapper">
                        <i class="fas fa-lock admin-input-icon"></i>
                        <input type="password" id="password" name="password" class="admin-input" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <button type="submit" class="admin-btn">
                    <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Show error if present in URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('error')) {
            const errorDiv = document.getElementById('error-message');
            errorDiv.textContent = 'Invalid username or password. Please try again.';
            errorDiv.classList.add('show');
        }
    </script>
</body>
</html>
