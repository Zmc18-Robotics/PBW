<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    $_SESSION['redirect_to'] = basename($_SERVER['PHP_SELF']);
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membuat form pendaftaran sederhana</title>
</head>
<body>
<div style="position: fixed; top: 10px; right: 10px; z-index: 9999;"><a href="logout.php" style="padding: 8px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-family: sans-serif; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Logout</a></div>

    <h1>Membuat form pendaftaran sederhana</h1>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama">
        </p>

        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email">
        </p>

        <p>
            <label>Jenis Kelamin:</label>
            <input type="radio" id="laki_laki" name="jenis_kelamin" value="laki_laki">
            <label for="laki_laki">Laki-laki</label>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan">
            <label for="perempuan">Perempuan</label>
        </p>

        <p>
            <label>Hobi:</label><br>
            <input type="checkbox" id="anime" name="hobi" value="anime">
            <label for="anime">Anime</label><br>
            <input type="checkbox" id="cosplay" name="hobi" value="cosplay">
            <label for="cosplay">Cosplay</label><br>
            <input type="checkbox" id="musik" name="hobi" value="musik">
            <label for="musik">Musik</label><br>
            <input type="checkbox" id="robotik" name="hobi" value="robotik">
            <label for="robotik">Robotik</label><br>
            <input type="checkbox" id="gambar" name="hobi" value="gambar">
            <label for="gambar">Gambar</label><br>
            <input type="checkbox" id="game" name="hobi" value="game">
            <label for="game">Game</label><br>
            <input type="checkbox" id="desain" name="hobi" value="desain">
            <label for="desain">Desain</label>
        </p>

        <p>
            <label for="kota">Pilih Kota:</label>
            <select id="kota" name="kota">
                <option value="jakarta">Jakarta</option>
                <option value="bandung">Bandung</option>
                <option value="surabaya">Surabaya</option>
                <option value="yogyakarta">Yogyakarta</option>
                <option value="semarang">Semarang</option>
                <option value="solo">Solo</option>
                <option value="malang">Malang</option>
                <option value="depok">Depok</option>
                <option value="tangerang">Tangerang</option>
                <option value="bekasi">Bekasi</option>
                <option value="bogor">Bogor</option>
            </select>
        </p>

        <p>
            <label for="foto">Upload Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*">
        </p>

        <p>
            <button type="submit">Daftar</button>
        </p>
    </form>
</body>
</html>
