<?php
require_once("DatabaseConnection.php");

$db = new DatabaseConnection();
$db->connect();

$sql = "SELECT * FROM theloai";

$statement = $db->prepare($sql);
$statement->execute();
$result = $statement->get_result();

$output = "";

while ($row = $result->fetch_assoc()) {
    echo "<li><a class='dropdown-item' href='#category-product' data-value='" . $row['MaTL'] . "' data-name='" . $row['TenTL'] . "'>" . $row['TenTL'] . "</a></li>";
}

$statement->close(); // Đóng statement
$db->disconnect(); // Đóng kết nối CSDL

echo $output;
