<?php
$host     = "localhost";
$user     = "root";
$password = "";  // Laragon default: kosong
$database = "pemrograman_web_contoh";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
