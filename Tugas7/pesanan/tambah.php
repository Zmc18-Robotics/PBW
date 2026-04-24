<?php
require_once '../koneksi.php';
$pelangganList = $conn->query("SELECT ID, Nama FROM pelanggan ORDER BY Nama");
$bukuList      = $conn->query("SELECT ID, Judul, Harga, Stok FROM buku WHERE Stok > 0 ORDER BY Judul");
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pelanggan_id = (int)$_POST['pelanggan_id'];
    $buku_id      = (int)$_POST['buku_id'];
    $kuantitas    = (int)$_POST['kuantitas'];
    $tanggal      = $conn->real_escape_string($_POST['tanggal']);

    if ($kuantitas <= 0) {
        $error = "Kuantitas harus lebih dari 0!";
    } else {
        $buku = $conn->query("SELECT Harga, Stok, Judul FROM buku WHERE ID=$buku_id")->fetch_assoc();
        if (!$buku) {
            $error = "Buku tidak ditemukan!";
        } elseif ($kuantitas > $buku['Stok']) {
            $error = "Stok tidak mencukupi! Stok tersedia: <strong>" . $buku['Stok'] . " buku</strong>";
        } else {
            $harga_satuan = $buku['Harga'];
            $total        = $harga_satuan * $kuantitas;

            // Insert pesanan
            $conn->query("INSERT INTO pesanan (Tanggal_Pesanan, Pelanggan_ID, Total_Harga)
                          VALUES ('$tanggal', $pelanggan_id, $total)");
            $pesanan_id = $conn->insert_id;

            // Insert detail
            $conn->query("INSERT INTO detail_pesanan (Pesanan_ID, Buku_ID, Kuantitas, Harga_Per_Satuan)
                          VALUES ($pesanan_id, $buku_id, $kuantitas, $harga_satuan)");

            // Kurangi stok
            $conn->query("UPDATE buku SET Stok = Stok - $kuantitas WHERE ID = $buku_id");

            header("Location: index.php?success=tambah");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Buat Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; }
        .navbar { background: linear-gradient(135deg, #c0392b, #e74c3c); color: white; padding: 15px 30px; display: flex; align-items: center; gap: 10px; }
        .navbar h1 { font-size: 20px; }
        .form-box { max-width: 540px; margin: 40px auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
        .form-box h2 { color: #2c3e50; margin-bottom: 25px; padding-bottom: 12px; border-bottom: 2px solid #f0f2f5; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #555; font-size: 14px; }
        input, select { width: 100%; padding: 11px 14px; border: 1px solid #dde1e7; border-radius: 7px; margin-bottom: 18px; font-size: 14px; transition: border 0.2s; background: white; }
        input:focus, select:focus { outline: none; border-color: #e74c3c; box-shadow: 0 0 0 3px rgba(231,76,60,0.15); }
        .btn { padding: 11px 22px; border-radius: 7px; border: none; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-danger    { background: #e74c3c; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #fdecea; color: #c0392b; padding: 12px 15px; border-radius: 7px; margin-bottom: 18px; border-left: 4px solid #e74c3c; font-size: 14px; }
        .preview-box { background: #fff8e1; border: 1px solid #ffe082; border-radius: 8px; padding: 15px; margin-bottom: 20px; display: none; }
        .preview-box h4 { color: #e65100; margin-bottom: 8px; }
        .preview-box p { font-size: 14px; color: #555; margin: 3px 0; }
        .preview-box .total { font-size: 18px; font-weight: bold; color: #e74c3c; margin-top: 8px; }
    </style>
    <script>
    // Data buku untuk preview
    const bukuData = {
        <?php
        $bukuAll = $conn->query("SELECT ID, Harga, Stok FROM buku WHERE Stok > 0");
        while ($b = $bukuAll->fetch_assoc()) {
            echo $b['ID'] . ": {harga: " . $b['Harga'] . ", stok: " . $b['Stok'] . "},\n";
        }
        ?>
    };

    function updatePreview() {
        const bukuId  = document.getElementById('buku_id').value;
        const qty     = parseInt(document.getElementById('kuantitas').value) || 0;
        const preview = document.getElementById('preview');

        if (bukuId && qty > 0 && bukuData[bukuId]) {
            const harga = bukuData[bukuId].harga;
            const total = harga * qty;
            document.getElementById('prev-harga').textContent = 'Rp ' + harga.toLocaleString('id-ID');
            document.getElementById('prev-qty').textContent   = qty + ' buku';
            document.getElementById('prev-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    }
    </script>
</head>
<body>
<div class="navbar"><span>🛒</span><h1>Buat Pesanan Baru</h1></div>
<div class="form-box">
    <h2>Form Pesanan</h2>
    <?php if ($error): ?>
        <div class="alert-error">⚠️ <?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Tanggal Pesanan</label>
        <input type="date" name="tanggal" required value="<?= date('Y-m-d') ?>">

        <label>Pelanggan <span style="color:red">*</span></label>
        <select name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php
            $pelangganList->data_seek(0);
            while ($p = $pelangganList->fetch_assoc()):
            ?>
                <option value="<?= $p['ID'] ?>"
                    <?= (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $p['ID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['Nama']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Buku <span style="color:red">*</span></label>
        <select name="buku_id" id="buku_id" required onchange="updatePreview()">
            <option value="">-- Pilih Buku --</option>
            <?php
            $bukuList->data_seek(0);
            while ($b = $bukuList->fetch_assoc()):
            ?>
                <option value="<?= $b['ID'] ?>"
                    <?= (isset($_POST['buku_id']) && $_POST['buku_id'] == $b['ID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($b['Judul']) ?> — Stok: <?= $b['Stok'] ?> | Rp <?= number_format($b['Harga'],0,',','.') ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Kuantitas</label>
        <input type="number" name="kuantitas" id="kuantitas" required min="1" value="1" onchange="updatePreview()" oninput="updatePreview()">

        <div class="preview-box" id="preview">
            <h4>🧾 Preview Pesanan</h4>
            <p>Harga Satuan : <span id="prev-harga">-</span></p>
            <p>Jumlah       : <span id="prev-qty">-</span></p>
            <p class="total">Total         : <span id="prev-total">-</span></p>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-danger">🛒 Buat Pesanan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
