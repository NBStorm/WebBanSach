<?php
require_once 'NguoiDung.php';

$nguoiDung = new NguoiDung(); // Khởi tạo đối tượng TheLoai

// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $id = $_POST['MaND'];
            $ten = $_POST['HoTen'];
            $sdt = $_POST['SoDienThoai'];
            $email = $_POST['Email'];

            $result = $nguoiDung->themNguoiDung($ten, $sdt, $email,$id); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $nguoiDung->xoaNguoiDung($id);
            if ($result) {
                echo "success";
            }
            break;

        case 'sua':
            $id = $_POST['MaND'];
            $ten = $_POST['HoTen'];
            $sdt = $_POST['SoDienThoai'];
            $diachi = $_POST['Email'];

            $result = $nguoiDung->suaNguoiDung($id, $ten, $sdt, $diachi);
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