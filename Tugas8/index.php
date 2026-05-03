<?php
// index.php
// Proteksi halaman: wajib login terlebih dahulu
session_start();
if (!isset($_SESSION['pengguna'])) {
    $_SESSION['pesan'] = "Mengakses fitur harus login dulu bro.";
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['pengguna']['nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Sistem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sistem Web</a>
        <div class="ms-auto d-flex align-items-center">
            <span class="text-white me-3">Halo, <strong><?= htmlspecialchars($nama) ?></strong>!</span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="alert alert-success">
        <strong>Selamat datang!</strong> Anda berhasil login sebagai <strong><?= htmlspecialchars($nama) ?></strong>.
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Fitur 1</h5>
                    <p class="card-text">Konten fitur pertama hanya bisa diakses setelah login.</p>
                    <a href="#" class="btn btn-primary btn-sm">Buka Fitur</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Fitur 2</h5>
                    <p class="card-text">Konten fitur kedua hanya bisa diakses setelah login.</p>
                    <a href="#" class="btn btn-primary btn-sm">Buka Fitur</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Fitur 3</h5>
                    <p class="card-text">Konten fitur ketiga hanya bisa diakses setelah login.</p>
                    <a href="#" class="btn btn-primary btn-sm">Buka Fitur</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
