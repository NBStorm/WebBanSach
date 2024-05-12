<?php
// Bắt đầu session
session_start();

// Xóa tất cả các biến session bằng cách sử dụng session_unset()
session_unset();

session_destroy();

// Chuyển hướng người dùng về trang index.php hoặc trang đăng nhập của bạn
header("Location: ../index.php");
exit;
?>
