<?php
require_once '../auth.php';
require_once '../koneksi.php';
$result = $conn->query("
    SELECT p.ID, p.Tanggal_Pesanan, pl.Nama AS Pelanggan, p.Total_Harga
    FROM pesanan p
    JOIN pelanggan pl ON p.Pelanggan_ID = pl.ID
    ORDER BY p.ID DESC
");
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Data Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #c0392b, #e74c3c); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .navbar h1 { font-size: 20px; }
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .top h2 { color: #2c3e50; }
        .btn { padding: 9px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-danger    { background: #e74c3c; color: white; }
        .btn-info      { background: #2980b9; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th { background: #e74c3c; color: white; padding: 13px 15px; text-align: left; font-size: 14px; }
        td { padding: 11px 15px; border-bottom: 1px solid #eef0f3; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fff5f5; }
        .alert { padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; font-size: 14px; }
        .alert-success { background: #eafaf1; color: #1e8449; border-left: 4px solid #27ae60; }
        .empty { text-align: center; padding: 40px; color: #aaa; }
    </style>
</head>
<body>
<div class="navbar"><span>🛒</span><h1>Manajemen Pesanan <span style="font-size:0.9em;opacity:0.9;">| <a href="../logout.php" style="color:#ffeb3b;text-decoration:none;font-weight:500;">Logout (<?php echo $_SESSION['username']; ?>)</a></span></h1></div>
<div class="container">
    <div class="top">
        <h2>Daftar Pesanan</h2>
        <div style="display:flex;gap:10px;">
            <a href="../index.php" class="btn btn-secondary">🏠 Home</a>
            <a href="tambah.php" class="btn btn-danger">+ Buat Pesanan</a>
        </div>
    </div>

    <?php if ($success === 'tambah'): ?>
        <div class="alert alert-success">✅ Pesanan berhasil dibuat!</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Total Harga</th><th>Detail</th></tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows === 0): ?>
            <tr><td colspan="5" class="empty">Belum ada pesanan. <a href="tambah.php">Buat pesanan sekarang</a></td></tr>
        <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>#<?= $row['ID'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['Tanggal_Pesanan'])) ?></td>
                <td><?= htmlspecialchars($row['Pelanggan']) ?></td>
                <td><strong>Rp <?= number_format($row['Total_Harga'], 0, ',', '.') ?></strong></td>
                <td><a href="detail.php?id=<?= $row['ID'] ?>" class="btn btn-info">🔍 Detail</a></td>
            </tr>
        <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
