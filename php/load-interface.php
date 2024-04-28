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
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $sanpham = new SanPham();
                        $sanPhamArray = $sanpham->getAll();
                        $s='';
                        foreach ($sanPhamArray as $item)
                        {
                            $s .= "<tr>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['ten'] . "</td>
                                    <td>" . $item['dongia'] . "</td>
                                    <td>" . $item['soluong'] . "</td>
                                    <td>" . $item['tentl'] . "</td>
                                    <td><img src='../img/".$item['hinhanh']."' width='100px' height='100px'></td>
                                    <td style='text-align: center;'>
                                        <a data-bs-target='#updateTheLoaiModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>
                                        <span style='margin: 0 10px'></span>
                                        <a data-bs-target='#deleteTheLoaiModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>
                                    </td>
                                </tr>";
                        }
                        echo $s;
                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Thể Loại</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Hình ảnh</th>
                            <th>Chức năng</th>
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
        <div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addTheLoaiModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm thể loại mới
                    </button>
                </div>  
            </div>
        </div>
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
                            <th width=12% style='text-align: center;'>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addTheLoaiModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
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
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id='deleteTheLoaiModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteTheLoai'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Thể loại</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Thể loại <span id='deleteName'></span> ?</p>
                            <input type='hidden' id='recordId' name='recordId'>
						    <p class='text-warning'><large>This action cannot be undone.</large></p>
					    </div>
					    <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
						    <input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='Cancel'>
						    <button type='submit' class='btn btn-danger'>Delete</button>
					    </div>
				    </form>
			    </div>
		    </div>
	    </div>

        <div id='updateTheLoaiModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
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
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
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
        <div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addNhaCCModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm nhà cung cấp mới
                    </button>
                </div>  
            </div>
        </div>
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng nhà cung cấp
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th style='text-align: left;'>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th style='text-align: left;'>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th style='width: 4%;text-align: -webkit-center;'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $nhacungcap = new NhaCungCap();
                        $nhaCungCapArray = $nhacungcap->getAll();
                        $s='';
                        foreach ($nhaCungCapArray as $item)
                        {
                            $s .= "<tr>
                                    <td width=7% style='text-align: center;'>" . $item['id'] . "</td>
                                    <td width=20%>" . $item['ten'] . "</td>
                                    <td width=3% style='text-align: left;'>" . $item['sdt'] . "</td>
                                    <td width=10% style='overflow: hidden;text-overflow: ellipsis;'>" . $item['diachi'] . "</td>
                                    <td style='text-align: center;'>
                                        <a data-bs-target='#updateNhaCCModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>
                                        <span style='margin: 0 10px'></span>
                                        <a data-bs-target='#deleteNhaCCModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>
                                    </td>
                                </tr>";
                        }
                        echo $s;
                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align: left;'>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th style='text-align: left;'>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th style='width: 4%;text-align: -webkit-center;'>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addNhaCCModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddNhaCC'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Nhà cung cấp</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='floatingValidationID' placeholder='<Mã nhà cung cấp' readonly> 
                                <label for='floatingValidationID' class='form-label'>Mã nhà cung cấp</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationName' placeholder='Tên nhà cung cấp' required>
                                <label for='floatingValidationName' class='form-label' >Tên nhà cung cấp</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='int' class='form-control' id='floatingValidationPN' placeholder='Số Điện Thoại' required>
                                <label for='floatingValidationPN' class='form-label' >Số Điện Thoại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <textarea class='form-control' id='floatingValidationDiaChi' placeholder='Địa Chỉ' required style='height: 100px'></textarea>
                                <label for='floatingValidationDiaChi'>Địa Chỉ</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id='deleteNhaCCModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteNhaCC'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Nhà cung cấp</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Nhà cung cấp <span id='deleteName'></span> ?</p>
                            <input type='hidden' id='recordId' name='recordId'>
						    <p class='text-warning'><large>This action cannot be undone.</large></p>
					    </div>
					    <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
						    <input type='button' class='btn btn-secondary' data-bs-dismiss='modal' value='Cancel'>
						    <button type='submit' class='btn btn-danger'>Delete</button>
					    </div>
				    </form>
			    </div>
		    </div>
	    </div>
        <div id='updateNhaCCModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateNhaCC'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Nhà cung cấp</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='updateID' placeholder='<Mã nhà cung cấp' readonly> 
                                <label for='updateID' class='form-label'>Mã nhà cung cấp</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateName' placeholder='Tên nhà cung cấp' required>
                                <label for='updateName' class='form-label' >Tên nhà cung cấp</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                                <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updatePN' placeholder='Số Điện Thoại' required>
                                <label for='updatePN' class='form-label' >Số Điện Thoại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <textarea class='form-control' id='updateDiaChi' placeholder='Địa Chỉ' required style='height: 100px'></textarea>
                                <label for='updateDiaChi'>Địa Chỉ</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
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
}else if (isset($_GET['hoadon'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Hóa Đơn</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Hóa Đơn</li>
        </ol>
        <div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addHoaDonModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm Hóa đơn mới
                    </button>
                </div>  
            </div>
        </div>
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
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $hoaDon = new HoaDon();
                        $hoaDonArray = $hoaDon->getAll();
                        $s='';
                        foreach ($hoaDonArray as $item)
                        {
                            $s .= "<tr>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['tennv'] . "</td>
                                    <td>" . $item['tenkh'] . "</td>
                                    <td>" . $item['date'] . "</td>
                                    <td>" . $item['total'] . "</td>
                                    <td>" . $item['trangthai'] . "</td>
                                    <td style='text-align: center;'>
                                        <a data-bs-target='#updateHoaDonModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>
                                        <span style='margin: 0 10px'></span>
                                        <a data-bs-target='#deleteHoaDonModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>
                                    </td>
                                </tr>";
                        }
                        echo $s;

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tên nhân viên</th>
                            <th>Tên khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addHoaDonModal' class='modal fade'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddHD'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Hóa Đơn</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body' style='margin-top:0%;'>
                            <div class='container_hd'>
                                <div id='left'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px;'>
                                                <form class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3'>
                                                    <input type='search' class='form-control form-control-dark' placeholder='Search...' aria-label='Search>'
                                                </form>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class='scrollpane' id='tableSelectHD'>
                                        <table style='border-collapse: collapse;'>
                                            <thead>
                                                <tr>
                                                    <th>Mã SP</th>
                                                    <th>Tên SP</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                                $sanpham = new SanPham();
                                                $sanPhamArray = $sanpham->getAll();
                                                $s='';
                                                foreach ($sanPhamArray as $item)
                                                {
                                                    $s .= "<tr>
                                                            <td>" . $item['id'] . "</td>
                                                            <td>
                                                                <div class='imgHoverLink'>
                                                                    ". $item['ten'] ."
                                                                    <img class='imgHover' src='../img/".$item['hinhanh']."'>
                                                                </div>
                                                            </td>
                                                            <td>" . $item['dongia'] . "</td>
                                                            <td>" . $item['soluong'] . "</td>
                                                        </tr>";
                                                }
                                                echo $s;
                                            echo "</tbody>
                                        </table>
                                    </div>
                                    <div class='row g-2'>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='idsp' placeholder='' value='' readonly>
                                                <label for='idsp'>Mã SP</label>
                                            </div>
                                        </div>
                                        <div class='col-md-9'>
                                            <div class='form-floating'>
                                                <input type='text' class='form-control' id='tensp' placeholder='' value='' readonly>
                                                <label for='tensp'>Tên SP</label>
                                            </div>            
                                        </div>
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='giasp' placeholder='' value='' readonly>
                                                <label for='giasp'>Giá SP</label>
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='slsp' placeholder='' value=''>
                                                <label for='slsp'>Số lượng SP</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='total' placeholder='' value='' readonly>
                                                <label for='total'>Tổng tiền</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-2'>
                                            <button id='addButton' class='btn btn-primary mt-3'>Thêm</button>                  
                                        </div>
                                    </div>    
                                </div>
                                <div id='right'>
                                    <h5 align='center'>Thông tin chi tiết</h5>
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='idhd' placeholder='' value='' readonly>
                                                <label for='idhd'>Mã HĐ</label>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namenv' style='height:58px;'>";
                                                    $taikhoan = new TaiKhoan();
                                                    $nhanVienArray = $taikhoan->getListNV();
                                                    $s='';
                                                    foreach ($nhanVienArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namenv'>Tên Nhân viên</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namekh' style='height:58px;'>";
                                                    $taikhoan = new TaiKhoan();
                                                    $nhanVienArray = $taikhoan->getListKH();
                                                    $s='';
                                                    foreach ($nhanVienArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namekh'>Tên Khách hàng</label>
                                            </div>            
                                        </div>
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='ngaytao' placeholder='' value='' readonly>
                                                <label for='ngaytao'>Ngày tạo</label>
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='totalAll' placeholder='' value='' readonly>
                                                <label for='totalAll'>Tổng tiền</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='trangthai' style='height:58px;'>
                                                    <option value='Đợi xác nhận'>Đợi xác nhận</option>
                                                    <option value='Xác nhận'>Xác nhận</option>
                                                    <option value='Đang giao'>Đang giao</option>
                                                    <option value='Đã giao'>Đã giao</option>
                                                </select>
                                                <label for='trangthai'>Trạng thái</label>   
                                            </div>        
                                        </div>
                                    </div>
                                    <div class='scrollpane'>
                                        <table id='productList' style='border-collapse: collapse;'>
                                            <thead>
                                                <tr>
                                                    <th>Mã SP</th>
                                                    <th>Tên SP</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                    <th>Tổng tiền</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                                
                                            echo "</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' id='saveButton' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id='updateHoaDonModal' class='modal fade'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateHD'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Hóa Đơn</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body' style='margin-top:0%;'>
                            <div class='container_hd'>
                                <div id='left'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px;'>
                                                <form class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3'>
                                                    <input type='search' class='form-control form-control-dark-update' placeholder='Search...' aria-label='Search>'
                                                </form>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class='scrollpane' id='tableSelectHD_update'>
                                        <table style='border-collapse: collapse;'>
                                            <thead>
                                                <tr>
                                                    <th>Mã SP</th>
                                                    <th>Tên SP</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                                $sanpham = new SanPham();
                                                $sanPhamArray = $sanpham->getAll();
                                                $s='';
                                                foreach ($sanPhamArray as $item)
                                                {
                                                    $s .= "<tr>
                                                            <td>" . $item['id'] . "</td>
                                                            <td>
                                                                <div class='imgHoverLink'>
                                                                    ". $item['ten'] ."
                                                                    <img class='imgHover' src='../img/".$item['hinhanh']."'>
                                                                </div>
                                                            </td>
                                                            <td>" . $item['dongia'] . "</td>
                                                            <td>" . $item['soluong'] . "</td>
                                                        </tr>";
                                                }
                                                echo $s;
                                            echo "</tbody>
                                        </table>
                                    </div>
                                    <div class='row g-2'>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='idsp_update' placeholder='' value='' readonly>
                                                <label for='idsp_update'>Mã SP</label>
                                            </div>
                                        </div>
                                        <div class='col-md-9'>
                                            <div class='form-floating'>
                                                <input type='text' class='form-control' id='tensp_update' placeholder='' value='' readonly>
                                                <label for='tensp_update'>Tên SP</label>
                                            </div>            
                                        </div>
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='giasp_update' placeholder='' value='' readonly>
                                                <label for='giasp_update'>Giá SP</label>
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='slsp_update' placeholder='' value=''>
                                                <label for='slsp_update'>Số lượng SP</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='total_update' placeholder='' value='' readonly>
                                                <label for='total_update'>Tổng tiền</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-2'>
                                            <button id='addButton_update' class='btn btn-primary mt-3'>Thêm</button>                  
                                        </div>
                                    </div>    
                                </div>
                                <div id='right'>
                                    <h5 align='center'>Thông tin chi tiết</h5>
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='idhdupdate' placeholder='' value='' readonly>
                                                <label for='idhdupdate'>Mã HĐ</label>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namenvupdate' style='height:58px;'>";
                                                    $taikhoan = new TaiKhoan();
                                                    $nhanVienArray = $taikhoan->getListNV();
                                                    $s='';
                                                    foreach ($nhanVienArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namenvupdate'>Tên Nhân viên</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namekhupdate' style='height:58px;'>";
                                                    $taikhoan = new TaiKhoan();
                                                    $nhanVienArray = $taikhoan->getListKH();
                                                    $s='';
                                                    foreach ($nhanVienArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namekhupdate'>Tên Khách hàng</label>
                                            </div>            
                                        </div>
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-4'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='ngaytaoupdate' placeholder='' value='' readonly>
                                                <label for='ngaytaoupdate'>Ngày tạo</label>
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='totalAllupdate' placeholder='' value='' readonly>
                                                <label for='totalAllupdate'>Tổng tiền</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='trangthaiupdate' style='height:58px;'>
                                                    <option value='Đợi xác nhận'>Đợi xác nhận</option>
                                                    <option value='Xác nhận'>Xác nhận</option>
                                                    <option value='Đang giao'>Đang giao</option>
                                                    <option value='Đã giao'>Đã giao</option>
                                                </select>
                                                <label for='trangthaiupdate'>Trạng thái</label>   
                                            </div>        
                                        </div>
                                    </div>
                                    <div class='scrollpane'>
                                        <table id='productListupdate' style='border-collapse: collapse;'>
                                            <thead>
                                                <tr>
                                                    <th>Mã SP</th>
                                                    <th>Tên SP</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                    <th>Tổng tiền</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                                
                                            echo "</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer' style='margin-top:0%;padding-bottom:0%'>
                            <button type='button' class='btn btn-secondary'
                                data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Close</button>
                            <button type='submit' id='saveButton_update' class='btn btn-primary'><i class='fa-solid fa-check'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>";
}
?>