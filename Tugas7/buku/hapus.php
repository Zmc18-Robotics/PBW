<?php
require_once '../koneksi.php';
$id = (int)$_GET['id'];

// Cek apakah buku sudah ada di detail_pesanan
$cek = $conn->query("SELECT COUNT(*) as total FROM detail_pesanan WHERE Buku_ID = $id")->fetch_assoc();
if ($cek['total'] > 0) {
    // Redirect dengan pesan error
    header("Location: index.php?error=buku_dipakai");
    exit;
}

$conn->query("DELETE FROM buku WHERE ID = $id");
header("Location: index.php?success=hapus");
exit;
?>
