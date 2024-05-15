<?php
require_once 'TaiKhoan.php';
require_once 'NguoiDung.php';
$taiKhoan = new TaiKhoan(); // Khởi tạo đối tượng 
$nguoiDung = new NguoiDung();
// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'signup':
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $date = $_POST['date'];

            $nguoiDungArray = $nguoiDung->getAll();
            $found = false;
            foreach ($nguoiDungArray as $item) {
                if ($item['id'] == $id) {
                    echo "Mã này đã có người dùng";
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $result1 = $nguoiDung->themNguoiDung($fullName, $phone, $email, $username);
                if ($result1) {
                    $result2 = $taiKhoan->themTaiKhoan($username, $password, '2', $date);
                    if ($result2) {
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'Thêm thất bại';
                }
            }
            break;
        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $taiKhoan->logIn($username, $password); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result

            if (!$result) {
                echo false;
            } else {
                header('Content-Type: application/json');
                echo json_encode($result);
            }
            break;
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>