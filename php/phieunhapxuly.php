<?php
require_once 'PhieuNhap.php';
require_once 'SanPham.php';
$phieuNhap = new PhieuNhap(); // Khởi tạo đối tượng 
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
            $productList = $_POST['productList'];
            $productAfter = $_POST['productAfter'];

            $result = $phieuNhap->themPhieuNhap($namenv, $namekh, $ngaytao, $totalAll, $productList); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            $sanPham->updateSoLuong($productAfter);
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $phieuNhap->xoaPhieuNhap((int) $id);
            if ($result) {
                echo $result;
                echo "success";
            }else{
                echo $result;
            }
            break;

        case 'sua':
            $idhd = $_POST['idhd'];
            $namenv = $_POST['namenv'];
            $namekh = $_POST['namekh'];
            $ngaytao = $_POST['ngaytao'];
            $totalAll = $_POST['totalAll'];
            $productList = $_POST['productList'];
            $productAfter = $_POST['productAfter'];
            $result = $phieuNhap->suaPhieuNhap($idhd,$namenv, $namekh, $ngaytao, $totalAll, $productList); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
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