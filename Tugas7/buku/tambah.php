<?php
require_once '../koneksi.php';
$pesan = "";
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
        $sql = "INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, Stok)
                VALUES ('$judul', '$penulis', $tahun, $harga, $stok)";
        if ($conn->query($sql)) {
            header("Location: index.php?success=tambah");
            exit;
        } else {
            $error = "Gagal menyimpan: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Tambah Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #2980b9, #3498db); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .form-box { max-width: 520px; margin: 40px auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
        .form-box h2 { color: #2c3e50; margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid #f0f2f5; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input { width: 100%; padding: 11px 14px; border: 1px solid #dde1e7; border-radius: 7px; margin-bottom: 18px; font-size: 14px; transition: border 0.2s; }
        input:focus { outline: none; border-color: #3498db; box-shadow: 0 0 0 3px rgba(52,152,219,0.15); }
        .btn { padding: 11px 22px; border-radius: 7px; border: none; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-success   { background: #27ae60; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #fdecea; color: #c0392b; padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; border-left: 4px solid #e74c3c; font-size: 14px; }
        .row { display: flex; gap: 15px; }
        .row > div { flex: 1; }
    </style>
</head>
<body>
<div class="navbar"><span>📖</span><h1>Tambah Buku</h1></div>
<div class="form-box">
    <h2>Form Tambah Buku</h2>
    <?php if ($error): ?>
        <div class="alert-error">⚠️ <?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Judul Buku <span style="color:red">*</span></label>
        <input type="text" name="judul" required placeholder="Contoh: Pemrograman PHP Dasar"
               value="<?= isset($_POST['judul']) ? htmlspecialchars($_POST['judul']) : '' ?>">

        <label>Penulis <span style="color:red">*</span></label>
        <input type="text" name="penulis" required placeholder="Contoh: Budi Raharjo"
               value="<?= isset($_POST['penulis']) ? htmlspecialchars($_POST['penulis']) : '' ?>">

        <div class="row">
            <div>
                <label>Tahun Terbit</label>
                <input type="number" name="tahun" placeholder="2023" min="1900" max="2099"
                       value="<?= isset($_POST['tahun']) ? $_POST['tahun'] : date('Y') ?>">
            </div>
            <div>
                <label>Stok</label>
                <input type="number" name="stok" placeholder="50" min="0"
                       value="<?= isset($_POST['stok']) ? $_POST['stok'] : '' ?>">
            </div>
        </div>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" placeholder="75000" step="500" min="0"
               value="<?= isset($_POST['harga']) ? $_POST['harga'] : '' ?>">

        <div style="display:flex;gap:10px;margin-top:5px;">
            <button type="submit" class="btn btn-success">💾 Simpan Buku</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
