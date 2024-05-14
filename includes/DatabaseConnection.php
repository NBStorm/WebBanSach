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
        $this->conn->close();
        $this->conn = null;
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function getLastInsertedId()
    {
        if ($this->conn === null) {
            $this->connect();
        }

        // Lấy ID vừa tạo
        return $this->conn->insert_id;
    }

    // Thêm các phương thức giao dịch
    public function begin_transaction()
    {
        $this->conn->begin_transaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollback();
    }
}
