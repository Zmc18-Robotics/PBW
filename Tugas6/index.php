<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tugas 6</title></head>
<body>
    <div style="position: fixed; top: 10px; right: 10px; z-index: 9999;"><a href="logout.php" style="padding: 8px 15px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-family: sans-serif; font-size: 14px;">Logout</a></div>
    <h2>Menu Tugas 6</h2>
    <ul>
        <li><a href="latihan_diskon.php">Latihan Diskon</a></li>
        <li><a href="latihan_nilai.php">Latihan Nilai</a></li>
    </ul>
</body>
</html>