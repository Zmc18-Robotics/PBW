<?php 
require_once 'koneksi.php';
require_once 'auth.php';

// Hitung statistik
$totalBuku      = $conn->query("SELECT COUNT(*) as total FROM buku")->fetch_assoc()['total'];
$totalPelanggan = $conn->query("SELECT COUNT(*) as total FROM pelanggan")->fetch_assoc()['total'];
$totalPesanan   = $conn->query("SELECT COUNT(*) as total FROM pesanan")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: linear-gradient(135deg, #2c3e50, #3d5a73);
            color: white; padding: 18px 30px;
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .navbar .icon { font-size: 28px; }
        .navbar h1 { font-size: 22px; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .welcome { background: white; border-radius: 12px; padding: 25px 30px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .welcome h2 { color: #2c3e50; margin-bottom: 5px; }
        .welcome p { color: #7f8c8d; }
        .stats { display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap; }
        .stat-card {
            background: white; border-radius: 10px; padding: 20px 25px;
            flex: 1; min-width: 150px; text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .stat-card .num { font-size: 36px; font-weight: bold; color: #2c3e50; }
        .stat-card .label { color: #7f8c8d; font-size: 13px; margin-top: 5px; }
        .cards { display: flex; gap: 20px; flex-wrap: wrap; }
        .card {
            background: white; border-radius: 12px; padding: 30px;
            flex: 1; min-width: 220px; text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-decoration: none; color: inherit;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .card .icon { font-size: 50px; margin-bottom: 12px; display: block; }
        .card h3 { font-size: 18px; color: #2c3e50; margin-bottom: 6px; }
        .card p { color: #7f8c8d; font-size: 13px; }
        .card.buku      { border-top: 5px solid #3498db; }
        .card.pelanggan { border-top: 5px solid #27ae60; }
        .card.pesanan   { border-top: 5px solid #e74c3c; }
        .footer { text-align: center; margin-top: 40px; color: #aaa; font-size: 13px; }
    </style>
</head>
<body>
<div class="navbar">
    <span class="icon">📚</span>
    <h1>Aplikasi Pengelolaan Buku <span style="font-size:0.9em;opacity:0.9;">| <a href="logout.php" style="color:#ffeb3b;text-decoration:none;font-weight:500;">Logout (<?php echo $_SESSION['username']; ?>)</a></span></h1>
</div>
<div class="container">
    <div class="welcome">
        <h2>Selamat Datang!</h2>
        <p>Sistem manajemen toko buku — Database: <strong>pemrograman_web_contoh</strong></p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="num"><?= $totalBuku ?></div>
            <div class="label">📖 Total Buku</div>
        </div>
        <div class="stat-card">
            <div class="num"><?= $totalPelanggan ?></div>
            <div class="label">👥 Total Pelanggan</div>
        </div>
        <div class="stat-card">
            <div class="num"><?= $totalPesanan ?></div>
            <div class="label">🛒 Total Pesanan</div>
        </div>
    </div>

    <div class="cards">
        <a href="buku/index.php" class="card buku">
            <span class="icon">📖</span>
            <h3>Manajemen Buku</h3>
            <p>Tambah, edit, hapus & lihat data buku</p>
        </a>
        <a href="pelanggan/index.php" class="card pelanggan">
            <span class="icon">👥</span>
            <h3>Manajemen Pelanggan</h3>
            <p>Tambah, edit, hapus & lihat data pelanggan</p>
        </a>
        <a href="pesanan/index.php" class="card pesanan">
            <span class="icon">🛒</span>
            <h3>Manajemen Pesanan</h3>
            <p>Buat & lihat riwayat pesanan</p>
        </a>
    </div>
    <div class="footer">Aplikasi Pengelolaan Buku &copy; <?= date('Y') ?></div>
</div>
</body>
</html>
