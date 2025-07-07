<?php
session_start();
session_unset();   // bersihin semua data di $_SESSION
session_destroy(); // hancurkan session sepenuhnya
header("Location: auth.php?mode=login");
exit();
