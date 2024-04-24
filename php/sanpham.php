<?php
require_once 'DatabaseConnection.php';

class SanPham
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
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.MaTL=theloai.MaTL";
        $result = $this->db->query($sql);

        /*if ($result->num_rows > 0) {
            $s = "";

            while ($row = $result->fetch_assoc()) {
                $s .= "<tr>
                        <td>" . $row['MaSP'] . "</td>
                        <td>" . $row['TenSP'] . "</td>
                        <td>" . $row['DonGia'] . "</td>
                        <td>" . $row['SoLuong'] . "</td>
                        <td>" . $row['TenTL'] . "</td>
                        <td><img src='../img/".$row['HinhAnh']."' width='100px' height='100px'></td>
                    </tr>";
            }

            return $s;
        }*/
        if ($result->num_rows > 0) {
            $sanPhamArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $sanPhamArray[] = array('id' => $row['MaSP'], 'ten' => $row['TenSP'], 'dongia' => $row['DonGia'], 
                                        'soluong' => $row['SoLuong'], 'tentl' => $row['TenTL'], 'hinhanh' => $row['HinhAnh']);
            }
            return $sanPhamArray;
        }
        $this->db->disconnect();

        return "";
    }
}
?>