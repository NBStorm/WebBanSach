<?php

require 'hoadon.php';

$hoadon = new HoaDon();
$data = $hoadon->thongKeThang();

header('Content-Type: application/json');
echo json_encode($data);
?>