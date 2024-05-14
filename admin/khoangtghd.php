<?php
require 'HoaDon.php';

// Thiết lập báo cáo lỗi để hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thiết lập loại nội dung là JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu POST thô
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Đảm bảo các khóa bắt buộc có mặt
    if (isset($data['startDate']) && isset($data['endDate'])) {
        $start = $data['startDate'];
        $end = $data['endDate'];

        $hoaDon = new HoaDon();
        $results = $hoaDon->searchHD($start, $end);

        echo json_encode($results);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>
