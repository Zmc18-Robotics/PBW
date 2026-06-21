<?php
require_once '../auth.php';
require_once '../koneksi.php';
$id = (int)$_GET['id'];
$p  = $conn->query("SELECT * FROM pelanggan WHERE ID=$id")->fetch_assoc();
if (!$p) { die("Pelanggan tidak ditemukan."); }
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($conn->real_escape_string($_POST['nama']));
    $alamat  = trim($conn->real_escape_string($_POST['alamat']));
    $email   = trim($conn->real_escape_string($_POST['email']));
    $telepon = trim($conn->real_escape_string($_POST['telepon']));

    if (empty($nama)) {
        $error = "Nama wajib diisi!";
    } else {
        $conn->query("UPDATE pelanggan SET Nama='$nama', Alamat='$alamat',
                      Email='$email', Telepon='$telepon' WHERE ID=$id");
        header("Location: index.php?success=edit");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Edit Pelanggan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #e67e22, #f39c12); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .form-box { max-width: 520px; margin: 40px auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
        .form-box h2 { color: #2c3e50; margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid #f0f2f5; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input { width: 100%; padding: 11px 14px; border: 1px solid #dde1e7; border-radius: 7px; margin-bottom: 18px; font-size: 14px; }
        input:focus { outline: none; border-color: #f39c12; box-shadow: 0 0 0 3px rgba(243,156,18,0.15); }
        .btn { padding: 11px 22px; border-radius: 7px; border: none; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-warning   { background: #f39c12; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #fdecea; color: #c0392b; padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; border-left: 4px solid #e74c3c; font-size: 14px; }
        .info-badge { background: #eaf4fb; color: #2980b9; padding: 8px 12px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; }
        .row { display: flex; gap: 15px; }
        .row > div { flex: 1; }
    </style>
</head>
<body>
<div class="navbar"><span>✏️</span><h1>Edit Pelanggan <span style="font-size:0.9em;opacity:0.9;">| <a href="../logout.php" style="color:#ffeb3b;text-decoration:none;font-weight:500;">Logout (<?php echo $_SESSION['username']; ?>)</a></span></h1></div>
<div class="form-box">
    <h2>Form Edit Pelanggan</h2>
    <div class="info-badge">📌 Mengedit: <strong><?= htmlspecialchars($p['Nama']) ?></strong> (ID: <?= $id ?>)</div>
    <?php if ($error): ?>
        <div class="alert-error">⚠️ <?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Nama Lengkap <span style="color:red">*</span></label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($p['Nama']) ?>">

        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($p['Alamat']) ?>">

        <div class="row">
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($p['Email']) ?>">
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telepon" value="<?= $p['Telepon'] ?>">
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-warning">💾 Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
