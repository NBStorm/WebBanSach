<?php
require_once 'DatabaseConnection.php';

class TheLoai
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function themTheLoai($ten)
    {
        $sql = "INSERT INTO theloai (TenTL) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $ten);
        $success = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $success;
    }

    public function xoaTheLoai($id)
    {
        $sql = "DELETE FROM theloai WHERE MaTL = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result; // Trả về kết quả của phương thức execute()
    }


    public function suaTheLoai($id, $ten)
    {
        $sql = "UPDATE theloai SET TenTL = ? WHERE MaTL = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $ten, $id);
        $result=$stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM theloai";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $theLoaiArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $theLoaiArray[] = array('id' => $row['MaTL'], 'ten' => $row['TenTL']);
            }
            return $theLoaiArray;
        }
        $this->db->disconnect();
        return "";
    }
}
?>