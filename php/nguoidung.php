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

    public function themNguoiDung($ten,$sdt,$email,$id)
    {
        $sql = "INSERT INTO nguoidung (MaND,HoTen,SoDienThoai,Email) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $id, $ten,$sdt,$email);
        $success = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $success;
    }

    public function xoaNguoiDung($id)
    {
        $sql = "DELETE FROM nguoidung WHERE MaND = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function suaNguoiDung($id, $ten, $sdt, $email)
    {
        $sql = "UPDATE nguoidung SET HoTen = ?, SoDienThoai=?, Email=? WHERE MaND = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $ten,$sdt,$email, $id);
        $result=$stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM nguoidung";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $nguoiDungArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $nguoiDungArray[] = array('id' => $row['MaND'], 'ten' => $row['HoTen'], 'sdt' => $row['SoDienThoai'], 'email' => $row['Email']);
            }
            return $nguoiDungArray;
        }
        $this->db->disconnect();
        return "";
    }
}
?>