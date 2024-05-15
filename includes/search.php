<?php

require_once("DatabaseConnection.php");
require("pagination.class.php");

$perPage = new PerPage();
$perPage->perpage3();

$paginationlink = "includes/search.php?page=";
$page = 1;

if (!empty($_GET["page"]) && is_numeric($_GET["page"])) {
    $page = $_GET["page"];
}

$start = ($page - 1) * $perPage->perpage;
if ($start < 0) {
    $start = 0;
}

$search_name = $_POST["search_name"] ?? $_GET["search_name"] ?? '';
$bookCategory = $_POST["bookCategory"] ?? $_GET["bookCategory"] ?? '';
$priceFrom = $_POST["priceFrom"] ?? $_GET["priceFrom"] ?? 0;
$priceTo = $_POST["priceTo"] ?? $_GET["priceTo"] ?? 0;

$db = new DatabaseConnection();
$db->connect(); // Mở kết nối CSDL

$sql = "SELECT * FROM sanpham WHERE TenSP LIKE ?";
$params = ["%$search_name%"];
$types = "s";

if ($bookCategory) {
    $sql .= " AND MaTL = ?";
    $params[] = $bookCategory;
    $types .= "s";
}

if ($priceFrom) {
    $sql .= " AND DonGia >= ?";
    $params[] = $priceFrom;
    $types .= "d";
}

if ($priceTo) {
    $sql .= " AND DonGia <= ?";
    $params[] = $priceTo;
    $types .= "d";
}

$statement = $db->prepare($sql);
$statement->bind_param($types, ...$params);
$statement->execute();
$result = $statement->get_result();

$perpageresult = $perPage->perpageSearch($result->num_rows, $paginationlink);

$query = $sql . " LIMIT " . $start . "," . $perPage->perpage;
$statement = $db->prepare($query);
$statement->bind_param($types, ...$params);
$statement->execute();
$result = $statement->get_result();

$output = "";
$output .= '
<div class="container">
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Kết quả tìm kiếm</h2>
            <div class="btn-right">
                <a href="index.php" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
            </div>
        </div>
        <div class="swiper product-watch-swiper">
            <div class="swiper-wrapper">';

while ($row = $result->fetch_assoc()) {
    $output .= "<div class='swiper-slide wi' style='width: 225px; margin-right: 20px;'>
                    <div class='product-card position-relative'>
                        <div class='image-holder'>
                            <img src='./img/" . $row['HinhAnh'] . "' alt='product-item' class='img-fluid' style='height: 300px; object-fit: contain; width: 100%;'>
                        </div>
                        <div class='cart-concern position-absolute'>
                            <div class='cart-button d-flex'>
                                <button onclick='addProductToCart(\"{$row['MaSP']}\",\"{$row['TenSP']}\", {$row['DonGia']}, \"{$row['HinhAnh']}\")' class='btn btn-medium btn-black'>Add to Cart<svg class='cart-outline'>
                                        <use xlink:href='#cart-outline'></use>
                                    </svg></button>
                            </div>
                        </div>
                        <div class='card-detail d-flex justify-content-between align-items-baseline pt-3'>
                            <h3 class='card-title text-uppercase'>
                                <a data-toggle='modal' data-target='#modalDetailsProduct' onclick='addModalDetailsProduct(\"{$row['MaSP']}\",\"{$row['TenSP']}\", {$row['DonGia']}, \"{$row['HinhAnh']}\")' href='#!'>{$row['TenSP']}</a>
                            </h3>
                            <span class='item-price text-primary'>{$row['DonGia']}</span>
                        </div>
                    </div>
                </div>";
}
$output .= '                </div>
</div>
</div>
</div>';
if (!empty($perpageresult)) {
    $output .= '<div class="pagination justify-content-center">' . $perpageresult . '</div>';
}

echo $output;

$db->disconnect();

?>

<script>
    function getresultSearch(url) {
        var search_name = $("#search-name").val();
        var priceFrom = $("#priceFrom").val();
        var priceTo = $("#priceTo").val();
        var bookCategory = $("#bookCategory").val();

        $('#loader-icon').show();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                search_name: search_name,
                priceFrom: priceFrom,
                priceTo: priceTo,
                bookCategory: bookCategory
            },
            success: function(data) {
                $("#rs-search").html(data); // Cập nhật toàn bộ nội dung trong container
                $("#loader-icon").hide();
                $(".wi").css({
                    "width": "270px",
                });
            },
            error: function() {}
        });
    }
</script>