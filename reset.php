<?php
session_start();
$_SESSION['secret'] = rand(1,10);
$_SESSION['tries'] = 0;
header("Location: index.php");
