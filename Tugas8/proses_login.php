<?php
// proses_login.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = trim($_POST['nama'] ?? '');
    $katasandi = $_POST['katasandi'] ?? '';

    if (empty($nama) || empty($katasandi)) {
        $_SESSION['error'] = "Nama pengguna dan kata sandi tidak boleh kosong.";
        header("Location: login.php");
        exit;
    }

    if ($nama === 'Admin' && $katasandi === 'Admin123') {
        // Login berhasil
        $_SESSION['pengguna'] = [
            'id'   => 1,
            'nama' => 'Admin',
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
