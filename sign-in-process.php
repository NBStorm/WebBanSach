<?php
require_once 'DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new DatabaseConnection();
    $conn->connect();

    // Sử dụng prepared statement để tránh SQL injection
    $sql = 'SELECT * FROM taikhoan WHERE UserName = ? AND Password = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Có kết quả từ truy vấn
        if ($row = $result->fetch_assoc()) {
            $quyen = $row['MaNQ'];
            
            if($quyen == 2){
                $response = array("status" => "2", "redirect" => "index.php");
                echo json_encode($response);
            }elseif ($quyen == 1){
                $response = array("status" => "1", "redirect" => "admin.php");
                echo json_encode($response);
            }
        }
    } else {
        echo $stmt->error;
    }

    $stmt->close();
    $conn->disconnect();
}
?>