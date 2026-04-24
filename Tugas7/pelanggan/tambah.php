<?php
require_once '../koneksi.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($conn->real_escape_string($_POST['nama']));
    $alamat  = trim($conn->real_escape_string($_POST['alamat']));
    $email   = trim($conn->real_escape_string($_POST['email']));
    $telepon = trim($conn->real_escape_string($_POST['telepon']));

    if (empty($nama)) {
        $error = "Nama wajib diisi!";
    } else {
        $conn->query("INSERT INTO pelanggan (Nama, Alamat, Email, Telepon)
                      VALUES ('$nama', '$alamat', '$email', '$telepon')");
        header("Location: index.php?success=tambah");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Tambah Pelanggan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #1e8449, #27ae60); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .form-box { max-width: 520px; margin: 40px auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
        .form-box h2 { color: #2c3e50; margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid #f0f2f5; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input { width: 100%; padding: 11px 14px; border: 1px solid #dde1e7; border-radius: 7px; margin-bottom: 18px; font-size: 14px; transition: border 0.2s; }
        input:focus { outline: none; border-color: #27ae60; box-shadow: 0 0 0 3px rgba(39,174,96,0.15); }
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
<div class="navbar"><span>👥</span><h1>Tambah Pelanggan</h1></div>
<div class="form-box">
    <h2>Form Tambah Pelanggan</h2>
    <?php if ($error): ?>
        <div class="alert-error">⚠️ <?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Nama Lengkap <span style="color:red">*</span></label>
        <input type="text" name="nama" required placeholder="Contoh: Ahmad Fauzi"
               value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">

        <label>Alamat</label>
        <input type="text" name="alamat" placeholder="Contoh: Jl. Mawar No. 10, Jakarta"
               value="<?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '' ?>">

        <div class="row">
            <div>
                <label>Email</label>
                <input type="email" name="email" placeholder="email@contoh.com"
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telepon" placeholder="08xxxxxxxxxx"
                       value="<?= isset($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : '' ?>">
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-success">💾 Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
