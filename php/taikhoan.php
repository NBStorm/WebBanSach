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

    public function themTaiKhoan($user,$pass,$manq,$date)
    {
        $sql = "INSERT INTO taikhoan (Username,Password,MaNQ,NgayTao) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssis", $user, $pass,$manq,$date);
        $success = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $success;
    }

    public function xoaTaiKhoan($id)
    {
        $sql = "DELETE FROM taikhoan WHERE MaTK = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function suaTaiKhoan($id,$user,$pass,$manq)
    {
        $sql = "UPDATE taikhoan SET Username = ?, Password=?, MaNQ=? WHERE MaTK = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssii", $user,$pass,$manq, $id);
        $result=$stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM taikhoan,nhomquyen WHERE taikhoan.MaNQ=nhomquyen.MaNQ";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $taiKhoanArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $taiKhoanArray[] = array('id' => $row['MaTK'], 'user' => $row['Username'], 'pass' => $row['Password'], 'nnq' => $row['TenNQ'], 'date' => $row['NgayTao']);
            }
            return $taiKhoanArray;
        }
        $this->db->disconnect();
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