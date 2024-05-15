<?php
require 'SanPham.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['startDate'];
    $end = $_POST['endDate'];

    $sanpham = new SanPham();
    $data = $sanpham->thongKeSPBanChay($start, $end);

    header('Content-Type: application/json');
    echo json_encode($data);
}
?>