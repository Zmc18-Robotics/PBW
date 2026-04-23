<?php
session_start();
if (empty($_SESSION['nama'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html>
<head>
<title>Menu Soal - Kuis PHP</title>
<style>
body { 
  background: white; 
  color: black; 
  font-family: Arial, sans-serif; 
  margin: 0; 
  padding: 20px;
}
.container { 
  max-width: 700px; 
  margin: 0 auto; 
  border: 2px solid #000; 
  padding: 20px; 
}
h1 { 
  color: navy; 
  text-align: center; 
}
.userinfo { 
  text-align: right; 
  background: #f0f0f0; 
  padding: 10px; 
  border: 1px solid #ccc; 
  margin-bottom: 20px; 
}
.menu-table { 
  width: 100%; 
  border-collapse: collapse; 
}
.menu-table td { 
  padding: 15px; 
  border: 1px solid #ccc; 
  vertical-align: top; 
}
.menu-table a { 
  text-decoration: none; 
  color: navy; 
  font-weight: bold; 
  font-size: 18px; 
  display: block; 
}
.menu-table a:hover { 
  color: #0066cc; 
}
.logout { 
  text-align: center; 
  margin-top: 20px; 
}
.logout a { 
  color: #666; 
  text-decoration: none; 
}
hr { border: 1px solid #ccc; }
</style>
</head>
<body>
<div class="container">
<h1>Pilih Soal Latihan</h1>
<hr>
<div class="userinfo">
<strong><?php echo $_SESSION['nama']; ?></strong><br>
NPM: <?php echo $_SESSION['npm']; ?> | Kelas: <?php echo $_SESSION['kelas']; ?>
</div>

<p style="text-align: center; font-size: 16px; margin-bottom: 20px;">
Ada 4 soal yang harus dikerjakan. Setiap soal memiliki tipe jawaban berbeda.
</p>

<table class="menu-table">
  <tr>
    <td>
      <a href="soal1.php">1. Switch Jenis Kendaraan<br>
      <small>Tentukan jenis kendaraan berdasarkan jumlah roda (Pilihan Ganda)</small></a>
    </td>
    <td>
      <a href="soal2.php">2. For Bilangan Genap<br>
      <small>Cetak bilangan genap 2-20 (Checkbox Multiple)</small></a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="soal3.php">3. Array &amp; Foreach Hewan<br>
      <small>Buat array hewan dan tampilkan (Pilihan Ganda)</small></a>
    </td>
    <td>
      <a href="soal4.php">4. Ternary Genap/Ganjil<br>
      <small>Gunakan ternary untuk cek genap/ganjil (Jawaban Ketik)</small></a>
    </td>
  </tr>
</table>

<div class="logout">
<a href="index.php">← Kembali / Ganti Identitas</a>
</div>
</div>
</body>
</html>
