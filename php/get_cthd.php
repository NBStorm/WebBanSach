<?php
require_once 'HoaDon.php';
// Kiểm tra xem có yêu cầu AJAX gửi lên không và có truyền id không
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Lấy id từ yêu cầu
    $id = $_GET['id'];

    // Gọi hàm hoặc thực hiện các công việc để lấy thông tin hóa đơn với id đã cho
    
    $hoaDon = new HoaDon();
    $ctHoaDon = $hoaDon->getCTHD($id);

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($ctHoaDon);
    exit; // Kết thúc kịch bản
}
?>
