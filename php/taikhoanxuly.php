<?php
require_once 'taikhoan.php';

$taiKhoan = new TaiKhoan(); // Khởi tạo đối tượng TheLoai

// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $id = $_POST['MaTK'];
            $user = $_POST['Username'];
            $pass = $_POST['Password'];
            $nq = $_POST['NhomQuyen'];
            $date = $_POST['NgayTao'];

            $result = $taiKhoan->themTaiKhoan($user, $pass, $nq,$date); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
            if ($result) {
                echo true; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $taiKhoan->xoaTaiKhoan((int) $id);
            if ($result) {
                echo "success";
            }
            break;

        case 'sua':
            $id = $_POST['MaTK'];
            $user = $_POST['Username'];
            $pass = $_POST['Password'];
            $nq = $_POST['NhomQuyen'];

            $result = $taiKhoan->suaTaiKhoan($id, $user, $pass, $nq);
            if ($result) {
                echo $result; // Trả về kết quả true nếu thêm thành công
            } else {
                echo false; // Trả về kết quả false nếu thêm không thành công
            }

            break;
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>