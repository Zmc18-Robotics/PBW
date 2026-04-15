<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Kuis PHP - Masuk</title>
<style>
body { 
  background: white; 
  color: black; 
  font-family: Arial, sans-serif; 
  margin: 0; 
  padding: 20px;
}
.container { 
  max-width: 500px; 
  margin: 0 auto; 
  border: 2px solid #000; 
  padding: 20px; 
}
h1 { 
  color: navy; 
  text-align: center; 
}
input[type="text"] { 
  width: 100%; 
  padding: 8px; 
  border: 1px solid #ccc; 
  margin-bottom: 10px; 
}
input[type="submit"] { 
  background: #0066cc; 
  color: white; 
  padding: 10px 20px; 
  border: none; 
  width: 100%; 
  font-size: 16px; 
  cursor: pointer; 
}
.error { 
  color: red; 
  background: #ffe6e6; 
  padding: 10px; 
  border: 1px solid red; 
  margin-bottom: 10px; 
}
label { 
  font-weight: bold; 
  display: block; 
  margin-bottom: 5px; 
}
hr { border: 1px solid #ccc; }
</style>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama  = trim($_POST['nama']  ?? '');
  $npm   = trim($_POST['npm']   ?? '');
  $kelas = trim($_POST['kelas'] ?? '');
  if ($nama && $npm && $kelas) {
    $_SESSION['nama']  = htmlspecialchars($nama);
    $_SESSION['npm']   = htmlspecialchars($npm);
    $_SESSION['kelas'] = htmlspecialchars($kelas);
    header('Location: menu.php');
    exit;
  }
  $error = 'Semua kolom wajib diisi!';
}
?>
<div class="container">
<h1>Selamat Datang - Kuis PHP</h1>
<hr>
<?php if (!empty($error)): ?>
  <div class="error">⚠ <?php echo $error; ?></div>
<?php endif; ?>
<form method="POST">
  <label>Nama Lengkap:</label>
  <input type="text" name="nama" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
  
  <label>NPM:</label>
  <input type="text" name="npm" value="<?php echo htmlspecialchars($_POST['npm'] ?? ''); ?>">
  
  <label>Kelas:</label>
  <input type="text" name="kelas" value="<?php echo htmlspecialchars($_POST['kelas'] ?? ''); ?>">
  
  <input type="submit" value="Mulai Kuis">
</form>
</div>
</body>
</html>
