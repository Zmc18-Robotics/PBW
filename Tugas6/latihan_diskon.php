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
    <title>Latihan Diskon</title>
</head>
<body>
<div style="position: fixed; top: 10px; right: 10px; z-index: 9999;"><a href="logout.php" style="padding: 8px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-family: sans-serif; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Logout</a></div>


<form method="post" action="">
    NPM : <input type="text" name="npm"><br>
    Nama : <input type="text" name="nama"><br>
    Prodi : <input type="text" name="prodi"><br>
    Semester : <input type="number" name="semester"><br>
    Biaya UKT : <input type="number" name="biayaUKT"><br>
    <input type="submit" name="submit" value="proses"><br>
</form>
<br>
<hr>

<?php
if (isset($_POST['submit'])) {

    $npm = htmlspecialchars($_POST['npm']);
    $nama = htmlspecialchars($_POST['nama']);
    $prodi = htmlspecialchars($_POST['prodi']);
    $semester = $_POST['semester'];
    $biayaUKT = $_POST['biayaUKT'];

    if ($biayaUKT >= 5000000) {
        $total = $biayaUKT - ($biayaUKT * 0.10);

        if ($semester > 8) {
            $total = $total - ($total * 0.05);
            $diskon = "10% + 5%";
        } else {
            $diskon = "10%";
        }
    } else {
        $total = $biayaUKT;
        $diskon = "0%";
    }

    echo "<b>Hasil Perhitungan Biaya UKT</b><br>";
    echo "NPM : $npm <br>";
    echo "Nama : $nama <br>";
    echo "Prodi : $prodi <br>";
    echo "Semester : $semester <br>";
    echo "Biaya UKT : $biayaUKT <br>";
    echo "Diskon : $diskon <br>";
    echo "Yang harus dibayar : $total <br>";
}
?>

</body>
</html>