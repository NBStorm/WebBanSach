<?php
require 'SanPham.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['startDate'];
    $end = $_POST['endDate'];
    $thongKeTheo = $_POST['thongKeTheo'];

    $sanpham = new SanPham();
    $data = $sanpham->thongKe($thongKeTheo,$start, $end);

    header('Content-Type: application/json');
    echo json_encode($data);
}
?>