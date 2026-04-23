<?php
session_start();
if (empty($_SESSION['nama'])) { header('Location: index.php'); exit; }

// Bilangan genap 2–20
$genap_benar = [2,4,6,8,10,12,14,16,18,20];
$semua_angka = range(1, 20);

$submitted = false;
$pilihan = [];
$nilai = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $submitted = true;
  $pilihan = array_map('intval', $_POST['angka'] ?? []);
  $benar_dipilih = array_intersect($pilihan, $genap_benar);
  $nilai = count($benar_dipilih);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Soal 2 - For Bilangan Genap</title>
<style>
body { 
  background: white; 
  color: black; 
  font-family: Arial, sans-serif; 
  margin: 0; 
  padding: 20px;
}
.container { 
  max-width: 680px; 
  margin: 0 auto; 
  border: 2px solid #000; 
  padding: 20px; 
}
h1 { color: navy; }
nav { margin-bottom: 20px; }
.page-nav { text-align: right; }
.page-nav a { 
  display: inline-block; 
  padding: 5px 10px; 
  margin: 0 2px; 
  border: 1px solid #ccc; 
  text-decoration: none; 
  color: navy; 
  background: #f9f9f9; 
}
.page-nav a.active { background: #0066cc; color: white; }
.code-block {
  background: #f5f5f5; 
  border: 1px solid #ccc; 
  padding: 15px; 
  font-family: monospace; 
  font-size: 14px; 
  white-space: pre-wrap; 
  margin: 20px 0; 
}
.pertanyaan { 
  background: #f0f8ff; 
  border: 1px solid #0066cc; 
  padding: 15px; 
  margin: 20px 0; 
}
.check-table { 
  border-collapse: collapse; 
  width: 100%; 
  margin: 20px 0; 
}
.check-table td { 
  border: 1px solid #ccc; 
  padding: 10px; 
  text-align: center; 
  font-weight: bold; 
}
.check-table input[type="checkbox"] { 
  width: 20px; 
  height: 20px; 
  margin-right: 5px;
}
.btn-submit { 
  background: #0066cc; 
  color: white; 
  padding: 10px 20px; 
  border: none; 
  font-size: 16px; 
  cursor: pointer; 
  width: 100%; 
}
.score-box { 
  background: #d4edda; 
  border: 1px solid #c3e6cb; 
  padding: 20px; 
  text-align: center; 
  margin: 20px 0; 
}
.legend { 
  margin: 10px 0; 
  padding: 8px;
  background: #f8f9fa;
  border-radius: 5px;
}
.legend span { 
  margin-right: 20px; 
}
.info-box { 
  background: #f8f9fa; 
  border: 1px solid #dee2e6; 
  padding: 15px; 
  margin-top: 20px; 
}
</style>
</head>
<body>
<div class="container">
  <nav>
    <div><a href="menu.php">← Menu Soal</a></div>
    <div class="page-nav">
      <a href="soal1.php">1</a>
      <a href="soal2.php" class="active">2</a>
      <a href="soal3.php">3</a>
      <a href="soal4.php">4</a>
    </div>
  </nav>

  <div class="tag">Soal 02 &nbsp;·&nbsp; Pilihan Ganda (Checkbox)</div>
  <h1>For Loop – Bilangan Genap</h1>
  <p class="meta">Perhatikan kode berikut lalu centang semua bilangan genap yang dicetak.</p>

  <div class="code-block">
    <span class="cm">// Program for bilangan genap 2–20</span><br>
    <span class="kw">&lt;?php</span><br>
    <span class="kw">for</span> (<span class="kw">$i</span> = <span class="num">2</span>; <span class="kw">$i</span> &lt;= <span class="num">20</span>; <span class="kw">$i</span> += <span class="num">2</span>) {<br>
    &nbsp;&nbsp;<span class="fn">echo</span> <span class="kw">$i</span> . <span class="str">" "</span>;<br>
    }<br>
    <span class="kw">?&gt;</span>
  </div>

  <div class="pertanyaan">
    Dari angka 1–20 di bawah ini, <strong>centang semua bilangan genap</strong> yang akan dicetak oleh program <code>for</code> di atas.
  </div>

  <?php if ($submitted): ?>
    <div class="legend">
      <span style="background:#d4edda; padding:2px 8px;">✅ Benar dipilih</span>
      <span style="background:#f8d7da; padding:2px 8px;">❌ Salah dipilih</span>
      <span style="background:#fff3cd; padding:2px 8px;">⭕ Terlewat (genap tidak dicentang)</span>
    </div>
  <?php endif; ?>

  <form method="POST">
    <table class="check-table">
      <?php 
      $row = 0;
      foreach ($semua_angka as $n):
        $bg = '';
        if ($submitted) {
          $dipilih = in_array($n, $pilihan);
          $benar   = in_array($n, $genap_benar);
          if ($dipilih && $benar) $bg = 'background: #d4edda;';
          elseif ($dipilih && !$benar) $bg = 'background: #f8d7da;';
          elseif (!$dipilih && $benar) $bg = 'background: #fff3cd;';
        }
        if ($row % 5 == 0) echo '<tr>';
        echo '<td style="' . $bg . '">';
        echo '<input type="checkbox" name="angka[]" id="n' . $n . '" value="' . $n . '"';
        if (in_array($n, $pilihan)) echo ' checked';
        if ($submitted) echo ' disabled';
        echo '> <label for="n' . $n . '">' . $n . '</label>';
        echo '</td>';
        if ($row % 5 == 4 || $n == 20) echo '</tr>';
        $row++;
      endforeach; ?>
    </table>

    <?php if (!$submitted): ?>
      <button type="submit" class="btn-submit">Kirim Jawaban</button>
    <?php endif; ?>
  </form>

  <?php if ($submitted): ?>
    <div class="score-box">
      <h2><?= $nilai ?>/<?= count($genap_benar) ?></h2>
      <p>Bilangan genap yang berhasil kamu identifikasi</p>
    </div>

    <div style="margin-top:20px; text-align:right;">
      <a href="soal3.php" style="color:#0066cc; font-weight:bold; text-decoration:none;">Soal Berikutnya →</a>
    </div>
  <?php endif; ?>

  <div class="info-box">
    <h3>💡 Penjelasan For Loop</h3>
    <p>Loop <code>for ($i = 2; $i &lt;= 20; $i += 2)</code> dimulai dari 2, dan setiap iterasi menambahkan 2. Ini membuat $i selalu bernilai genap: 2, 4, 6, ... hingga 20. Cara ini lebih efisien dibanding mengecek modulus di dalam loop.</p>
  </div>
</div>
</body>
</html>