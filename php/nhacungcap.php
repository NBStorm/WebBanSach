<?php
require_once 'DatabaseConnection.php';

class NhaCungCap
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->db->connect();
    }

    public function themNhaCungCap($ten,$sdt,$diachi)
    {
        $sql = "INSERT INTO nhacungcap (TenNCC,SDT,DiaChi) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $ten,$sdt,$diachi);
        $success = $stmt->execute();
        $stmt->close();
        $this->db->disconnect();
        return $success;
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
        $sql = "SELECT * FROM nhacungcap";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $nccArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $nccArray[] = array('id' => $row['MaNCC'], 'ten' => $row['TenNCC'], 'sdt' => $row['SDT'], 'diachi' => $row['DiaChi']);
            }
            return $nccArray;
        }
        $this->db->disconnect();
        return "";
    }

    public function getListNCC()
    {
        $sql = "SELECT MaNCC,TenNCC FROM nhacungcap";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $nhaCungCapArray = array(); // Tạo một mảng rỗng để chứa cặp id và tên

            while ($row = $result->fetch_assoc()) {
                $nhaCungCapArray[] = array('id' => $row['MaNCC'], 'ten' => $row['TenNCC']);
            }
            return $nhaCungCapArray;
        }
        $this->db->disconnect();

        return "";
    }
}
?>