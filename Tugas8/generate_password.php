<?php
// generate_password.php
// Jalankan file ini SEKALI untuk membuat hash password
// lalu update tabel pengguna di database
// Akses: http://localhost/nama_folder/generate_password.php

$passwords = [
    'rahasia123',
    'admin123',
    'user123',
];

echo "<h3>Hash Password (salin ke database.sql)</h3>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>Password Asli</th><th>Hash (untuk database)</th></tr>";
foreach ($passwords as $pass) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    echo "<tr><td>{$pass}</td><td>{$hash}</td></tr>";
}
echo "</table>";

echo "<br><h4>Contoh SQL UPDATE:</h4><pre>";
foreach ($passwords as $pass) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    echo "UPDATE pengguna SET katasandi = '{$hash}' WHERE nama = 'admin';\n";
    break;
}
echo "</pre>";
echo "<p style='color:red'><strong>Hapus file ini setelah selesai digunakan!</strong></p>";
?>
