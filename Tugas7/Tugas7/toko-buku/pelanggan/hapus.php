<?php
require_once '../auth.php';
require_once '../koneksi.php';
$id = (int)$_GET['id'];

// Cek apakah pelanggan sudah punya pesanan
$cek = $conn->query("SELECT COUNT(*) as total FROM pesanan WHERE Pelanggan_ID = $id")->fetch_assoc();
if ($cek['total'] > 0) {
    header("Location: index.php?error=pelanggan_punya_pesanan");
    exit;
}

$conn->query("DELETE FROM pelanggan WHERE ID = $id");
header("Location: index.php?success=hapus");
exit;
?>
