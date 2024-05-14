<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Giỏ hàng
                </h5>
            </div>
            <div class="modal-body">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Tổng cộng</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="load-product-cart">

                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h5>Tổng tiền: <span class="price text-success" id="load-total-cart">89$</span></h5>
                </div>
            </div>
            <div class="modal-footer border-top-0" style="display: flex;">
                <button type="button" class="btn btn-success" onclick="pay()">Thanh toán</button>
            </div>
        </div>
    </div>
    <script>
    //mở modal
    function addModalCart() {
        renderCart();
        $('#cartModal').modal('show');
    }
    $('#cartModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
    });

    function pay() {
        let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

        var sessionValue = <?php echo json_encode(isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false); ?>;

        if (sessionValue) {
            if (cart.length == 0) {
                alert("Giỏ hàng của bạn đang trống.");
            } else {
                var username = <?php echo isset($_SESSION['Username']) ? json_encode($_SESSION['Username']) : "''"; ?>;
                console.log(username);
                $.ajax({
                    url: "includes/pay.php",
                    method: "POST",
                    data: {
                        cart: JSON.stringify(cart), // Chuyển đổi mảng cart thành chuỗi JSON và gửi nó
                        username: username
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            // Clear the cart in localStorage
                            localStorage.removeItem('cart');
                            $('#cartModal').modal('hide');
                            // window.location.href = response.redirect;
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Đơn hàng lỗi: " + error);
                    }
                });
            }
        } else {
            alert("Bạn chưa đăng nhập.");
        }
    }
    </script>

</div>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>