<?php
require_once '../koneksi.php';
$id   = (int)$_GET['id'];
$buku = $conn->query("SELECT * FROM buku WHERE ID = $id")->fetch_assoc();
if (!$buku) { die("Buku tidak ditemukan."); }
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul   = trim($conn->real_escape_string($_POST['judul']));
    $penulis = trim($conn->real_escape_string($_POST['penulis']));
    $tahun   = (int)$_POST['tahun'];
    $harga   = (float)$_POST['harga'];
    $stok    = (int)$_POST['stok'];

    if (empty($judul) || empty($penulis)) {
        $error = "Judul dan Penulis wajib diisi!";
    } else {
        $sql = "UPDATE buku SET Judul='$judul', Penulis='$penulis',
                Tahun_Terbit=$tahun, Harga=$harga, Stok=$stok WHERE ID=$id";
        if ($conn->query($sql)) {
            header("Location: index.php?success=edit");
            exit;
        } else {
            $error = "Gagal mengupdate: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Edit Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #e67e22, #f39c12); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .form-box { max-width: 520px; margin: 40px auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
        .form-box h2 { color: #2c3e50; margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid #f0f2f5; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input { width: 100%; padding: 11px 14px; border: 1px solid #dde1e7; border-radius: 7px; margin-bottom: 18px; font-size: 14px; transition: border 0.2s; }
        input:focus { outline: none; border-color: #f39c12; box-shadow: 0 0 0 3px rgba(243,156,18,0.15); }
        .btn { padding: 11px 22px; border-radius: 7px; border: none; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-warning   { background: #f39c12; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #fdecea; color: #c0392b; padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; border-left: 4px solid #e74c3c; font-size: 14px; }
        .row { display: flex; gap: 15px; }
        .row > div { flex: 1; }
        .info-badge { background: #eaf4fb; color: #2980b9; padding: 8px 12px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="navbar"><span>✏️</span><h1>Edit Buku</h1></div>
<div class="form-box">
    <h2>Form Edit Buku</h2>
    <div class="info-badge">📌 Mengedit: <strong><?= htmlspecialchars($buku['Judul']) ?></strong> (ID: <?= $id ?>)</div>
    <?php if ($error): ?>
        <div class="alert-error">⚠️ <?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Judul Buku <span style="color:red">*</span></label>
        <input type="text" name="judul" required value="<?= htmlspecialchars($buku['Judul']) ?>">

        <label>Penulis <span style="color:red">*</span></label>
        <input type="text" name="penulis" required value="<?= htmlspecialchars($buku['Penulis']) ?>">

        <div class="row">
            <div>
                <label>Tahun Terbit</label>
                <input type="number" name="tahun" min="1900" max="2099" value="<?= $buku['Tahun_Terbit'] ?>">
            </div>
            <div>
                <label>Stok</label>
                <input type="number" name="stok" min="0" value="<?= $buku['Stok'] ?>">
            </div>
        </div>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" step="500" min="0" value="<?= $buku['Harga'] ?>">

        <div style="display:flex;gap:10px;margin-top:5px;">
            <button type="submit" class="btn btn-warning">💾 Update Buku</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
