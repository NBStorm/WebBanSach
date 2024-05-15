<?php

require_once("DatabaseConnection.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart']) && isset($_POST['username']) && isset($_POST['currentDate']) && $_POST['totalPrice']) {
    $cart = json_decode($_POST['cart'], true);
    $username = $_POST['username'];
    $currentDate = $_POST['currentDate'];
    $totalPrice = $_POST['totalPrice'];

    if (!is_array($cart)) {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu giỏ hàng không hợp lệ']);
        exit();
    }

    $db = new DatabaseConnection();
    $db->connect();

    // Biến kiểm tra số lượng
    $isEnoughQuantity = true;
    $errorMessage = '';

    // Kiểm tra số lượng từng sản phẩm trong giỏ hàng
    foreach ($cart as $item) {
        $maSP = $item['ma'];
        $soLuongTrongCart = $item['soLuong'];

        // Lấy số lượng sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT SoLuong FROM sanpham WHERE MaSP = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param("i", $maSP);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $soLuongTrongDB = $row['SoLuong'];

            if ($soLuongTrongCart > $soLuongTrongDB) {
                $isEnoughQuantity = false;
                $errorMessage .= 'Sản phẩm ' . $item['ten'] . ' không đủ số lượng' . "\n";
            }
        } else {
            $isEnoughQuantity = false;
            $errorMessage = 'Sản phẩm ' . $maSP . ' không tồn tại';
            break;
        }
        $result->close();
    }

    if ($isEnoughQuantity) {
        // Bắt đầu giao dịch
        $db->begin_transaction();

        $productList = array();
        try {
            // Trừ số lượng và cập nhật lại số lượng sản phẩm trong cơ sở dữ liệu
            foreach ($cart as $item) {
                $maSP = $item['ma'];
                $soLuongTrongCart = $item['soLuong'];
                $gia = $item['gia'];

                // Thêm sản phẩm vào mảng productList
                $productList[] = array(
                    'idsp' => $maSP,
                    'slsp' => $soLuongTrongCart,
                    'giasp' => $gia
                );

                // Trừ số lượng sản phẩm trong giỏ hàng từ số lượng hiện có trong cơ sở dữ liệu
                $sqlUpdate = "UPDATE sanpham SET SoLuong = SoLuong - ? WHERE MaSP = ?";
                $statementUpdate = $db->prepare($sqlUpdate);
                $statementUpdate->bind_param("ii", $soLuongTrongCart, $maSP);
                $statementUpdate->execute();
                $statementUpdate->close();
            }

            // Kiểm tra tài khoản
            $sqlTaiKhoan = "SELECT MaTK FROM taikhoan WHERE Username = ?";
            $statementTaiKhoan = $db->prepare($sqlTaiKhoan);
            $statementTaiKhoan->bind_param("s", $username);
            $statementTaiKhoan->execute();
            $resultTaiKhoan = $statementTaiKhoan->get_result();

            if ($resultTaiKhoan->num_rows > 0) {
                $rowTaiKhoan = $resultTaiKhoan->fetch_assoc();
                $maTK = $rowTaiKhoan['MaTK'];
                $resultTaiKhoan->close();

                $trangthai = "Đợi xác nhận";

                $sql1 = "INSERT INTO hoadon (MaKH, NgayTao, TongTien, TrangThai) VALUES (?, ?, ?, ?)";
                $stmt = $db->prepare($sql1);

                $stmt->bind_param("isis", $maTK, $currentDate, $totalPrice, $trangthai);


                if ($stmt->execute()) {
                    $mahd = $stmt->insert_id;
                    foreach ($productList as $product) {
                        $sql2 = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong,Gia) VALUES (?,?,?,?)";
                        $stmt2 = $db->prepare($sql2);
                        $stmt2->bind_param("iiii", $mahd, $product['idsp'], $product['slsp'], $product['giasp']);
                        $stmt2->execute();
                    }
                    $stmt2->close();
                }

                $stmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy tài khoản.']);
                exit();
            }

            // Nếu tất cả sản phẩm đều hợp lệ, tiến hành thanh toán
            $db->commit();
            $db->disconnect();
            echo json_encode(['status' => 'success', 'message' => 'Đơn hàng được đặt thành công.']);
            exit();
        } catch (Exception $e) {
            // Rollback giao dịch nếu có lỗi
            $db->rollback();
            echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi xử lý đơn hàng.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => $errorMessage]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ hoặc dữ liệu giỏ hàng không được nhận.']);
    exit();
}
