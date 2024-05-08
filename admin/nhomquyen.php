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

    public function themNhomQuyen($ten,$ctquyen)
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
                $stmt2->bind_param("iis", $manq,$ct['idcn'],$ct['hd']);
                $stmt2->execute();
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn INSERT!";
        }
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function xoaNhaCungCap($id)
    {
        $sql = "DELETE FROM nhacungcap WHERE MaNCC = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result; // Trả về kết quả của phương thức execute()
    }


    public function suaNhaCungCap($id, $ten, $sdt, $diachi)
    {
        $sql = "UPDATE nhacungcap SET TenNCC = ?, SDT=?, DiaChi=? WHERE MaNCC = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $ten,$sdt,$diachi, $id);
        $result=$stmt->execute();
        $stmt->close();
        $this->db->disconnect();
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