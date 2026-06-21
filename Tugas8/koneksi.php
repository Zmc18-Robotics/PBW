<?php
// koneksi.php
// Konfigurasi koneksi ke database MySQL via Laragon

$host     = 'localhost';
$dbname   = 'loginsystem';  // ← BARU
$username = 'root';       // default Laragon
$password = '';           // default Laragon (kosong)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
