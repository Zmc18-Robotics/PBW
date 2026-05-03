<?php
// proses_login.php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = trim($_POST['nama'] ?? '');
    $katasandi = $_POST['katasandi'] ?? '';

    if (empty($nama) || empty($katasandi)) {
        $_SESSION['error'] = "Nama pengguna dan kata sandi tidak boleh kosong.";
        header("Location: login.php");
        exit;
    }

    // Ambil data pengguna berdasarkan nama
    $stmt = $pdo->prepare("SELECT * FROM pengguna WHERE nama = ? LIMIT 1");
    $stmt->execute([$nama]);
    $pengguna = $stmt->fetch();

    // Verifikasi password (menggunakan password_verify untuk keamanan)
    if ($pengguna && password_verify($katasandi, $pengguna['katasandi'])) {
        // Login berhasil
        $_SESSION['pengguna'] = [
            'id'   => $pengguna['id'],
            'nama' => $pengguna['nama'],
        ];
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "Nama pengguna atau kata sandi salah.";
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
