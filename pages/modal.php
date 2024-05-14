<!-- Đơn hàng modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Đơn hàng đã đặt</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tổng sản phẩm</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01/05/2024 14:30</td>
                            <td>3</td>
                            <td>1,500,000 VND</td>
                            <td>Đã giao</td>
                        </tr>
                        <tr>
                            <td>25/04/2024 10:00</td>
                            <td>5</td>
                            <td>2,500,000 VND</td>
                            <td>Đang xử lý</td>
                        </tr>
                        <tr>
                            <td>20/04/2024 16:45</td>
                            <td>2</td>
                            <td>800,000 VND</td>
                            <td>Đã hủy</td>
                        </tr>
                        <!-- Thêm các dòng đơn hàng khác tại đây -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>




<!-- Thông tin chi tiết sản phẩm modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Chi tiết thiết bị</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
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