<?php
require_once 'DatabaseConnection.php';
require_once 'SanPham.php';
class HoaDon
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function themHoaDon($tennv, $tenkh, $ngaytao, $totalAll, $trangthai, $productList)
    {
        $sql = "INSERT INTO hoadon (MaNV, MaKH, NgayTao,TongTien,TrangThai) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisis", $tennv, $tenkh, $ngaytao, $totalAll, $trangthai);
        $result = $stmt->execute();
        if ($result) {
            $mahd = $this->db->getLastInsertedId();
            foreach ($productList as $product) {
                $sql2 = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong,Gia) VALUES (?,?,?,?)";
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->bind_param("iiii", $mahd, $product['idsp'], $product['slsp'], $product['giasp']);
                $stmt2->execute();
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn INSERT!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function xoaHoaDon($id)
    {
        $check = $this->deleteCTHDByID($id);
        if ($check) {
            $sql = "DELETE FROM hoadon WHERE MaHD = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
        }
        $stmt->close();
        $this->db->disconnect();
        return $result; // Trả về kết quả của phương thức execute()

    }

    public function suaHoaDon($idhd, $tennv, $tenkh, $ngaytao, $totalAll, $trangthai, $productList)
    {
        $sql = "UPDATE hoadon SET MaNV=?, MaKH=?, NgayTao=?,TongTien=?,TrangThai=? WHERE MaHD = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisisi", $tennv, $tenkh, $ngaytao, $totalAll, $trangthai, $idhd);
        $result = $stmt->execute();

        if ($result) {
            $this->deleteCTHDByID($idhd);
            foreach ($productList as $product) {
                $this->insertCTHD($idhd, $product['idsp'], $product['slsp'], $product['giasp']);
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn UPDATE!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function updateCTHD($idhd, $idsp, $soLuong, $gia)
    {
        $sql = "UPDATE chitiethoadon SET SoLuong = $soLuong, Gia = $gia WHERE MaHD = $idhd AND MaSP = $idsp";
        // Thực hiện truy vấn SQL
        $this->db->query($sql);
    }

    public function insertCTHD($idhd, $idsp, $soLuong, $gia)
    {
        $sql = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong,Gia) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiii", $idhd, $idsp, $soLuong, $gia);
        $stmt->execute();
    }

    public function deleteCTHDByID($idhd)
    {
        // Chuẩn bị câu lệnh SQL để xóa chi tiết hóa đơn
        $sql = "DELETE FROM chitiethoadon WHERE MaHD = ?";

        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idhd);
        $result = $stmt->execute();

        // Đóng câu lệnh và trả về kết quả
        $stmt->close();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT MaHD,nd1.HoTen AS TenNhanVien, nd2.HoTen AS TenKhachHang,TongTien,hoadon.NgayTao,TrangThai
        FROM hoadon,nguoidung nd1,nguoidung nd2,taikhoan tk1,taikhoan tk2
        where hoadon.MaNV=tk1.MaTK and tk1.Username=nd1.MaND and hoadon.MaKH=tk2.MaTK AND nd2.MaND=tk2.Username";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $hoaDonArray = array();

            while ($row = $result->fetch_assoc()) {
                $hoaDonArray[] = array('id' => $row['MaHD'], 'tennv' => $row['TenNhanVien'], 'tenkh' => $row['TenKhachHang'], 'total' => $row['NgayTao'], 'date' => $row['TongTien'], 'trangthai' => $row['TrangThai']);
            }
            return $hoaDonArray;
        }
        $this->db->disconnect();
        return "";
    }

    public function getCTHD($id)
    {
        $sql = "SELECT sanpham.MaSP,TenSP,chitiethoadon.SoLuong,chitiethoadon.Gia from chitiethoadon,sanpham where  chitiethoadon.MaSP=sanpham.MaSP and MaHD=" . $id;
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $ctHoaDonArray = array();

            while ($row = $result->fetch_assoc()) {
                $ctHoaDonArray[] = array('id' => $row['MaSP'], 'tensp' => $row['TenSP'], 'soluong' => $row['SoLuong'], 'gia' => $row['Gia']);
            }
            return $ctHoaDonArray;
        }
        return "";
    }
}
?>