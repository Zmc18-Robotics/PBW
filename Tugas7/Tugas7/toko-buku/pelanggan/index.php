<?php
require_once '../auth.php';
require_once '../koneksi.php';
$result = $conn->query("SELECT * FROM pelanggan ORDER BY ID DESC");
$success = $_GET['success'] ?? '';
$error   = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Data Pelanggan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #1e8449, #27ae60); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .navbar h1 { font-size: 20px; }
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .top h2 { color: #2c3e50; }
        .btn { padding: 9px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-success   { background: #27ae60; color: white; }
        .btn-warning   { background: #f39c12; color: white; }
        .btn-danger    { background: #e74c3c; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th { background: #27ae60; color: white; padding: 13px 15px; text-align: left; font-size: 14px; }
        td { padding: 11px 15px; border-bottom: 1px solid #eef0f3; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f2fff6; }
        .alert { padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; font-size: 14px; }
        .alert-success { background: #eafaf1; color: #1e8449; border-left: 4px solid #27ae60; }
        .alert-error   { background: #fdecea; color: #c0392b; border-left: 4px solid #e74c3c; }
        .empty { text-align: center; padding: 40px; color: #aaa; }
    </style>
</head>
<body>
<div class="navbar"><span>👥</span><h1>Manajemen Pelanggan <span style="font-size:0.9em;opacity:0.9;">| <a href="../logout.php" style="color:#ffeb3b;text-decoration:none;font-weight:500;">Logout (<?php echo $_SESSION['username']; ?>)</a></span></h1></div>
<div class="container">
    <div class="top">
        <h2>Daftar Pelanggan</h2>
        <div style="display:flex;gap:10px;">
            <a href="../index.php" class="btn btn-secondary">🏠 Home</a>
            <a href="tambah.php" class="btn btn-success">+ Tambah Pelanggan</a>
        </div>
    </div>

    <?php if ($success === 'tambah'): ?>
        <div class="alert alert-success">✅ Pelanggan berhasil ditambahkan!</div>
    <?php elseif ($success === 'edit'): ?>
        <div class="alert alert-success">✅ Data pelanggan berhasil diupdate!</div>
    <?php elseif ($success === 'hapus'): ?>
        <div class="alert alert-success">✅ Pelanggan berhasil dihapus!</div>
    <?php elseif ($error === 'pelanggan_punya_pesanan'): ?>
        <div class="alert alert-error">⚠️ Tidak bisa hapus! Pelanggan ini sudah memiliki data pesanan.</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows === 0): ?>
            <tr><td colspan="6" class="empty">Belum ada data pelanggan. <a href="tambah.php">Tambah sekarang</a></td></tr>
        <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><strong><?= htmlspecialchars($row['Nama']) ?></strong></td>
                <td><?= htmlspecialchars($row['Alamat']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= $row['Telepon'] ?></td>
                <td style="display:flex;gap:6px;">
                    <a href="edit.php?id=<?= $row['ID'] ?>" class="btn btn-warning">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $row['ID'] ?>" class="btn btn-danger"
                       onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
