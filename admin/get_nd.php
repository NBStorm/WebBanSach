<?php
require_once 'NguoiDung.php';
// Kiểm tra xem có yêu cầu AJAX gửi lên không và có truyền id không
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Lấy id từ yêu cầu
    $id = $_GET['id'];

    // Gọi hàm hoặc thực hiện các công việc để lấy thông tin hóa đơn với id đã cho
    
    $nguoidung = new NguoiDung();
    $nguoiDungArray = $nguoidung->getListTK($id);

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($nguoiDungArray);
    exit; // Kết thúc kịch bản
}
?>
