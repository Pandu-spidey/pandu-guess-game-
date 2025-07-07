<?php
session_start();
include "db.php";

$mode = $_GET['mode'] ?? 'login';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    if ($_POST['action'] === 'register') {
        // Register user baru
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $check = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($check->num_rows > 0) {
            $error = "❌ Username sudah terpakai";
        } else {
            $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$hashed')");
            header("Location: auth.php?mode=login&msg=register_success");
            exit();
        }
    } else {
        // Login
        $res = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $res->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['tries'] = 0;
            $_SESSION['secret'] = rand(1,10);
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Username atau password salah";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $mode === 'register' ? 'Register' : 'Login' ?> | Tebak Angka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-container">
    <h2><?= $mode === 'register' ? 'Daftar Akun Baru' : 'Login ke Game' ?></h2>

    <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'register_success'): ?>
        <p class="success">✅ Pendaftaran berhasil! Silakan login.</p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="hidden" name="action" value="<?= $mode ?>">
        <button type="submit"><?= $mode === 'register' ? 'Daftar' : 'Login' ?></button>
    </form>

    <div class="switch">
        <?php if ($mode === 'register'): ?>
            Sudah punya akun? <a href="auth.php?mode=login">Login di sini</a>
        <?php else: ?>
            Belum punya akun? <a href="auth.php?mode=register">Daftar dulu</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
