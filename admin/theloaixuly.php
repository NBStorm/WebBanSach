<?php
require_once 'TheLoai.php'; // Đảm bảo rằng file này chứa class TheLoai với các method cần thiết

$theLoai = new TheLoai(); // Khởi tạo đối tượng TheLoai

// Kiểm tra phương thức POST để thực thi các hành động thêm, sửa, hoặc xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Lấy giá trị action từ POST để xác định hành động

    switch ($action) {
        case 'them':
            $ten = $_POST['TenTL'];
            $theLoaiArray = $theLoai->getAll();
            $found=false;
            foreach ($theLoaiArray as $item) {
                if ($item['ten'] == $ten) {
                    echo "Tên thể loại đã xuất hiện";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result = $theLoai->themTheLoai($ten); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
                if ($result) {
                    echo true; // Trả về kết quả true nếu thêm thành công
                } else {
                    echo false; // Trả về kết quả false nếu thêm không thành công
                }
            }
            break;

        case 'xoa':
            $id = $_POST['recordId'];
            $result = $theLoai->xoaTheLoai((int) $id);
            if ($result) {
                echo "success";
            }
            break;

        case 'sua':
            $id = $_POST['MaTL'];
            $ten = $_POST['TenTL'];
            $theLoaiArray = $theLoai->getAll();
            $found=false;
            foreach ($theLoaiArray as $item) {
                if ($item['ten'] == $ten &&($item['id']!=$id)) {
                    echo "Tên thể loại đã xuất hiện";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result = $theLoai->suaTheLoai($id,$ten); 
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