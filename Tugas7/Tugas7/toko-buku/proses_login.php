<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        header('Location: login.php?error=1');
        exit;
    }
    
    if ($username === 'Admin' && $password === 'Admin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'Admin';
        $_SESSION['role'] = 'admin';
        header('Location: index.php');
        exit;
    }
    
    header('Location: login.php?error=1');
    exit;
}
?>
