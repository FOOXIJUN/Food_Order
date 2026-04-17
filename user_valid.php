<?php
session_start();

// 防止直接访问这个文件
if (basename($_SERVER['SCRIPT_FILENAME']) == 'user_valid.php') {
    header("Location: login.php");
    exit();
}

// 验证用户是否登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
