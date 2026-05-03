<?php
// No auth check here - public login page
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-container { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-header { text-align: center; margin-bottom: 30px; }
        .login-header h1 { color: #2c3e50; font-size: 28px; margin-bottom: 5px; }
        .login-header p { color: #7f8c8d; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 500; }
        .form-group input { width: 100%; padding: 12px 16px; border: 2px solid #e1e8ed; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; }
        .form-group input:focus { outline: none; border-color: #3498db; }
        .btn { width: 100%; padding: 14px; background: linear-gradient(135deg, #3498db, #2980b9); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer; transition: opacity 0.3s; }
        .btn:hover { opacity: 0.9; }
        .error { background: #fee; color: #c33; padding: 12px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #e74c3c; }
        .demo { text-align: center; margin-top: 20px; color: #7f8c8d; font-size: 14px; }
        .demo strong { color: #27ae60; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>📚 Toko Buku</h1>
            <p>Silakan login untuk mengakses sistem</p>
        </div>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error">Username atau password salah!</div>';
        }
        if (isset($_GET['logout'])) {
            echo '<div class="error" style="background:#efe;">Anda telah logout.</div>';
        }
        ?>
        
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required autocomplete="username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        
        <div class="demo">
            Demo: <strong>admin</strong> / <strong>password</strong>
        </div>
    </div>
</body>
</html>

