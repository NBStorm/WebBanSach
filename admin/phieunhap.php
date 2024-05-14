<?php
require_once 'DatabaseConnection.php';

class PhieuNhap
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function themPhieuNhap($tennv, $tenkh, $ngaytao, $totalAll, $productList)
    {
        $sql = "INSERT INTO phieunhap (MaTK, MaNCC, NgayTao,TongTien) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisi", $tennv, $tenkh, $ngaytao, $totalAll);
        $result = $stmt->execute();
        if ($result) {
            $mapn = $this->db->getLastInsertedId();
            foreach ($productList as $product) {
                $sql2 = "INSERT INTO chitietphieunhap (MaPN, MaSP,SoLuong,GiaNhap) VALUES (?,?,?,?)";
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->bind_param("iiii", $mapn, $product['idsp'], $product['slsp'], $product['giasp']);
                $stmt2->execute();
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn INSERT!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function xoaPhieuNhap($id)
    {
        $check = $this->deleteCTPNByID($id);
        if ($check) {
            $sql = "DELETE FROM phieunhap WHERE MaPN = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function suaPhieuNhap($id, $tennv, $tenkh, $ngaytao, $totalAll, $productList)
    {
        $sql = "UPDATE phieunhap SET MaTK=?, MaNCC=?, NgayTao=?,TongTien=? WHERE MaPN = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisii", $tennv, $tenkh, $ngaytao, $totalAll, $id);
        $result = $stmt->execute();

        if ($result) {
            $this->deleteCTPNByID($id);
            foreach ($productList as $product) {
                $this->insertCTPN($id, $product['idsp'], $product['slsp'], $product['giasp']);
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn UPDATE!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function updateCTPN($id, $idsp, $soLuong, $gia)
    {
        $sql = "UPDATE chitietphieunhap SET SoLuong = $soLuong, GiaNhap = $gia WHERE MaPN = $id AND MaSP = $idsp";
        // Thực hiện truy vấn SQL
        $this->db->query($sql);
    }

    public function insertCTPN($id, $idsp, $soLuong, $gia)
    {
        $sql = "INSERT INTO chitietphieunhap (MaPN, MaSP, SoLuong,GiaNhap) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiii", $id, $idsp, $soLuong, $gia);
        $stmt->execute();
    }

    public function deleteCTPNByID($id)
    {
        // Chuẩn bị câu lệnh SQL để xóa chi tiết hóa đơn
        $sql = "DELETE FROM chitietphieunhap WHERE MaPN = ?";

        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        // Đóng câu lệnh và trả về kết quả
        $stmt->close();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT MaPN,nd.HoTen,ncc.TenNCC,TongTien,phieunhap.NgayTao
        FROM phieunhap,nguoidung nd,taikhoan tk,nhacungcap ncc
        where phieunhap.MaTK=tk.MaTK and tk.Username=nd.MaND and phieunhap.MaNCC=ncc.MaNCC";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $phieunhapArray = array();

            while ($row = $result->fetch_assoc()) {
                $phieunhapArray[] = array('id' => $row['MaPN'], 'tennv' => $row['HoTen'], 'tenncc' => $row['TenNCC'], 'total' => $row['TongTien'], 'date' => $row['NgayTao']);
            }
            return $phieunhapArray;
        }
        $this->db->disconnect();
        return "";
    }

    public function getPN()
    {
        $sql = "SELECT *
        FROM phieunhap";
        $result = $this->db->query($sql);
        $phieunhapArray = array();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $phieunhapArray[] = array('id' => $row['MaPN'], 'total' => $row['TongTien'], 'date' => $row['NgayTao']);
            }
            return $phieunhapArray;
        }
        $this->db->disconnect();
        return $phieunhapArray;
    }

    public function getCTPN($id)
    {
        $sql = "SELECT sanpham.MaSP,TenSP,chitietphieunhap.SoLuong,chitietphieunhap.GiaNhap from chitietphieunhap,sanpham where  chitietphieunhap.MaSP=sanpham.MaSP and MaPN=" . $id;
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $ctPNArray = array();

            while ($row = $result->fetch_assoc()) {
                $ctPNArray[] = array('id' => $row['MaSP'], 'tensp' => $row['TenSP'], 'soluong' => $row['SoLuong'], 'gia' => $row['GiaNhap']);
            }
            return $ctPNArray;
        }
        return "";
    }
}