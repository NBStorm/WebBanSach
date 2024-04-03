<?php
class DatabaseConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "quanlybansach";
    private $conn;

    public function connect()
    {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new Exception("Lỗi kết nối CSDL: " . $this->conn->connect_error);
            }
            //echo "Kết nối CSDL thành công!";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function disconnect()
    {
        $this->conn = null;
        //echo "Ngắt kết nối CSDL thành công!";
    }

    public function query($sql)
    {
        // Thực thi truy vấn sử dụng MySQLi
        return $this->conn->query($sql);
    }

    public function prepare($sql)
    {
        // Chuẩn bị truy vấn sử dụng MySQLi
        return $this->conn->prepare($sql);
    }
}

?>