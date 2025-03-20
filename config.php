<?php
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'nbt_chicken_food');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Kết nối thất bại: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8');
session_start();
$sql = "SELECT * FROM system where id = 1";
$result = mysqli_query($conn, $sql);
$system = mysqli_fetch_assoc($result);
$account = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customers WHERE username = '{$_SESSION['username']}'"));
?>
