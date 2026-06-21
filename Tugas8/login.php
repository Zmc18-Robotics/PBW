<?php
// login.php
session_start();

// Jika sudah login, langsung ke index
if (isset($_SESSION['pengguna'])) {
    header("Location: index.php");
    exit;
}

$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .login-box {
            max-width: 420px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="login-box">
    <h5 class="mb-3 fw-bold">Masuk kedalam sistem</h5>

    <?php if ($pesan): ?>
        <div class="alert alert-info"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama pengguna :</label>
            <input type="text" name="nama" id="nama" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="katasandi" class="form-label">Kata sandi :</label>
            <input type="password" name="katasandi" id="katasandi" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
