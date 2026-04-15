<?php
session_start();
if (empty($_SESSION['nama'])) { header('Location: index.php'); exit; }

$kunci   = 'B';
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
<title>Soal 4 - Function PHP</title>
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
nav table { width: 100%; border-collapse: collapse; }
nav td { padding: 10px; }
nav a { color: navy; text-decoration: none; }
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
/* Highlight untuk jawaban yang benar */
.option.correct-highlight {
  background-color: #d4edda;
  border: 1px solid #28a745;
}
/* Highlight untuk jawaban yang salah (yang dipilih user) */
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
    <div class="nav-left"><a href="menu.php">← Menu Soal</a></div>
    <div class="page-nav">
      <a href="soal1.php">1</a>
      <a href="soal2.php">2</a>
      <a href="soal3.php">3</a>
      <a href="soal4.php" class="active">4</a>
    </div>
  </nav>

  <div class="tag">Soal 04 &nbsp;·&nbsp; Pilihan Ganda</div>
  <h1>Function PHP – Penjumlahan</h1>
  <p class="meta">Perhatikan kode berikut lalu jawab pertanyaannya.</p>

  <div class="code-block">
    <span class="cm">// Function penjumlahan sederhana</span><br>
    <span class="kw">&lt;?php</span><br>
    <span class="kw">function</span> <span class="fn">tambah</span>(<span class="kw">$a</span>, <span class="kw">$b</span>) {<br>
    &nbsp;&nbsp;<span class="kw">return</span> <span class="kw">$a</span> + <span class="kw">$b</span>;<br>
    }<br><br>
    <span class="fn">echo</span> <span class="fn">tambah</span>(<span class="lit">5</span>, <span class="lit">3</span>);<br>
    <span class="kw">?&gt;</span>
  </div>

  <div class="pertanyaan">
    Apa output yang dihasilkan program di atas?
  </div>

  <form method="POST">
    <div class="options">
      <?php
      $opts = [
        'A' => "5 + 3 = 8",
        'B' => "8",
        'C' => "tambah(5, 3)",
        'D' => "Error: function tidak dikenali",
      ];
      foreach ($opts as $k => $v):
        // Tentukan kelas untuk div pembungkus
        $divClass = 'option';
        if ($selected !== null) {
          if ($k === $kunci) {
            $divClass .= ' correct-highlight';
          } elseif ($k === $selected && !$correct) {
            $divClass .= ' wrong-highlight';
          }
        }
      ?>
      <div class="<?php echo $divClass; ?>">
        <input type="radio" name="jawaban" id="opt<?php echo $k; ?>" value="<?php echo $k; ?>"
          <?php echo $selected === $k ? 'checked' : ''; ?>
          <?php echo $selected !== null ? 'disabled' : ''; ?>>
        <label class="option-label" for="opt<?php echo $k; ?>">
          <strong><?php echo $k; ?>.</strong> <?php echo htmlspecialchars($v); ?>
        </label>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if ($selected === null): ?>
      <button type="submit" class="btn-submit">Kirim Jawaban</button>
    <?php endif; ?>
  </form>

  <?php if ($selected !== null): ?>
    <div class="feedback <?php echo $correct ? 'ok' : 'err'; ?>">
      <?php echo $correct
        ? '✅ Benar! Function mengembalikan hasil penjumlahan 5 + 3 = 8 melalui return statement.'
        : '❌ Kurang tepat. Jawaban yang benar adalah <strong>B</strong>. Function hanya menampilkan hasil return melalui echo.'; ?>
    </div>

    <div class="output-box">
      <div class="output-label">Output Program</div>
      8
    </div>

    <div class="info-box">
      <h3>💡 Penjelasan Function PHP</h3>
      <p>Function didefinisikan dengan kata kunci <code>function</code>, diikuti nama dan parameter dalam kurung. <code>return</code> mengembalikan nilai ke pemanggil. Saat dipanggil dengan <code>tambah(5, 3)</code>, function mengeksekusi dan return hasilnya.</p>
    </div>
  <?php endif; ?>
</div>
</body>
</html>