<?php
require_once '../koneksi.php';
$id = (int)$_GET['id'];

$pesanan = $conn->query("
    SELECT p.*, pl.Nama, pl.Email, pl.Telepon, pl.Alamat
    FROM pesanan p JOIN pelanggan pl ON p.Pelanggan_ID = pl.ID
    WHERE p.ID = $id
")->fetch_assoc();

if (!$pesanan) { die("Pesanan tidak ditemukan."); }

$details = $conn->query("
    SELECT dp.*, b.Judul, b.Penulis
    FROM detail_pesanan dp JOIN buku b ON dp.Buku_ID = b.ID
    WHERE dp.Pesanan_ID = $id
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Detail Pesanan #<?= $id ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #c0392b, #e74c3c); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .container { max-width: 750px; margin: 35px auto; padding: 0 20px; }
        .card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card h3 { color: #2c3e50; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #f0f2f5; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .info-item label { font-size: 12px; color: #aaa; text-transform: uppercase; }
        .info-item p { font-size: 15px; color: #2c3e50; font-weight: 500; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; color: #555; padding: 10px 12px; text-align: left; font-size: 13px; border-bottom: 2px solid #eee; }
        td { padding: 12px; border-bottom: 1px solid #f0f2f5; font-size: 14px; }
        .total-row td { font-weight: bold; background: #fff8f8; font-size: 15px; }
        .btn { padding: 9px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; display: inline-block; }
        .btn-secondary { background: #95a5a6; color: white; }
        .badge-pesanan { background: #fdecea; color: #c0392b; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>
<div class="navbar"><span>🔍</span><h1>Detail Pesanan</h1></div>
<div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <div>
            <h2 style="color:#2c3e50;">Pesanan <span class="badge-pesanan">#<?= $id ?></span></h2>
            <p style="color:#aaa;font-size:13px;margin-top:4px;">
                📅 <?= date('d F Y', strtotime($pesanan['Tanggal_Pesanan'])) ?>
            </p>
        </div>
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card">
        <h3>👤 Info Pelanggan</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>Nama</label><p><?= htmlspecialchars($pesanan['Nama']) ?></p>
            </div>
            <div class="info-item">
                <label>Email</label><p><?= htmlspecialchars($pesanan['Email']) ?></p>
            </div>
            <div class="info-item">
                <label>Telepon</label><p><?= $pesanan['Telepon'] ?></p>
            </div>
            <div class="info-item">
                <label>Alamat</label><p><?= htmlspecialchars($pesanan['Alamat']) ?></p>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>📦 Buku yang Dipesan</h3>
        <table>
            <thead>
                <tr><th>Judul Buku</th><th>Penulis</th><th>Harga Satuan</th><th>Qty</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
            <?php while ($d = $details->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($d['Judul']) ?></td>
                    <td><?= htmlspecialchars($d['Penulis']) ?></td>
                    <td>Rp <?= number_format($d['Harga_Per_Satuan'], 0, ',', '.') ?></td>
                    <td><?= $d['Kuantitas'] ?></td>
                    <td>Rp <?= number_format($d['Harga_Per_Satuan'] * $d['Kuantitas'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
                <tr class="total-row">
                    <td colspan="4" style="text-align:right;">TOTAL</td>
                    <td>Rp <?= number_format($pesanan['Total_Harga'], 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
