<?php
require_once 'sanpham.php';
require_once 'theloai.php';
require_once 'taikhoan.php';
require_once 'nguoidung.php';
require_once 'hoadon.php';
require_once 'nhacungcap.php';
require_once 'phieunhap.php';
require_once 'nhomquyen.php';
require_once 'chucnang.php';
if (isset($_GET['sanpham'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Sản Phẩm</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Sản Phẩm</li>
        </ol>";
        if (coQuyenThem('sanpham', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addSanPhamModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm sản phẩm mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
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
                                    <td><img class='product-image' src='../img/" . $item['hinhanh'] . "' width='100px' height='100px'></td>
                                    <td style='text-align: center;'>";
                                        if (coQuyenSua('sanpham', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                            $s .= "<a data-bs-target='#updateSanPhamModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                        }
                                        $s .= "<span style='margin: 0 10px'></span>";
                                        if (coQuyenXoa('sanpham', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                            $s .= "<a data-bs-target='#deleteSanPhamModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                        }
                            $s .= "
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
        <div id='addSanPhamModal' class='modal fade'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddSP'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Sản Phẩm</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body' style='margin-top:0px;'>
                            <div class='container_hd' '>
                                <div id='left' style='width:61%'>
                                    <div class='form-floating mb-3'>
                                        <input type='number' class='form-control' id='floatingValidationID' placeholder='<Mã sản phẩm' readonly> 
                                        <label for='floatingValidationID' class='form-label'>Mã sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <input type='text' class='form-control' id='floatingValidationName' placeholder='Tên sản phẩm' required>
                                        <label for='floatingValidationName' class='form-label' >Tên sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <input type='number' class='form-control' id='floatingValidationGia' placeholder='Giá' required>
                                        <label for='floatingValidationGia' class='form-label' >Giá sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <select class='form-select' aria-label='Default select example' id='floatingValidationTheLoai' style='height:58px;'>";
                                        $theloai = new TheLoai();
                                        $theLoaiArray = $theloai->getAll();
                                        $s='';
                                        foreach ($theLoaiArray as $item)
                                        {
                                            $s .= "
                                                <option value='".$item['id']."'>".$item['ten']."</option>
                                            ";
                                        }
                                        echo $s;
                                        echo "</select>
                                        <label for='floatingValidationTheLoai' class='form-label' >Thể loại</label>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='file' id='fileInput' style='display: none;'>
                                        <button id='chooseFileButton'>Choose File</button>
                                        <span id='selectedFileName'></span>
                                        <button class='btn btn-danger btn-sm position-absolute top-1 end-1 mt-2 me-2 delete-btn d-none' id='delete-btn' aria-label='Delete'>
                                            <i class='bi bi-x'></i>
                                        </button>
                                    </div>
                                </div>
                                <div id='right' style='width:37%'>
                                    <img src='#' alt='Image Preview' class='image-preview d-none' id='myImage'>
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
        <div id='deleteSanPhamModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteSP'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Sản phẩm</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa sản phẩm <span id='deleteName'></span> ?</p>
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

        <div id='updateSanPhamModal' class='modal fade'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateSP'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Sản phẩm</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='container_hd' '>
                                <div id='left' style='width:61%'>
                                    <div class='form-floating mb-3'>
                                        <input type='number' class='form-control' id='updateId' placeholder='<Mã sản phẩm' readonly> 
                                        <label for='floatingValidationID' class='form-label'>Mã sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <input type='text' class='form-control' id='updateName' placeholder='Tên sản phẩm' required>
                                        <label for='updateName' class='form-label' >Tên sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <input type='number' class='form-control' id='updateGia' placeholder='Giá' required>
                                        <label for='updateGia' class='form-label' >Giá sản phẩm</label>
                                        <div class='valid-feedback'>
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class='form-floating mb-3'>
                                        <select class='form-select' aria-label='Default select example' id='updateTheLoai' style='height:58px;'>";
                                        $theloai = new TheLoai();
                                        $theLoaiArray = $theloai->getAll();
                                        $s='';
                                        foreach ($theLoaiArray as $item)
                                        {
                                            $s .= "
                                                <option value='".$item['id']."'>".$item['ten']."</option>
                                            ";
                                        }
                                        echo $s;
                                        echo "</select>
                                        <label for='updateTheLoai' class='form-label' >Thể loại</label>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='file' id='updateFileInput' style='display: none;'>
                                        <button id='chooseFileButtonUpdate'>Choose File</button>
                                        <span id='updateSelectedFileName'></span>
                                        <button class='btn btn-danger btn-sm position-absolute top-1 end-1 mt-2 me-2 delete-btn d-none' id='delete-btn-update' aria-label='Delete'>
                                            <i class='bi bi-x'></i>
                                        </button>
                                    </div>
                                </div>
                                <div id='right' style='width:37%'>
                                    <img src='#' alt='Image Preview' class='image-preview d-none' id='myImageUpdate'>
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
}else if (isset($_GET['theloai'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Thể loại</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Thể Loại</li>
        </ol>";
        if (coQuyenThem('theloai', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addTheLoaiModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm thể loại mới   
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
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
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('theloai', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateTheLoaiModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('theloai', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deleteTheLoaiModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
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
        </ol>";
        if (coQuyenThem('nguoidung', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addNguoiDungModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm người dùng mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng người dùng
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th width=15% style='text-align: center;'>Mã người dùng</th>
                            <th>Họ tên</th>
                            <th width='13%'>Số điện thoại</th>
                            <th width='25%'>Email</th>
                            <th width='11%'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $nguoidung = new NguoiDung();
                        $nguoiDungArray = $nguoidung->getAll();
                        $s='';
                        foreach ($nguoiDungArray as $item)
                        {
                            $s .= "<tr>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['ten'] . "</td>
                                    <td>" . $item['sdt'] . "</td>
                                    <td>" . $item['email'] . "</td>
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('nguoidung', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateNguoiDungModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('nguoidung', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deleteNguoiDungModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
                                    </td>
                                </tr>";
                        }    
                        echo $s;
                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã người dùng</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addNguoiDungModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddND'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Người Dùng</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationID' placeholder='<Mã thể loại'> 
                                <label for='floatingValidationID' class='form-label'>Mã người dùng</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationName' placeholder='Tên thể loại' required>
                                <label for='floatingValidationName' class='form-label' >Họ tên</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='floatingValidationPN' placeholder='Tên thể loại' required>
                                <label for='floatingValidationPN' class='form-label' >Số điện thoại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationEmail' placeholder='Tên thể loại' required>
                                <label for='floatingValidationEmail' class='form-label' >Email</label>
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
        <div id='deleteNguoiDungModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteND'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Người Dùng</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Người dùng <span id='deleteName'></span> ?</p>
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

        <div id='updateNguoiDungModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateND'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Người dùng</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateID' placeholder='<Mã thể loại' readonly> 
                                <label for='updateID' class='form-label'>Mã người dùng</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateName' placeholder='Tên thể loại' required>
                                <label for='updateName' class='form-label' >Họ tên</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='number' class='form-control' id='updatePN' placeholder='<Mã thể loại' readonly> 
                                <label for='updatePN' class='form-label'>Số điện thoại</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateEmail' placeholder='Tên thể loại' required>
                                <label for='updateEmail' class='form-label' >Email</label>
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
}else if (isset($_GET['taikhoan'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Tài Khoản</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Tài Khoản</li>
        </ol>";
        if (coQuyenThem('taikhoan', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addTaiKhoanModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm tài khoản mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        
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
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $taiKhoan = new TaiKhoan();
                        $taiKhoanArray = $taiKhoan->getAll();
                        $s='';
                        foreach ($taiKhoanArray as $item)
                        {
                            $s .= "<tr>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['user'] . "</td>
                                    <td>" . $item['pass'] . "</td>
                                    <td>" . $item['nnq'] . "</td>
                                    <td>" . $item['date'] . "</td>
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('taikhoan', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateTaiKhoanModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('taikhoan', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deleteTaiKhoanModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
                                    </td>
                                </tr>";
                        }    
                        echo $s;
                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã tài khoản</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addTaiKhoanModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddTK'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Tài Khoản</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationID' placeholder='<Mã thể loại' readonly> 
                                <label for='floatingValidationID' class='form-label'>Mã Tài Khoản</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <select class='form-select' aria-label='Default select example' id='floatingValidationUserName' style='height:58px;'>";
                                $nguoiDung = new NguoiDung();
                                $nguoiDungArray = $nguoiDung->getListCTK();
                                $s='';
                                foreach ($nguoiDungArray as $item)
                                {
                                    $s .= "
                                        <option value='".$item['id']."'>".$item['ten']."</option>
                                    ";
                                }
                                echo $s;
                                echo "</select>
                                <label for='floatingValidationUserName' class='form-label' >UserName</label>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationPW' placeholder='Tên thể loại' required>
                                <label for='floatingValidationPN' class='form-label' >Password</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <select class='form-select' aria-label='Default select example' id='floatingValidationNQ' style='height:58px;'>";
                                $nhomquyen = new NhomQuyen();
                                $nqarr = $nhomquyen->getAll();
                                $s='';
                                foreach ($nqarr as $item)
                                {
                                    $s .= "
                                        <option value='".$item['id']."'>".$item['ten']."</option>
                                    ";
                                }
                                echo $s;
                                echo "</select>
                                <label for='floatingValidationNQ' class='form-label' >Nhóm quyền</label>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='floatingValidationDate' placeholder='' value='' readonly>
                                <label for='floatingValidationDate' class='form-label' >Ngày Tạo</label>
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
        <div id='deleteTaiKhoanModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteTK'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Tài Khoản</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Tài khoản <span id='deleteName'></span> ?</p>
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

        <div id='updateTaiKhoanModal' class='modal fade'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateTK'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Người dùng</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateId' placeholder='Mã tài khoản' readonly> 
                                <label for='updateId' class='form-label'>Mã Tài Khoản</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <select class='form-select' aria-label='Default select example' id='updateND' style='height:58px;'>";
                
                                echo "</select>
                                <label for='updateND' class='form-label' >UserName</label>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updatePass' placeholder='Tên thể loại' required>
                                <label for='updatePass' class='form-label' >Password</label>
                                <div class='valid-feedback'>
                                    Looks good!
                                </div>
                            </div>
                            <div class='form-floating mb-3'>
                                <select class='form-select' aria-label='Default select example' id='updateNQ' style='height:58px;'>";
                                $nhomquyen = new NhomQuyen();
                                $nqarr = $nhomquyen->getAll();
                                $s='';
                                foreach ($nqarr as $item)
                                {
                                    $s .= "
                                        <option value='".$item['id']."'>".$item['ten']."</option>
                                    ";
                                }
                                echo $s;
                                echo "</select>
                                <label for='updateNQ' class='form-label' >Nhóm quyền</label>
                            </div>
                            <div class='form-floating mb-3'>
                                <input type='text' class='form-control' id='updateDate' placeholder='' value='' readonly>
                                <label for='updateDate' class='form-label' >Ngày Tạo</label>
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
}else if (isset($_GET['nhacungcap'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Nhà Cung Cấp</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Nhà Cung Cấp</li>
        </ol>";
        if (coQuyenThem('nhacungcap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addNhaCCModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm nhà cung cấp mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        
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
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('nhacungcap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateNhaCCModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('nhacungcap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deleteNhaCCModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
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
        </ol>";
        if (coQuyenThem('hoadon', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addHoaDonModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm Hóa đơn mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        
        <div class='card mb-4'>
            <form class='row w-full' id='filter-form' style='padding-top :10px;'>
                <div class='col'>
                    <div class='row g-2'>
                        <div class='col-md-5' style='padding-left:20px;padding-top:6px;'>
                            <div class='input-icon'>
                                <input type='date' class='form-control ' placeholder='Select a date' id='start-date' name='tgBatDau'/>
                            </div>
                        </div>
                        <div class='col-md-5' style='padding-left:20px;padding-top:6px;'>
                            <div class='input-icon'>
                                <input type='date' class='form-control ' placeholder='Select a date' id='end-date' name='tgKetThuc'/>
                            </div>
                        </div>
                        <div class='col-md-2' style='padding:0 20px;padding-top:6px;'>
                            <button type='submit' class='btn btn-primary'>Tìm kiếm</button>
                        </div>  
                    </div>
                </div>
            </form>
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
                    <tbody id='hoadon-table-body'>";
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
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('hoadon', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateHoaDonModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('hoadon', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deleteHoaDonModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
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
        <div id='deleteHoaDonModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteHD'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Thể loại</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Hóa đơn này ?</p>
                            <input type='hidden' id='recordId' name='recordId'>
                            <input type='hidden' id='trangthai' name='trangthai'>
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
    </div>
</main>";
}else if (isset($_GET['phieunhap'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Phiếu nhập</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Phiếu nhập</li>
        </ol>";
        if (coQuyenThem('phieunhap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addPhieuNhapModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm Phiếu nhập mới
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng phiếu nhập
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Mã phiếu nhập</th>
                            <th>Tên nhân viên</th>
                            <th>Tên NCC</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $phieuNhap = new PhieuNhap();
                        $phieuNhapArray = $phieuNhap->getAll();
                        $s='';
                        foreach ($phieuNhapArray as $item)
                        {
                            $s .= "<tr>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['tennv'] . "</td>
                                    <td>" . $item['tenncc'] . "</td>
                                    <td>" . $item['total'] . "</td>
                                    <td>" . $item['date'] . "</td>
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('phieunhap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updatePhieuNhapModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('phieunhap', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#deletePhieuNhapModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
                                    </td>
                                </tr>";
                        }
                        echo $s;

                    echo "</tbody>
                    <tfoot>
                        <tr>
                            <th>Mã phiếu nhập</th>
                            <th>Tên nhân viên</th>
                            <th>Tên NCC</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addPhieuNhapModal' class='modal fade'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddPN'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Phiếu Nhập</h4>
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
                                                <label for='idhd'>Mã PN</label>
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
                                                <input type='int' class='form-control' id='ngaytao' placeholder='' value='' readonly>
                                                <label for='ngaytao'>Ngày tạo</label>
                                            </div>
                                        </div>
                                        
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-9    '>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namekh' style='height:58px;'>";
                                                    $nhacungcap = new NhaCungCap();
                                                    $nhaCungCapArray = $nhacungcap->getListNCC();
                                                    $s='';
                                                    foreach ($nhaCungCapArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namekh'>Tên Nhà cung cấp</label>
                                            </div>            
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='totalAll' placeholder='' value='' readonly>
                                                <label for='totalAll'>Tổng tiền</label>
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
        <div id='updatePhieuNhapModal' class='modal fade'>
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
                                                <label for='idhdupdate'>Mã PN</label>
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
                                                <input type='int' class='form-control' id='ngaytaoupdate' placeholder='' value='' readonly>
                                                <label for='ngaytaoupdate'>Ngày tạo</label>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class='row g-2'>
                                        <div class='col-md-9'>
                                            <div class='form-floating'>
                                                <select class='form-select' aria-label='Default select example' id='namekhupdate' style='height:58px;'>";
                                                    $nhacungcap = new NhaCungCap();
                                                    $nhaCungCapArray = $nhacungcap->getListNCC();
                                                    $s='';
                                                    foreach ($nhaCungCapArray as $item)
                                                    {
                                                        $s .= "
                                                            <option value='".$item['id']."'>".$item['ten']."</option>
                                                        ";
                                                    }
                                                    echo $s;
                                                echo "</select>
                                                <label for='namekhupdate'>Tên nhà cung cấp</label>
                                            </div>            
                                        </div>
                                        
                                        <div class='col-md-3'>
                                            <div class='form-floating'>
                                                <input type='int' class='form-control' id='totalAllupdate' placeholder='' value='' readonly>
                                                <label for='totalAllupdate'>Tổng tiền</label>
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
        <div id='deletePhieuNhapModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeletePN'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Phiếu Nhập</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Phiếu nhập này ?</p>
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
    </div>
</main>";
}else if (isset($_GET['nhomquyen'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Nhóm quyền</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Nhóm quyền</li>
        </ol>";
        if (coQuyenThem('nhomquyen', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-auto ms-auto' style='padding-right:0px;padding-bottom:10px'>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal'
                        data-bs-target='#addNhomQuyenModal'>
                    <i class='fa-solid fa-circle-plus'></i>
                        Thêm nhóm quyền
                    </button>
                </div>  
            </div>
        </div>";
        }
        echo "
        
        <div class='card mb-4'>
            <div class='card-header'>
                <i class='fas fa-table me-1'></i>
                Bảng nhóm quyền
            </div>
            <div class='card-body'>
                <table id='datatablesSimple' class='table table-striped'>
                    <thead>
                        <tr>
                            <th width=15% style='text-align: center;'>Mã nhóm quyền</th>
                            <th>Tên nhóm quyền</th>
                            <th style='width: 15%;text-align: -webkit-center;'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $nhomQuyen = new NhomQuyen();
                        $nhomQuyenArray = $nhomQuyen->getAll();
                        $s='';
                        foreach ($nhomQuyenArray as $item)
                        {
                            $s .= "<tr>
                                    <td width=15% style='text-align: center;'>" . $item['id'] . "</td>
                                    <td>" . $item['ten'] . "</td>
                                    <td style='text-align: center;'>";
                                    if (coQuyenSua('nhomquyen', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= "<a data-bs-target='#updateNhomQuyenModal' class='update' data-bs-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                                    }
                                    $s .= "<span style='margin: 0 10px'></span>";
                                    if (coQuyenXoa('nhomquyen', $cacMaChucNangTruyCap, $quyenChucNang, $crud)) {
                                        $s .= " <a data-bs-target='#deleteNhomQuyenModal' class='delete' data-bs-toggle='modal'><i class='fa-solid fa-trash' style='color: #ed0c0c;'></i></a>";
                                    }
                            $s .= "
                                    </td>
                                </tr>";
                        }
                        echo $s;
                    echo "</tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width=15% style='text-align: center;'>Mã nhóm quyền</th>
                            <th>Tên nhóm quyền</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id='addNhomQuyenModal' class='modal fade'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formAddNQ'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Add Nhóm quyền</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body' style='margin-top:0px'>
                            <div class='row g-2'>
                                <div class='col-md-3'>
                                    <div class='form-floating'>
                                        <input type='int' class='form-control' id='idnq' placeholder='' value='' readonly>
                                        <label for='idnq'>Mã nhóm quyền</label>
                                    </div>
                                </div>
                                <div class='col-md-9'>
                                    <div class='form-floating'>
                                        <input type='text' class='form-control' id='tennq' placeholder='' value='' required>
                                        <label for='tennq'>Tên nhóm quyền</label>
                                    </div>            
                                </div>
                            </div>  
                            <div class='container_hd' style='align-items:flex-start;'>
                                <div id='left' style='width: 20%; display: flex; flex-direction: column;align-items: center;'>";
                                    $chucNang =  new ChucNang();
                                    $chucNangArray = $chucNang->getAll();
                                    $s='';
                                    foreach($chucNangArray as $item){
                                        $s.="
                                        <div class='box'>
                                            <label id='" .$item['id']. "'>" .$item['ten']. "</label>
                                        </div>";
                                    }
                                    echo $s;
                                echo "</div>
                                <div id='right' style='width: 78%; display: flex; flex-direction: column;'>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemTK' class='cbXemTK' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemTK' class='cbThemTK' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaTK' class='cbSuaTK' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaTK' class='cbXoaTK' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemNQ' class='cbXemNQ' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemNQ' class='cbThemNQ' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaNQ' class='cbSuaNQ' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaNQ' class='cbXoaNQ' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between' id='sanpham'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemSP' class='cbXemSP' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemSP' class='cbThemSP' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaSP' class='cbSuaSP' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaSP' class='cbXoaSP' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemPN' class='cbXemPN' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemPN' class='cbThemPN' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaPN' class='cbSuaPN' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaPN' class='cbXoaPN' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between' disabled>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemHD' class='cbXemHD' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemHD' class='cbThemHD' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaHD' class='cbSuaHD' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaHD' class='cbXoaHD' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between' disabled>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemNCC' class='cbXemNCC' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemNCC' class='cbThemNCC' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaNCC' class='cbSuaNCC' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaNCC' class='cbXoaNCC' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between' disabled>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemND' class='cbXemND' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemND' class='cbThemND' disabled>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaND' class='cbSuaND' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaND' class='cbXoaND' disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemTL' class='cbXemTL' onchange='togglePermission(this)'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbThemTL' class='cbThemTL' disabled >
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbSuaTL' class='cbSuaTL' disabled>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXoaTL' class='cbXoaTL'disabled>
                                            Xóa
                                        </label>
                                    </div>
                                    
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='cbXemTKe' class='cbXemTKe'>
                                            Xem
                                        </label>
                                    </div>
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
        <div id='deleteNhomQuyenModal' class='modal fade'>
		    <div class='modal-dialog modal-dialog-centered'>
			    <div class='modal-content'>
				    <form id='formDeleteNQ'>
					    <div class='modal-header'>						
						    <h5 class='modal-title'>Delete Nhóm quyền</h4>
						    <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
					    </div>
					    <div class='modal-body'>					
						    <p>Bạn có muốn xóa Nhóm quyền <span id='deleteName'></span> ?</p>
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

        <div id='updateNhomQuyenModal' class='modal fade'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <form class='row g-3 needs-validation' novalidate id='formUpdateNQ'>
                        <div class='modal-header'>
                            <h4 class='modal-title'>Update Nhóm quyền</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='row g-2'>
                                <div class='col-md-3'>
                                    <div class='form-floating'>
                                        <input type='int' class='form-control' id='updateId' placeholder='' value='' readonly>
                                        <label for='updateId'>Mã nhóm quyền</label>
                                    </div>
                                </div>
                                <div class='col-md-9'>
                                    <div class='form-floating'>
                                        <input type='text' class='form-control' id='updateName' placeholder='' value='' required>
                                        <label for='updateName'>Tên nhóm quyền</label>
                                    </div>            
                                </div>
                            </div>  
                            <div class='container_hd' style='align-items:flex-start;'>
                                <div id='left' style='width: 20%; display: flex; flex-direction: column;align-items: center;'>";
                                    $chucNang =  new ChucNang();
                                    $chucNangArray = $chucNang->getAll();
                                    $s='';
                                    foreach($chucNangArray as $item){
                                        $s.="
                                        <div class='box'>
                                            <label id='" .$item['id']. "'>" .$item['ten']. "</label>
                                        </div>";
                                    }
                                    echo $s;
                                echo "</div>
                                <div id='right' style='width: 78%; display: flex; flex-direction: column;'>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemTK' class='ucbXemTK' onchange='togglePermissionplus(this)>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemTK' class='ucbThemTK'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaTK' class='ucbSuaTK'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaTK' class='ucbXoaTK'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemNQ' class='ucbXemNQ'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemNQ' class='ucbThemNQ'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaNQ' class='ucbSuaNQ'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaNQ' class='ucbXoaNQ'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between' id='sanpham'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemSP' class='ucbXemSP'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemSP' class='ucbThemSP'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaSP' class='ucbSuaSP'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaSP' class='ucbXoaSP'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemPN' class='ucbXemPN'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemPN' class='ucbThemPN'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaPN' class='ucbSuaPN'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaPN' class='ucbXoaPN'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemHD' class='ucbXemHD'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemHD' class='ucbThemHD'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaHD' class='ucbSuaHD'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaHD' class='ucbXoaHD'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemNCC' class='ucbXemNCC'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemNCC' class='ucbThemNCC'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaNCC' class='ucbSuaNCC'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaNCC' class='ucbXoaNCC'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemND' class='ucbXemND'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemND' class='ucbThemND'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaND' class='ucbSuaND'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaND' class='ucbXoaND'>
                                            Xóa
                                        </label>
                                    </div>
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemTL' class='ucbXemTL'>
                                            Xem
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbThemTL' class='ucbThemTL'>
                                            Thêm
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbSuaTL' class='ucbSuaTL'>
                                            Sửa
                                        </label>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXoaTL' class='ucbXoaTL'>
                                            Xóa
                                        </label>
                                    </div>
    
                                    <div style='display: flex;justify-content: space-between'>
                                        <label class='checkbox-label'>
                                            <input type='checkbox' id='ucbXemTKe' class='ucbXemTKe'>
                                            Xem
                                        </label>
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
}else if (isset($_GET['thongke'])) {
    echo "<main>
    <div class='container-fluid px-4'>
        <h1 class='mt-4'>Thống kê</h1>
        <ol class='breadcrumb mb-4'>
            <li class='breadcrumb-item'><a href='admin.php'>Dashboard</a></li>
            <li class='breadcrumb-item active'>Thống kê</li>
        </ol>
        <div class='main-panel'>
            <div class='content-wrapper'>
                <div class='row'>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body'>
                                <h4 class='card-title'>Thống kê theo từng tháng</h4>
                                <canvas id='lineChart'></canvas>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body'>
                                <h4 class='card-title'>Bảng theo dõi theo từng tháng</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            <th>Thành tiền</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                        $hoaDon = new HoaDon();
                                        $hoaDonArray = $hoaDon->getHDDG();
                                        $s='';
                                        foreach ($hoaDonArray as $item)
                                        {
                                            $s .= "<tr>
                                                    <td>" . $item['id'] . "</td>
                                                    <td>" . $item['tongtien'] . "</td>
                                                    <td>" . $item['date'] . "</td>
                                                    <td>" . $item['trangthai'] . "</td>
                                                </tr>";
                                        }
                                        echo $s;

                                    echo "
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Mã phiếu nhập</th>
                                            <th>Thành tiền</th>
                                            <th>Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                        $phieuNhap = new PhieuNhap();
                                        $phieuNhapArray = $phieuNhap->getPN();
                                        $s='';
                                        foreach ($phieuNhapArray as $item)
                                        {
                                            $s .= "<tr>
                                                    <td>" . $item['id'] . "</td>
                                                    <td>" . $item['total'] . "</td>
                                                    <td>" . $item['date'] . "</td>
                                                </tr>";
                                        }
                                        echo $s;

                                    echo "
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class='row'>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body'>
                                <h4 class='card-title'>Sản phẩm bán chạy theo khoản thời gian</h4>
                                <canvas id='productChart'></canvas>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body'>
                                <div class='card-body'>
                                    <form class='row w-full' id='filter-form'>
                                        <div class='col' style='justify-items: center;align-items: center;display: flex;'>
                                            <div class='col'>
                                                <div class='input-icon'>
                                                    <input type='date' class='form-control ' placeholder='Select a date' id='start-date' name='tgBatDau'/>
                                                </div>
                                            </div>
                                            <div class='col'>
                                                <div class='input-icon'>
                                                    <input type='date' class='form-control ' placeholder='Select a date' id='end-date' name='tgKetThuc'/>
                                                </div>
                                            </div>
                                            <div class='col-auto d-flex align-items-end'>
                                                <button type='submit' class='btn btn-primary'>Lọc</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <table id='value'>
                                    <thead>
                                        <tr>
                                            <th>Mã Sản phẩm</th>
                                            <th>Tên Sản phẩm</th>
                                            <th>Tổng số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body'>
                            <h4 class='card-title'> </h4>
                            <canvas id='doughnutChart'></canvas>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-6 grid-margin stretch-card'>
                        <div class='card'>
                            <div class='card-body' style='padding-bottom:0px'>
                                <form class='row w-full' id='filter-form-2'>
                                    <div class='col' style='justify-items: center;align-items: center;display: flex;'>
                                        <div class='col'>
                                            <div class='input-icon'>
                                                <select class='form-select' aria-label='Default select example' id='thongKeTheo'>
                                                    <option value='1'>Sản phẩm</option>
                                                    <option value='0'>Thể loại</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='input-icon'>
                                                <input type='date' class='form-control ' placeholder='Select a date' id='start-date-2' name='tgBatDau'/>
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='input-icon'>
                                                <input type='date' class='form-control ' placeholder='Select a date' id='end-date-2' name='tgKetThuc'/>
                                            </div>
                                        </div>
                                        <div class='col-auto d-flex align-items-end'>
                                            <button type='submit' class='btn btn-primary'>Lọc</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class='card-body' style='padding-top :0px'>
                                <table id='value-2'>
                                    <thead>
                                        <tr>
                                            <th>Mã Sản phẩm</th>
                                            <th>Tên Sản phẩm</th>
                                            <th>Thể loại</th>
                                            <th>Tổng số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</main>";
}
?>