<?php
require_once 'DatabaseConnection.php';

class NguoiDung
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
        $sql = "SELECT * FROM nguoidung";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $s = "";

            while ($row = $result->fetch_assoc()) {
                $s .= "<tr>
                        <td>" . $row['MaND'] . "</td>
                        <td>" . $row['HoTen'] . "</td>
                        <td>" . $row['SoDienThoai'] . "</td>
                        <td>" . $row['Email'] . "</td>
                    </tr>";
            }

            return $s;
        }

        return "";
    }
}
?>