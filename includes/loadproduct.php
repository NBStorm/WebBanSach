<?php
require_once("DatabaseConnection.php");
require_once("pagination.class.php");

$perPage = new PerPage();
$sql = "SELECT * FROM sanpham";
$paginationlink = "includes/loadproduct.php?page=";
$page = 1;

if (!empty($_GET["page"]) && is_numeric($_GET["page"])) {
    $page = $_GET["page"];
}

$start = ($page - 1) * $perPage->perpage;
if ($start < 0) {
    $start = 0;
}

$db = new DatabaseConnection();
$db->connect(); // Mở kết nối CSDL

$statement = $db->prepare($sql);
$statement->execute();
$result = $statement->get_result();

$perpageresult = $perPage->perpage($result->num_rows, $paginationlink);

$query = $sql . " LIMIT " . $start . "," . $perPage->perpage;
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->get_result();

$output = '';
$output .= '
<div class="container">
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Tất cả sách</h2>
        </div>
        <div class="swiper product-watch-swiper">
            <div class="swiper-wrapper">';

while ($row = $result->fetch_assoc()) {
    // $output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $result->num_rows . '" />' . $row["question"] . '</div>';
    // $output .= '<div class="answer">' . $row["answer"] . '</div>';
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
                            <a href='#'>{$row['TenSP']}</a>
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
    $output .= '<div class="pagination justify-content-center" id="pagelink">' . $perpageresult . '</div>';
    // echo '</br><div id="pagelink">' . $perpageresult . '</div>';
}

echo $output;

$db->disconnect(); // Đóng kết nối CSDL
?>
<script>
    function getresult(url) {
        $('#loader-icon').show();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                rowcount: $("#rowcount").val()
            },
            success: function(data) {
                $("#all-product").html(data); // Cập nhật toàn bộ nội dung trong container
                $("#loader-icon").hide();
                $(".wi").css({
                    "width": "270px",
                });
            },
            error: function() {}
        });
    }
</script>