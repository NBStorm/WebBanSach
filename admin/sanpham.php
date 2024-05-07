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

    }

    public function xoaSanPham($id)
    {

    }

    public function suaSanPham($id, $ten, $gia)
    {

    }

    public function updateSoLuong($productAfter)
    {
        foreach ($productAfter as $product) {
            $sql = "UPDATE sanpham SET SOLUONG=? WHERE MaSP = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $product['slsp'], $product['idsp']);
            $stmt->execute();
        }
        $stmt->close();
        $this->db->disconnect();
    }

    public function updateSL($id, $sl)
    {
        $sql = "UPDATE sanpham SET SOLUONG=SOLUONG+? WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $sl, $id);
        $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
    }


    public function getAll()
    {
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.MaTL=theloai.MaTL";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $sanPhamArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $sanPhamArray[] = array(
                    'id' => $row['MaSP'],
                    'ten' => $row['TenSP'],
                    'dongia' => $row['DonGia'],
                    'soluong' => $row['SoLuong'],
                    'tentl' => $row['TenTL'],
                    'hinhanh' => $row['HinhAnh']
                );
            }
            return $sanPhamArray;
        }
        $this->db->disconnect();

        return "";
    }
}
?>