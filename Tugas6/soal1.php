<?php
session_start();
if (empty($_SESSION['nama'])) { header('Location: index.php'); exit; }

$kunci   = 'B'; // jawaban benar: Sepeda Motor
$selected = null;
$correct  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selected = $_POST['jawaban'] ?? '';
  $correct  = ($selected === $kunci);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Soal 1 - Switch Kendaraan</title>
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
hr { border: 1px solid #ccc; margin: 20px 0; }
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
.options { margin: 20px 0; }
.option { 
  margin-bottom: 10px;
  padding: 8px;
  border-radius: 5px;
  transition: background 0.2s;
}
.option.correct-highlight {
  background-color: #d4edda;
  border: 1px solid #28a745;
}
.option.wrong-highlight {
  background-color: #f8d7da;
  border: 1px solid #dc3545;
}
input[type="radio"] { margin-right: 10px; }
.btn-submit { 
  background: #0066cc; 
  color: white; 
  padding: 10px 20px; 
  border: none; 
  font-size: 16px; 
  cursor: pointer; 
  width: 100%; 
}
.feedback { 
  padding: 15px; 
  margin: 20px 0; 
  border-radius: 5px; 
}
.feedback.ok { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.feedback.err { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
.output-box { 
  background: #e8f4fd; 
  border: 1px solid #bee5eb; 
  padding: 15px; 
  font-family: monospace; 
  margin: 10px 0; 
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
      <a href="soal1.php" class="active">1</a>
      <a href="soal2.php">2</a>
      <a href="soal3.php">3</a>
      <a href="soal4.php">4</a>
    </div>
  </nav>

  <div class="tag">Soal 01 &nbsp;·&nbsp; Pilihan Ganda</div>
  <h1>Switch – Jenis Kendaraan</h1>
  <p class="meta">Perhatikan kode berikut lalu jawab pertanyaannya.</p>

  <div class="code-block">
    <span class="cm">// Program switch jumlah roda kendaraan</span><br>
    <span class="kw">&lt;?php</span><br>
    <span class="kw">$roda</span> = <span class="num">2</span>;<br><br>
    <span class="kw">switch</span> (<span class="kw">$roda</span>) {<br>
    &nbsp;&nbsp;<span class="kw">case</span> <span class="num">1</span>: <span class="fn">echo</span> <span class="str">"Monosiklik"</span>; <span class="kw">break</span>;<br>
    &nbsp;&nbsp;<span class="kw">case</span> <span class="num">2</span>: <span class="fn">echo</span> <span class="str">"Sepeda Motor"</span>; <span class="kw">break</span>;<br>
    &nbsp;&nbsp;<span class="kw">case</span> <span class="num">4</span>: <span class="fn">echo</span> <span class="str">"Mobil"</span>; <span class="kw">break</span>;<br>
    &nbsp;&nbsp;<span class="kw">case</span> <span class="num">6</span>: <span class="fn">echo</span> <span class="str">"Truk"</span>; <span class="kw">break</span>;<br>
    &nbsp;&nbsp;<span class="kw">default</span>: <span class="fn">echo</span> <span class="str">"Tidak dikenali"</span>;<br>
    }<br>
    <span class="kw">?&gt;</span>
  </div>

  <div class="pertanyaan">
    Jika <strong>$roda = 2</strong>, apa output yang akan dihasilkan program di atas?
  </div>

  <form method="POST">
    <div class="options">
      <?php
      $opts = [
        'A' => 'Monosiklik',
        'B' => 'Sepeda Motor',
        'C' => 'Mobil',
        'D' => 'Tidak dikenali',
      ];
      foreach ($opts as $k => $v):
        $divClass = 'option';
        if ($selected !== null) {
          if ($k === $kunci) {
            $divClass .= ' correct-highlight';
          } elseif ($k === $selected && !$correct) {
            $divClass .= ' wrong-highlight';
          }
        }
      ?>
      <div class="<?= $divClass ?>">
        <input type="radio" name="jawaban" id="opt<?= $k ?>" value="<?= $k ?>"
          <?= $selected === $k ? 'checked' : '' ?>
          <?= $selected !== null ? 'disabled' : '' ?>>
        <label for="opt<?= $k ?>">
          <strong><?= $k ?>.</strong> <?= htmlspecialchars($v) ?>
        </label>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if ($selected === null): ?>
      <button type="submit" class="btn-submit">Kirim Jawaban</button>
    <?php endif; ?>
  </form>

  <?php if ($selected !== null): ?>
    <div class="feedback <?= $correct ? 'ok' : 'err' ?>">
      <?= $correct
        ? '✅ Benar! Karena $roda = 2, program mencetak "Sepeda Motor".'
        : '❌ Kurang tepat. Jawaban yang benar adalah <strong>B – Sepeda Motor</strong>.' ?>
    </div>

    <div class="output-box">
      <strong>Output Program:</strong><br>
      Sepeda Motor
    </div>

    <div style="margin-top:20px; text-align:right;">
      <a href="soal2.php" style="color:#0066cc; font-weight:bold; text-decoration:none;">Soal Berikutnya →</a>
    </div>
  <?php endif; ?>

  <div class="info-box">
    <h3>💡 Penjelasan Switch</h3>
    <p>Switch membandingkan nilai variabel dengan setiap <em>case</em>. Jika cocok, blok kode di dalam case tersebut dijalankan. Keyword <em>break</em> digunakan agar tidak lanjut ke case berikutnya (fall-through). Jika tidak ada case yang cocok, blok <em>default</em> yang dijalankan.</p>
  </div>
</div>
</body>
</html>