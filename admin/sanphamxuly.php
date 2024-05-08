<?php
require_once 'sanpham.php';

$sanPham = new SanPham(); // Khởi tạo đối tượng TheLoai

// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $id = $_POST['MaSP'];
            $ten = $_POST['TenSP'];
            $gia = $_POST['DonGia'];
            $tl = $_POST['TheLoai'];
            $sl = 0;
            $hinhanh = $_POST['HinhAnh'];

            $result = $sanPham->themSanPham($ten, $gia, $tl, $sl, $hinhanh); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $sanPham->xoaSanPham((int) $id);
            if ($result) {
                echo "success";
            }
            break;

        case 'sua':
            $id = $_POST['MaSP'];
            $ten = $_POST['TenSP'];
            $gia = $_POST['DonGia'];
            $tl = $_POST['TheLoai'];
            $sl = 0;
            $hinhanh = $_POST['HinhAnh'];

            $result = $sanPham->suaSanPham($id,$ten, $gia, $tl, $sl, $hinhanh); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
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