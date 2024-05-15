<?php
require_once("DatabaseConnection.php");
require_once("pagination.class.php");

$currentDate = date('Y-m-d'); // Ngày hiện tại
$startDate = date('Y-m-d', strtotime('first day of last month'));

$perPage = new PerPage();
$sql = "SELECT sp.MaSP, sp.TenSP, sp.DonGia, sp.HinhAnh, SUM(cthd.SoLuong) AS total_quantity
                FROM sanpham sp
                JOIN chitiethoadon cthd ON sp.MaSP = cthd.MaSP
                JOIN hoadon hd ON cthd.MaHD = hd.MaHD
                WHERE hd.NgayTao BETWEEN ? AND ?
                  AND hd.TrangThai = 'Đã giao'
                GROUP BY sp.MaSP, sp.TenSP, sp.DonGia, sp.HinhAnh
                ORDER BY total_quantity";

$paginationlink = "includes/loadSellingProduct.php?page=";
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
$statement->bind_param("ss", $startDate, $currentDate);
$statement->execute();
$result = $statement->get_result();

$perpageresult = $perPage->perpageSelling($result->num_rows, $paginationlink);

$query = $sql . " LIMIT ?, ?";
$statement = $db->prepare($query);
$statement->bind_param("ssii", $startDate, $currentDate, $start, $perPage->perpage);
$statement->execute();
$result = $statement->get_result();


$output = '';
$output .= '
<div class="container">
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Sách bán chạy</h2>
        </div>
        <div class="swiper product-watch-swiper">
            <div class="swiper-wrapper">';

while ($row = $result->fetch_assoc()) {
    if (empty($row['HinhAnh'])) {
        $row['HinhAnh'] = 'default.png'; // Sử dụng ảnh mặc định nếu không có ảnh
    }
    $output .= "<div class='swiper-slide wi' style='width: 225px; margin-right: 20px;'>
                <div class='product-card position-relative'>
                    <div class='image-holder'>
                        <img src='./img/" . htmlspecialchars($row['HinhAnh']) . "' alt='product-item' class='img-fluid' style='height: 300px; object-fit: contain; width: 100%;'>
                    </div>
                    <div class='cart-concern position-absolute'>
                        <div class='cart-button d-flex'>
                            <button onclick='addProductToCart(\"" . htmlspecialchars($row['MaSP']) . "\",\"" . htmlspecialchars($row['TenSP']) . "\", " . htmlspecialchars($row['DonGia']) . ", \"" . htmlspecialchars($row['HinhAnh']) . "\")' class='btn btn-medium btn-black'>Add to Cart<svg class='cart-outline'>
                                    <use xlink:href='#cart-outline'></use>
                                </svg></button>
                        </div>
                    </div>
                    <div class='card-detail d-flex justify-content-between align-items-baseline pt-3'>
                        <h3 class='card-title text-uppercase'>
                            <a data-target='#modalDetailsProduct' data-toggle='modal' onclick='addModalDetailsProduct(\"" . htmlspecialchars($row['MaSP']) . "\",\"" . htmlspecialchars($row['TenSP']) . "\", " . htmlspecialchars($row['DonGia']) . ", \"" . htmlspecialchars($row['HinhAnh']) . "\")' href='#!'>" . htmlspecialchars($row['TenSP']) . "</a>
                        </h3>
                        <span class='item-price text-primary'>" . htmlspecialchars($row['DonGia']) . "</span>
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
}

$db->disconnect(); // Đóng kết nối CSDL

echo $output;
?>
<script>
function getresultSelling(url) {
    $('#loader-icon').show();
    $.ajax({
        url: url,
        type: "GET",
        data: {
            rowcount: $("#rowcount").val()
        },
        success: function(data) {
            $("#selling-products").html(data); // Cập nhật toàn bộ nội dung trong container
            $("#loader-icon").hide();
            $(".wi").css({
                "width": "270px",
            });
        },
        error: function() {}
    });
}
</script>