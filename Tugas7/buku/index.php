<?php
require_once '../koneksi.php';
$result = $conn->query("SELECT * FROM buku ORDER BY ID DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #2980b9, #3498db); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .navbar h1 { font-size: 20px; }
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .top h2 { color: #2c3e50; }
        .btn { padding: 9px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-primary  { background: #3498db; color: white; }
        .btn-success  { background: #27ae60; color: white; }
        .btn-warning  { background: #f39c12; color: white; }
        .btn-danger   { background: #e74c3c; color: white; }
        .btn-secondary{ background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th { background: #3498db; color: white; padding: 13px 15px; text-align: left; font-size: 14px; }
        td { padding: 11px 15px; border-bottom: 1px solid #eef0f3; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fbff; }
        .badge { padding: 3px 10px; border-radius: 20px; font-size: 12px; }
        .badge-low  { background: #fdecea; color: #e74c3c; }
        .badge-ok   { background: #eafaf1; color: #27ae60; }
        .empty { text-align: center; padding: 40px; color: #aaa; }
    </style>
</head>
<body>
<div class="navbar"><span>📖</span><h1>Manajemen Buku</h1></div>
<div class="container">
    <div class="top">
        <h2>Daftar Buku</h2>
        <div style="display:flex;gap:10px;">
            <a href="../index.php" class="btn btn-secondary">🏠 Home</a>
            <a href="tambah.php" class="btn btn-success">+ Tambah Buku</a>
        </div>
    </div>
    <table>
        <thead>
            <tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows === 0): ?>
            <tr><td colspan="7" class="empty">Belum ada data buku. <a href="tambah.php">Tambah sekarang</a></td></tr>
        <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><strong><?= htmlspecialchars($row['Judul']) ?></strong></td>
                <td><?= htmlspecialchars($row['Penulis']) ?></td>
                <td><?= $row['Tahun_Terbit'] ?></td>
                <td>Rp <?= number_format($row['Harga'], 0, ',', '.') ?></td>
                <td>
                    <span class="badge <?= $row['Stok'] <= 5 ? 'badge-low' : 'badge-ok' ?>">
                        <?= $row['Stok'] ?>
                    </span>
                </td>
                <td style="display:flex;gap:6px;">
                    <a href="edit.php?id=<?= $row['ID'] ?>" class="btn btn-warning">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $row['ID'] ?>" class="btn btn-danger"
                       onclick="return confirm('Yakin ingin menghapus buku ini?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
