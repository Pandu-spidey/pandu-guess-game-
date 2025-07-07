<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Inisialisasi
if (!isset($_SESSION['secret'])) $_SESSION['secret'] = rand(1, 10);
if (!isset($_SESSION['tries'])) $_SESSION['tries'] = 0;

$message = "";
$done = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['tries'] < 5) {
    $guess = (int)$_POST['guess'];
    $_SESSION['tries']++;

    $secret = $_SESSION['secret'];
    $result = "";
    
    if ($guess == $secret) {
        $message = "🎉 Benar! Angkanya $secret";
        $result = "Benar";
        $_SESSION['secret'] = rand(1, 10);
        $_SESSION['tries'] = 0;

        // Tambah skor user
        $uid = $_SESSION['user_id'];
        $conn->query("UPDATE users SET score = score + 10 WHERE id = $uid");
    } elseif ($guess < $secret) {
        $message = "Terlalu kecil!";
        $result = "Terlalu kecil";
    } else {
        $message = "Terlalu besar!";
        $result = "Terlalu besar";
    }

    // Simpan tebakan ke DB
    $uid = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO guesses (user_id, guess, result) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $uid, $guess, $result);
    $stmt->execute();
} elseif ($_SESSION['tries'] >= 5) {
    $done = true;
    $message = "🚫 Tebakan habis! Klik reset untuk mulai ulang.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tebak Angka Multi-User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Hai, <?= $_SESSION['username'] ?>!</h1>
    <p><strong>Skor:</strong> <?= $conn->query("SELECT score FROM users WHERE id = ".$_SESSION['user_id'])->fetch_assoc()['score'] ?></p>

    <?php if (!$done): ?>
        <form method="POST">
            <input type="number" name="guess" min="1" max="10" required>
            <button type="submit">Tebak</button>
        </form>
    <?php endif; ?>

    <p class="result"><?= $message ?></p>
    <p>Sisa percobaan: <?= 5 - $_SESSION['tries'] ?>/5</p>
    <a href="reset.php">🔄 Reset Game</a> | <a href="leaderboard.php">🏆 Leaderboard</a> | <a href="logout.php">🚪 Logout</a>
</div>
</body>
</html>
