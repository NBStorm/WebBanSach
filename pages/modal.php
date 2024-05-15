<!-- Đơn hàng modal -->
<div class="modal fade" id="modalOrders" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Đơn hàng đã đặt</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Mã giao dịch</th>
                            <th scope="col">Thời gian mua</th>
                            <th scope="col">Tổng tiền hàng</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="loadContentModalOrders">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

<!-- Chi tiết đơn hàng modal -->
<div class="modal fade" id="modalDetailsOrder" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Chi tiết đơn hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle='modal' data-target='#modalOrders'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="loadContentModalDetailsOrders">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle='modal' data-target='#modalOrders'>Thoát</button>
            </div>
        </div>
    </div>
</div>

<!-- Thông tin chi tiết sản phẩm modal -->
<div class="modal fade" id="modalDetailsProduct" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thông tin chi tiết sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="loadContent">
                    <div class="col-md-4">
                        <img src="https://via.placeholder.com/150" alt="Book Image" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h5>Tên sách: Lập trình Web</h5>
                        <p>Giá: 200,000 VND</p>
                        <div class="form-group">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                        </div>
                        <button type="button" class="btn btn-success">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>
<script>
    function loadContentModalOrders() {
        var username = <?php echo isset($_SESSION['Username']) ? json_encode($_SESSION['Username']) : "''"; ?>;

        $.ajax({
            url: "includes/orders.php",
            method: "POST",
            data: {
                username: username,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status === 'error') {
                    console.log(data.message);
                } else {
                    let tableContent = '';
                    data.forEach(function(order) {
                        tableContent += `<tr data-dismiss="modal" data-toggle='modal' data-target='#modalDetailsOrder' onclick="loadContentModalDetailsOrders('${encodeURIComponent(JSON.stringify(order.SanPham))}')">
                        <td>${order.MaHD}</td>
                        <td>${order.NgayTao}</td>
                        <td>${order.TongTien}</td>
                        <td>${order.TrangThai}</td>
                    </tr>`;
                    });
                    $("#loadContentModalOrders").html(tableContent);
                }
            },
            error: function(xhr, status, error) {
                console.log("Đã xảy ra lỗi: ", error);
                console.log(xhr);
                console.log(status);
            }
        });


    }

    function loadContentModalDetailsOrders(arr) {
        const products = JSON.parse(decodeURIComponent(arr));

        let tableContent = ``;
        products.forEach(function(product) {
            let TongTien = product.SoLuong * product.Gia;
            tableContent += `<tr>
                                <td>${product.TenSP}</td>
                                <td>${product.SoLuong}</td>
                                <td>${product.Gia}</td>
                                <td>${TongTien}</td>
                            </tr>`;
        });
        document.getElementById('loadContentModalDetailsOrders').innerHTML = tableContent;
    }
</script>