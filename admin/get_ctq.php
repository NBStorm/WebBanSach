<?php
require_once 'NhomQuyen.php';
// Kiểm tra xem có yêu cầu AJAX gửi lên không và có truyền id không
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Lấy id từ yêu cầu
    $id = $_GET['id'];

    // Gọi hàm hoặc thực hiện các công việc để lấy thông tin hóa đơn với id đã cho
    
    $nhomQuyen = new NhomQuyen();
    $ctq = $nhomQuyen->getCTQ($id);

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($ctq);
    exit; // Kết thúc kịch bản
}
?>
