<?php
session_start();
if (empty($_SESSION['nama'])) { header('Location: index.php'); exit; }

$kunci   = 'C';
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
<title>Soal 3 - Array &amp; Foreach</title>
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
      <a href="soal1.php">1</a>
      <a href="soal2.php">2</a>
      <a href="soal3.php" class="active">3</a>
      <a href="soal4.php">4</a>
    </div>
  </nav>

  <div class="tag">Soal 03 &nbsp;·&nbsp; Pilihan Ganda</div>
  <h1>Array & Foreach – Daftar Hewan</h1>
  <p class="meta">Perhatikan kode berikut lalu jawab pertanyaannya.</p>

  <div class="code-block">
    <span class="cm">// Array dan foreach hewan</span><br>
    <span class="kw">&lt;?php</span><br>
    <span class="kw">$hewan</span> = [<span class="str">"Kucing"</span>, <span class="str">"Anjing"</span>, <span class="str">"Kelinci"</span>, <span class="str">"Hamster"</span>];<br><br>
    <span class="kw">foreach</span> (<span class="kw">$hewan</span> <span class="kw">as</span> <span class="kw">$nama</span>) {<br>
    &nbsp;&nbsp;<span class="fn">echo</span> <span class="kw">$nama</span> . <span class="str">"&lt;br&gt;"</span>;<br>
    }<br>
    <span class="kw">?&gt;</span>
  </div>

  <div class="pertanyaan">
    Apa output yang dihasilkan program di atas? (urutan benar)
  </div>

  <form method="POST">
    <div class="options">
      <?php
      $opts = [
        'A' => "Hamster\nKelinci\nAnjing\nKucing",
        'B' => "Kucing\nKelinci\nAnjing\nHamster",
        'C' => "Kucing\nAnjing\nKelinci\nHamster",
        'D' => "Anjing\nHamster\nKucing\nKelinci",
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
        <label class="option-label" for="opt<?= $k ?>">
          <strong><?= $k ?>.</strong> <?= nl2br(htmlspecialchars($v)) ?>
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
        ? '✅ Benar! foreach menelusuri array secara berurutan dari index 0, jadi output mengikuti urutan deklarasi array.'
        : '❌ Kurang tepat. Jawaban yang benar adalah <strong>C</strong>. foreach mencetak elemen array sesuai urutan aslinya.' ?>
    </div>

    <div class="output-box">
      <div class="output-label">Output Program</div>
      Kucing<br>
      Anjing<br>
      Kelinci<br>
      Hamster
    </div>

    <div style="margin-top:20px; text-align:right;">
      <a href="soal4.php" style="color:#0066cc; font-weight:bold; text-decoration:none;">
        Soal Berikutnya →
      </a>
    </div>
  <?php endif; ?>

  <div class="info-box">
    <h3>💡 Penjelasan Array & Foreach</h3>
    <p>Array di PHP bisa dideklarasikan menggunakan tanda kurung siku <code>[]</code>. Foreach secara otomatis mengambil setiap elemen dan menyimpannya ke variabel sementara (<code>$nama</code>). Urutan output sama persis dengan urutan elemen dalam array.</p>
  </div>
</div>
</body>
</html>