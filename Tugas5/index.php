<?php
// Data barang menggunakan array
$barang = [
    'nama' => 'Keyboard',
    'harga' => 150000,
    'jumlah' => 2
];

// Perhitungan
$total_sebelum_pajak = $barang['harga'] * $barang['jumlah'];
$pajak = $total_sebelum_pajak * 0.10;
$total_bayar = $total_sebelum_pajak + $pajak;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Total Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .kotak {
            background-color: #fff;
            border: 2px solid #333;
            padding: 20px 30px;
            width: 350px;
        }
        h2 {
            margin: 0 0 5px 0;
            text-align: center;
        }
        hr {
            border: none;
            border-top: 2px solid #333;
            margin-bottom: 20px;
        }
        .data p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h2>Perhitungan Total Pembelian (Dengan Array)</h2>
        <hr>
        
        <div class="data">
            <p>Nama Barang: <?= $barang['nama']; ?></p>
            <p>Harga Satuan: Rp <?= number_format($barang['harga'], 0, ',', '.'); ?></p>
            <p>Jumlah Beli: <?= $barang['jumlah']; ?></p>
            <p>Total Harga (Sebelum Pajak): Rp <?= number_format($total_sebelum_pajak, 0, ',', '.'); ?></p>
            <p>Pajak (10%): Rp <?= number_format($pajak, 0, ',', '.'); ?></p>
            <p>Total Bayar: Rp <?= number_format($total_bayar, 0, ',', '.'); ?></p>
        </div>
    </div>
</body>
</html>

