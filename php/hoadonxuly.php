<?php
require_once 'HoaDon.php';
require_once 'SanPham.php';
$hoaDon = new HoaDon(); // Khởi tạo đối tượng 
$sanPham = new SanPham();
// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $namenv = $_POST['namenv'];
            $namekh = $_POST['namekh'];
            $ngaytao = $_POST['ngaytao'];
            $totalAll = $_POST['totalAll'];
            $trangthai = $_POST['trangthai'];
            $productList = $_POST['productList'];
            $productAfter = $_POST['productAfter'];

            $result = $hoaDon->themHoaDon($namenv, $namekh, $ngaytao, $totalAll, $trangthai, $productList); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            $sanPham->updateSoLuong($productAfter);
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $nhaCungCap->xoaNhaCungCap((int) $id);
            if ($result) {
                echo "success";
            }
            break;

        case 'sua':
            $idhd = $_POST['idhd'];
            $namenv = $_POST['namenv'];
            $namekh = $_POST['namekh'];
            $ngaytao = $_POST['ngaytao'];
            $totalAll = $_POST['totalAll'];
            $trangthai = $_POST['trangthai'];
            $productList = $_POST['productList'];
            $productAfter = $_POST['productAfter'];
            $result = $hoaDon->suaHoaDon($idhd,$namenv, $namekh, $ngaytao, $totalAll, $trangthai, $productList); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            $sanPham->updateSoLuong($productAfter);
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>