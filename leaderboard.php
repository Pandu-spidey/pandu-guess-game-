<?php
include "db.php";
$res = $conn->query("SELECT username, score FROM users ORDER BY score DESC LIMIT 10");
?>
<h2>🏆 Leaderboard</h2>
<ol>
<?php while ($row = $res->fetch_assoc()): ?>
    <li><?= $row['username'] ?> – <?= $row['score'] ?> pts</li>
<?php endwhile; ?>
</ol>
<a href="index.php">← Kembali</a>
