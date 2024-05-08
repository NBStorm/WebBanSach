<?php
require_once 'DatabaseConnection.php';

class ChucNang
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM chucnang";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $theLoaiArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $theLoaiArray[] = array('id' => $row['MaCN'], 'ten' => $row['TenCN']);
            }
            return $theLoaiArray;
        }
        $this->db->disconnect();
        return "";
    }
}
?>