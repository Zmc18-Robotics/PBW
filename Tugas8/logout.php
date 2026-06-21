<?php
// logout.php
session_start();

// Hapus semua data session
$_SESSION = [];
session_destroy();

// Arahkan kembali ke form login
header("Location: login.php");
exit;
?>
