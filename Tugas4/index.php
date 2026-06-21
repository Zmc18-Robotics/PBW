<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    $_SESSION['redirect_to'] = basename($_SERVER['PHP_SELF']);
    header("Location: login.php");
    exit;
}
?>
    <html>
        <head>
            <title>Tugas Praktikum 4</title>
            <link rel="stylesheet" href="style.css">
            <script src="script.js"></script>
        </head>
    <body>
<div style="position: fixed; top: 10px; right: 10px; z-index: 9999;"><a href="logout.php" style="padding: 8px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-family: sans-serif; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Logout</a></div>

        <header>
        <h1>Selamat Datang di Website Pengecekan Nilai Mahasiswa</h1>
        </header>
        <div class="container">
            <section class="content">
                <form action="#" method="post" id="formnilai">
                <h2>Cek Nilai Mahasiswa</h2>
                <p>Silahkan isi formulir di bawah ini untuk Mengecek Grade Nilai Mahasiswa</p>

                <label for="nama"><b>Nama Lengkap:</b></label>
                <input type="text" name="name" id="nama" required>
                
                <label for="nama"><b>Nomor Pokok Mahasiswa (NPM):</b></label>
                <input type="text" name="name" id="nama" required>

                <label for="nilai"><b>Masukan Nilai Anda:</b></label>
                <input type="number"name="nilai" id="nilai" required>

                <button type="button" class="btn" onclick="menghitungnilai()">Cek Nilai</button>
                </form>
                
            </section>
            <aside class="sidebar">
                <h1>Hasil</h1>
                <p id="hasil"></p>
            </aside>
        </div>
    </body>
    </html>