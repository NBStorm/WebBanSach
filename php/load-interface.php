<?php
require_once 'sanpham.php';
require_once 'theloai.php';
require_once 'taikhoan.php';
require_once 'nguoidung.php';
require_once 'hoadon.php';
require_once 'nhacungcap.php';
require_once 'phieunhap.php';
require_once 'phanquyen.php';
if (isset($_GET['sanpham'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Sản Phẩm</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Sản Phẩm</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng sản phẩm
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Thể Loại</th>
                            <th>Hình ảnh</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $sanpham = new Sanpham();
                        $sanpham->__construct();
                        echo $sanpham->getAll();

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Thể Loại</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Hình ảnh</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>";
}else if (isset($_GET['theloai'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Thể loại</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Thể Loại</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng thể loại
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $theloai = new TheLoai();
                        $theloai->__construct();
                        echo $theloai->getAll();

                    echo "</tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class='col-sm-6'>
            <button type='button' class='btn btn-success' data-bs-toggle='modal'
                data-bs-target='#addEmployeeModal'>
                Add new
            </button>
        </div>
        <div id='addEmployeeModal' class='modal fade'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <form>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Employee</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            add
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'>Close</button>
                            <button type='button' class='btn btn-primary'>Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>";
}else if (isset($_GET['nguoidung'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Người Dùng</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Người Dùng</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng người dùng
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã người dùng</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $nguoidung = new NguoiDung();
                        $nguoidung->__construct();
                        echo $nguoidung->getAll();

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã người dùng</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>";
}else if (isset($_GET['taikhoan'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Tài Khoản</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Tài Khoản</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng tài khoản
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã tài khoản</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $taikhoan = new TaiKhoan();
                        $taikhoan->__construct();
                        echo $taikhoan->getAll();

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã tài khoản</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>";
}else if (isset($_GET['nhacungcap'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Nhà Cung Cấp</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Nhà Cung Cấp</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng nhà cung cấp
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $nhacungcap = new NhaCungCap();
                        $nhacungcap->__construct();
                        echo $nhacungcap->getAll();

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>";
}else if (isset($_GET['hoadon'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Hóa Đơn</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Hóa Đơn</li>
        </ol>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng hóa đơn
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tên nhân viên</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $hoadon = new HoaDon();
                        $hoadon->__construct();
                        echo $hoadon->getAll();

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tên nhân viên</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>";
}
?>