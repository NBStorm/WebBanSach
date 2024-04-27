<?php
require_once 'DatabaseConnection.php';

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

    public function xoaSanPham($id)
    {
        $sql = "DELETE FROM sanpham WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function suaSanPham($id, $ten, $gia)
    {
        $sql = "UPDATE sanpham SET ten = ?, gia = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $ten, $gia, $id);
        $stmt->execute();
        $stmt->close();
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
}
?>