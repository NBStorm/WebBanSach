<?php
require_once 'NhomQuyen.php';

$nhomQuyen = new NhomQuyen(); // Khởi tạo đối tượng 

// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $id = $_POST['MaNQ'];
            $ten = $_POST['TenNQ'];
            $ctquyen = json_decode($_POST['chitietquyen'], true);

            $nhomQuyenArray = $nhomQuyen->getAll();
            $found = false;
            foreach ($nhomQuyenArray as $item) {
                if ($item['ten'] == $ten) {
                    echo "Tên nhóm đã xuất hiện";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result = $nhomQuyen->themNhomQuyen($ten, $ctquyen); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
                if ($result) {
                    echo true; // Trả về kết quả true nếu thêm thành công
                } else {
                    echo false; // Trả về kết quả false nếu thêm không thành công
                }
            }

            break;

        case 'xoa':
            $id = $_POST['recordId'];

            $result = $nhomQuyen->xoaNhomQuyen((int) $id);
            if ($result === true) {
                echo $result;
            } else {
                echo $result;
            }
            break;

        case 'sua':
            $id = $_POST['MaNQ'];
            $ten = $_POST['TenNQ'];
            $ctquyen = json_decode($_POST['chitietquyen'], true);

            $nhomQuyenArray = $nhomQuyen->getAll();
            $found = false;
            foreach ($nhomQuyenArray as $item) {
                if ($item['ten'] == $ten && ($item['id'] != $id)) {
                    echo "Tên nhóm quyền đã xuất hiện";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result = $nhomQuyen->suaNhomQuyen($id, $ten, $ctquyen); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
                if ($result) {
                    echo true; // Trả về kết quả true nếu thêm thành công
                } else {
                    echo false; // Trả về kết quả false nếu thêm không thành công
                }

            }
            break;
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>