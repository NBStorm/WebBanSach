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

    public function themSanPham($ten, $gia, $tl, $sl, $hinhanh)
    {
        $sql = "INSERT INTO sanpham (TenSP,DonGia,MaTL,SoLuong,HinhAnh) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("siiis", $ten, $gia, $tl, $sl, $hinhanh);
        $success = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $success;
    }

    public function xoaSanPham($id)
    {
        $sql = "DELETE FROM sanpham WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function suaSanPham($id, $ten, $gia, $tl, $sl, $hinhanh)
    {
        $sql = "UPDATE sanpham SET TenSP = ?, DonGia = ?, MaTL = ?, SoLuong = ?, HinhAnh = ? WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("siiisi", $ten, $gia, $tl, $sl, $hinhanh, $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
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

    public function thongKeSPBanChay($start, $end)
    {
        $sql = "SELECT sp.MaSP, sp.TenSP, SUM(cthd.SoLuong) AS total_quantity
                FROM sanpham sp
                JOIN chitiethoadon cthd ON sp.MaSP = cthd.MaSP
                JOIN hoadon hd ON cthd.MaHD = hd.MaHD
                WHERE hd.NgayTao BETWEEN ? AND ?
                  AND hd.TrangThai = 'Đã giao'
                GROUP BY sp.MaSP, sp.TenSP
                ORDER BY total_quantity DESC  
                LIMIT 5;";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ss', $start, $end);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $stmt->close();
        return $data;
    }
}
?>