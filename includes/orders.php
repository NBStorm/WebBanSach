<?php
require_once("DatabaseConnection.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];

    $db = new DatabaseConnection();
    $db->connect();

    $output = array(); // Khởi tạo mảng đầu ra

    // Giả sử bạn đã tìm thấy MaTK từ bảng taikhoan
    $sqlTaiKhoan = "SELECT MaTK FROM taikhoan WHERE Username = ?";
    $statementTaiKhoan = $db->prepare($sqlTaiKhoan);
    $statementTaiKhoan->bind_param("s", $username);
    $statementTaiKhoan->execute();
    $resultTaiKhoan = $statementTaiKhoan->get_result();

    if ($resultTaiKhoan->num_rows > 0) {
        $rowTaiKhoan = $resultTaiKhoan->fetch_assoc();
        $maTK = $rowTaiKhoan['MaTK'];
        $resultTaiKhoan->close();

        $sql1 = "SELECT * FROM hoadon WHERE MaKH = ?";
        $stmt = $db->prepare($sql1);
        $stmt->bind_param("i", $maTK);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $sqlChiTietHoaDon = "SELECT * FROM chitiethoadon WHERE MaHD = ?";
            $statementChiTietHoaDon = $db->prepare($sqlChiTietHoaDon);
            $statementChiTietHoaDon->bind_param("s", $row['MaHD']);
            $statementChiTietHoaDon->execute();
            $resultChiTietHoaDon = $statementChiTietHoaDon->get_result();

            $arrProduct = array();

            while ($row1 = $resultChiTietHoaDon->fetch_assoc()) {
                $sqlSanPham = "SELECT TenSP FROM sanpham WHERE MaSP = ?";
                $statementSanPham = $db->prepare($sqlSanPham);
                $statementSanPham->bind_param("s", $row1['MaSP']);
                $statementSanPham->execute();
                $resultSanPham = $statementSanPham->get_result();

                if ($resultSanPham->num_rows > 0) {
                    $rowSanPham = $resultSanPham->fetch_assoc();
                    $arrProduct[] = array(
                        'TenSP' => $rowSanPham['TenSP'],
                        'SoLuong' => $row1['SoLuong'],
                        'Gia' => $row1['Gia']
                    );
                }

                $statementSanPham->close();
            }

            $statementChiTietHoaDon->close();

            $output[] = array(
                "MaHD" => $row['MaHD'],
                'NgayTao' => $row['NgayTao'],
                'TongTien' => $row['TongTien'],
                'TrangThai' => $row['TrangThai'],
                'SanPham' => $arrProduct
            );
        }

        $stmt->close();
    }

    $db->disconnect();

    echo json_encode($output);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ hoặc dữ liệu không được nhận.']);
}
