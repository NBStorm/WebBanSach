<?php
require_once 'DatabaseConnection.php';

class TaiKhoan
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
        $sql = "SELECT * FROM taikhoan,nhomquyen WHERE taikhoan.MaNQ=nhomquyen.MaNQ";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $s = "";

            while ($row = $result->fetch_assoc()) {
                $s .= "<tr>
                        <td>" . $row['MaTK'] . "</td>
                        <td>" . $row['Username'] . "</td>
                        <td>" . $row['Password'] . "</td>
                        <td>" . $row['TenNQ'] . "</td>
                        <td>" . $row['NgayTao'] . "</td>
                    </tr>";
            }

            return $s;
        }

        return "";
    }

    public function getListKH()
    {
        $sql = "SELECT taikhoan.MaTK,nguoidung.HoTen FROM taikhoan,nguoidung where nguoidung.MaND=taikhoan.Username and taikhoan.MaNQ='2'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $khachHangArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $khachHangArray[] = array('id' => $row['MaTK'], 'ten' => $row['HoTen']);
            }
            return $khachHangArray;
        }
        $this->db->disconnect();

        return "";
    }

    public function getListNV()
    {
        $sql = "SELECT taikhoan.MaTK,nguoidung.HoTen FROM taikhoan,nguoidung where nguoidung.MaND=taikhoan.Username and taikhoan.MaNQ!='2'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $nhanVienArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $nhanVienArray[] = array('id' => $row['MaTK'], 'ten' => $row['HoTen']);
            }
            return $nhanVienArray;
        }
        $this->db->disconnect();

        return "";
    }
}
?>