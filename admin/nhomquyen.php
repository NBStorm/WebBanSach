<?php
require_once 'DatabaseConnection.php';

class NhomQuyen
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function themNhomQuyen($ten, $ctquyen)
    {
        $sql = "INSERT INTO nhomquyen (TenNQ) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $ten);
        $result = $stmt->execute();
        if ($result) {
            $manq = $this->db->getLastInsertedId();
            foreach ($ctquyen as $ct) {
                $sql2 = "INSERT INTO chitietquyen (MaNQ, MaCN, HoatDong) VALUES (?,?,?)";
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->bind_param("iis", $manq, $ct['idcn'], $ct['hd']);
                $stmt2->execute();
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn INSERT!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function xoaNhomQuyen($id)
    {
        $check = $this->deleteCTQByID($id);
        if ($check) {
            $sql = "DELETE FROM nhomquyen WHERE MaNQ = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }


    public function suaNhomQuyen($id, $ten, $ctq)
    {
        $sql = "UPDATE nhomquyen SET TenNQ=? WHERE MaNQ = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $ten, $id);
        $result = $stmt->execute();
        if ($result) {
            $this->deleteCTQById($id);
            foreach ($ctq as $ct) {
                $this->insertCTQ($id, $ct['idcn'], $ct['hd']);
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn UPDATE!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function insertCTQ($idnq, $idcn, $hd)
    {
        $sql2 = "INSERT INTO chitietquyen (MaNQ, MaCN, HoatDong) VALUES (?,?,?)";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bind_param("iis", $idnq, $idcn, $hd);
        $stmt2->execute();
    }

    public function deleteCTQByID($id)
    {
        // Chuẩn bị câu lệnh SQL để xóa chi tiết hóa đơn
        $sql = "DELETE FROM chitietquyen WHERE MaNQ = ?";

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
        $sql = "SELECT * FROM nhomquyen";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $nqArr = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $nqArr[] = array('id' => $row['MaNQ'], 'ten' => $row['TenNQ']);
            }
            return $nqArr;
        }
        $this->db->disconnect();
        return "";
    }

    public function getCTQ($id)
    {
        $sql = "SELECT nhomquyen.MaNQ,chucnang.MaCN,chitietquyen.HoatDong FROM nhomquyen,chucnang,chitietquyen WHERE nhomquyen.MaNQ=chitietquyen.MaNQ and chucnang.MaCN=chitietquyen.MaCN and nhomquyen.MaNQ=" . $id;
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $ctqarr = array();

            while ($row = $result->fetch_assoc()) {
                $ctqarr[] = array('idnq' => $row['MaNQ'], 'idcn' => $row['MaCN'], 'hd' => $row['HoatDong']);
            }
            return $ctqarr;
        }
        return "";
    }
}
?>