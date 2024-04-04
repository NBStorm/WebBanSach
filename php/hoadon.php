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

    public function themSanPham($ten, $gia)
    {
        $sql = "INSERT INTO sanpham (ten, gia) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $ten, $gia);
        $stmt->execute();
        $stmt->close();
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
        $sql = "SELECT MaHD,nd1.HoTen AS TenNhanVien, nd2.HoTen AS TenKhachHang,TongTien,hoadon.NgayTao
        FROM hoadon,nguoidung nd1,nguoidung nd2,taikhoan tk1,taikhoan tk2
        where hoadon.MaNV=tk1.MaTK and tk1.Username=nd1.MaND and hoadon.MaKH=tk2.MaTK AND nd2.MaND=tk2.Username";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $s = "";

            while ($row = $result->fetch_assoc()) {
                $s .= "<tr>
                        <td>" . $row['MaHD'] . "</td>
                        <td>" . $row['TenNhanVien'] . "</td>
                        <td>" . $row['TenKhachHang'] . "</td>
                        <td>" . $row['TongTien'] . "</td>
                        <td>" . $row['NgayTao'] . "</td>
                    </tr>";
            }

            return $s;
        }

        return "";
    }
}
?>