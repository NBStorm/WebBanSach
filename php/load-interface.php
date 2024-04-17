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
                            <th width=13%>Mã sản phẩm</th>
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
                            <th width=12% style='text-align: center;'>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th style='width: 15%;text-align: -webkit-center;'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $theloai = new TheLoai();
                        $theLoaiArray = $theloai->getAll();
                        $s='';
                        foreach ($theLoaiArray as $item)
                        {
                            $s .= "<tr>
                                    <td width=12% style='text-align: center;'>" . $item['id'] . "</td>
                                    <td>" . $item['ten'] . "</td>
                                    <td style='text-align: center;'>
                                        <a data-bs-target='#updateTheLoaiModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>
                                        <span style='margin: 0 10px'></span>
                                        <a data-bs-target='#deleteTheLoaiModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>
                                    </td>
                                </tr>";
                        }
                        echo $s;
                    echo "</tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class='col-sm-6'>
            <button type='button' class='btn btn-success' data-bs-toggle='modal'
                data-bs-target='#addTheLoaiModal'>
                <i class='fa-solid fa-circle-plus'></i>
                Thêm thể loại mới
            </button>
        </div>
        <div id='addTheLoaiModal' class='modal fade'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddTheLoai'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Thể loại</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='floatingValidationID' placeholder='<Mã thể loại' readonly> 
                                <label for='floatingValidationID' class='form-label'>Mã thể loại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationName' placeholder='Tên thể loại' required>
                                <label for='floatingValidationName' class='form-label' >Tên thể loại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id='deleteTheLoaiModal' class='modal fade'>
		    <div class='modal-dialog'>
			    <div class='modal-content'>
				    <form id='formDeleteTheLoai'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Thể loại</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Are you sure you want to delete thể loại <span id='deleteName'></span> ?</p>
                            <input type='hidden' id='recordId' name='recordId'>
						    <p class='text-warning'><large>This action cannot be undone.</large></p>
					    </div>
					    <div class='modal-footer'>
						    <input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='Cancel'>
						    <button type='submit' class='btn btn-danger'>Delete</button>
					    </div>
				    </form>
			    </div>
		    </div>
	    </div>

        <div id='updateTheLoaiModal' class='modal fade'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateTheLoai'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Thể loại</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='updateID' placeholder='<Mã thể loại' readonly> 
                                <label for='updateID' class='form-label'>Mã thể loại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateName' placeholder='Tên thể loại' required>
                                <label for='updateName' class='form-label' >Tên thể loại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save changes</button>
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