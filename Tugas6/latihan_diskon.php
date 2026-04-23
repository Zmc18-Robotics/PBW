<html>
<head>
    <title>Latihan Diskon</title>
</head>
<body>

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