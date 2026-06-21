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
    <title>Tugas Praktikum 6</title>
</head>
<body>
<div style="position: fixed; top: 10px; right: 10px; z-index: 9999;"><a href="logout.php" style="padding: 8px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-family: sans-serif; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Logout</a></div>

<form method="post" action="">
    Nama: <input type="text" name="nama" required><br>
    Nilai: <input type="number" name="nilai" required><br>
    <input type="submit" name="submit" value="Proses">
</form>
<br>
<hr>

<?php
if (isset($_POST['submit'])) {
    $var_nama = $_POST['nama'];
    $var_nilai = $_POST['nilai'];

    echo "<h3>Hasil Pengecekan:</h3>";
    echo "Nama : $var_nama <br>";
    echo "Nilai : $var_nilai <br>";
    if ($var_nilai >= 85 && $var_nilai <= 100) {
        $predikat = "A";
        $status = "Lulus";
    } elseif ($var_nilai >= 75 && $var_nilai <= 84) {
        $predikat = "B";
        $status = "Lulus";
    } elseif ($var_nilai >= 65 && $var_nilai <= 74) {
        $predikat = "C";
        $status = "Lulus";
    } elseif ($var_nilai >= 50 && $var_nilai <= 64) {
        $predikat = "D";
        $status = "Lulus";
    } elseif ($var_nilai >= 0 && $var_nilai <= 49) {
        $predikat = "E";
        $status = "Tidak Lulus";
    } else {
        $predikat = "Tidak Valid";
        $status = "-";
    }
    echo "Predikat : $predikat <br>";
    echo "Status : $status <br>";
    }
?>
</body>
</html>