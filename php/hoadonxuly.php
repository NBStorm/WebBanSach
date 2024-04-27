<?php
require_once 'HoaDon.php';

$hoaDon = new HoaDon(); // Khởi tạo đối tượng TheLoai

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

            $result = $hoaDon->themHoaDon($namenv, $namekh, $ngaytao, $totalAll, $trangthai, $productList); // Gọi hàm themTheLoai và lưu trạng thái kết quả vào biến $result
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
            $id = $_POST['MaNCC'];
            $ten = $_POST['TenNCC'];
            $sdt = $_POST['SoDienThoai'];
            $diachi = $_POST['DiaChi'];
            $nhaCungCapArray = $nhaCungCap->getAll();
            $found = false;
            foreach ($nhaCungCapArray as $item) {
                if (($item['ten'] == $ten) && ($item['id'] != $id)) {
                    echo "Tên thể loại đã xuất hiện";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result = $nhaCungCap->suaNhaCungCap($id, $ten, $sdt, $diachi);
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