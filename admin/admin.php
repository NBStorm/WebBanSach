<?php
require 'nhomquyen.php';
session_start();
if (!isset($_SESSION['MaNQ'])) {
    header("Location: khongcoquyen.php"); // Chuyển hướng đến trang "khongcoquyen.php"
    exit;
}
if (isset($_SESSION['MaNQ']) && $_SESSION['MaNQ'] == 2) {
    header("Location: khongcoquyen.php"); // Chuyển hướng đến trang "khongcoquyen.php"
    exit;
}

if (isset($_SESSION['MaNQ'])) {
    $id = $_SESSION['MaNQ'];

    $cacMaChucNangTruyCap = array();

    $nhomQuyen = new NhomQuyen();
    $quyenArray = $nhomQuyen->getCTQ($id);

    $quyenChucNang = array(
        'taikhoan' => 1,
        'nhomquyen' => 2,
        'sanpham' => 3,
        'phieunhap' => 4,
        'hoadon' => 5,
        'nhacungcap' => 6,
        'nguoidung' => 7,
        'theloai' => 8,
        'thongke' => 9
    );

    $crud = array(
        'Xem' => 'Xem',
        'Thêm' => 'Thêm',
        'Xóa' => 'Xóa',
        'Sửa' => 'Sửa'
    );

    if (!empty($quyenArray)) {
        foreach ($quyenArray as $quyen) {
            $cacMaChucNangTruyCap[] = array('idcn' => $quyen['idcn'], 'hd' => $quyen['hd']);
        }
    } else {
        echo "Không có quyền chức năng nào được tìm thấy cho nhóm quyền có mã là $id";
    }
}

function coQuyenTruyCap($chucNang, $cacMaChucNangTruyCap, $quyenChucNang)
{
    $idcn = $quyenChucNang[$chucNang] ?? null;
    if ($idcn !== null) {
        foreach ($cacMaChucNangTruyCap as $quyen) {
            if ($quyen['idcn'] == $idcn && $quyen['hd'] == 'Xem') {
                return true;
            }
        }
    }
    return false;
}

function coQuyenThem($chucNang, $cacMaChucNangTruyCap, $quyenChucNang, $crud)
{
    $idcn = $quyenChucNang[$chucNang] ?? null;
    if ($idcn !== null) {
        foreach ($cacMaChucNangTruyCap as $quyen) {
            if ($quyen['idcn'] == $idcn && $quyen['hd'] == $crud['Thêm']) {
                return true;
            }
        }
    }
    return false;
}

function coQuyenXoa($chucNang, $cacMaChucNangTruyCap, $quyenChucNang, $crud)
{
    $idcn = $quyenChucNang[$chucNang] ?? null;
    if ($idcn !== null) {
        foreach ($cacMaChucNangTruyCap as $quyen) {
            if ($quyen['idcn'] == $idcn && $quyen['hd'] == $crud['Xóa']) {
                return true;
            }
        }
    }
    return false;
}

function coQuyenSua($chucNang, $cacMaChucNangTruyCap, $quyenChucNang, $crud)
{
    $idcn = $quyenChucNang[$chucNang] ?? null;
    if ($idcn !== null) {
        foreach ($cacMaChucNangTruyCap as $quyen) {
            if ($quyen['idcn'] == $idcn && $quyen['hd'] == $crud['Sửa']) {
                return true;
            }
        }
    }
    return false;
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="admin.php">Web Bán Sách</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Chức năng</div>
                        <?php
                        if (coQuyenTruyCap('nguoidung', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?nguoidung">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Người Dùng
                            </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('taikhoan', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?taikhoan">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Tài Khoản
                            </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('sanpham', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?sanpham">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Sản Phẩm
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('theloai', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?theloai">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thể Loại
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('phieunhap', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?phieunhap">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Phiếu Nhập
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('hoadon', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?hoadon">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Hóa Đơn
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('nhacungcap', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?nhacungcap">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Nhà Cung Cấp
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('thongke', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?thongke">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thống kê
                        </a>';
                        }
                        ?>
                        <?php
                        if (coQuyenTruyCap('nhomquyen', $cacMaChucNangTruyCap, $quyenChucNang)) {
                            echo '<a class="nav-link" href="admin.php?nhomquyen">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Nhóm quyền
                        </a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php
                    echo $_SESSION['Username'];
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <?php
            include ("load-interface.php")
            ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            // Gán sự kiện click cho phần tử cha chứa các nút "Delete"
            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('theloai')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nhacungcap')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nguoidung')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });


            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('hoadon')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var trangthai = row.find('td:nth-child(6)').text();
                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#trangthai').val(trangthai);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('phieunhap')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('taikhoan')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('sanpham')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });

            $(document).on('click', '.delete', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nhomquyen')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#recordId').val(id);
                    $('#deleteName').text(name);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('sanpham')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var gia = row.find('td:nth-child(3)').text();
                    var tl = row.find('td:nth-child(5)').text();
                    var src = row.find('.product-image').attr('src');
                    var fileName = src.split('/').pop();
                    console.log(fileName);

                    $('#updateSelectedFileName').text('' + fileName);

                    $('#updateTheLoai option').each(function () {
                        if ($(this).text() === tl) {
                            $(this).prop('selected', true);
                            return false;
                        }
                    });

                    if (fileName != '') {
                        document.getElementById('myImageUpdate').src = '../img/' + fileName;
                        document.getElementById('myImageUpdate').classList.remove('d-none');
                        document.getElementById('delete-btn-update').classList.remove('d-none');
                    } else {
                        document.getElementById('myImageUpdate').classList.add('d-none');
                        document.getElementById('delete-btn-update').classList.add('d-none');
                    }


                    // Đặt dữ liệu vào modal
                    $('#updateId').val(id);
                    $('#updateName').val(name);
                    $('#updateGia').val(gia);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('theloai')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    console.log(id)
                    console.log(name)
                    // Đặt dữ liệu vào modal
                    $('#updateID').val(id);
                    $('#updateName').val(name);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nhomquyen')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai

                    // Đặt dữ liệu vào modal
                    $('#updateId').val(id);
                    $('#updateName').val(name);
                    $('input[type="checkbox"]').prop('checked', false);
                    $.ajax({
                        url: 'get_ctq.php', // Tập tin PHP xử lý yêu cầu
                        type: 'GET',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.each(data, function (index, item) {
                                console.log(item['idcn']);
                                switch (item['idcn']) {
                                    case '1':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemTK').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemTK').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaTK').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaTK').checked = true;
                                        }
                                        break;
                                    case '2':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemNQ').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemNQ').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaNQ').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaNQ').checked = true;
                                        }
                                        break;
                                    case '3':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemSP').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemSP').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaSP').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaSP').checked = true;
                                        }
                                        break;
                                    case '4':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemPN').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemPN').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaPN').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaPN').checked = true;
                                        }
                                        break;
                                    case '5':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemHD').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemHD').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaHD').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaHD').checked = true;
                                        }
                                        break;
                                    case '6':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemNCC').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemNCC').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaNCC').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaNCC').checked = true;
                                        }
                                        break;
                                    case '7':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemND').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemND').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaND').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaND').checked = true;
                                        }
                                        break;
                                    case '8':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemTL').checked = true;
                                        } if (item['hd'] === 'Thêm') {
                                            document.getElementById('ucbThemTL').checked = true;
                                        } if (item['hd'] === 'Sửa') {
                                            document.getElementById('ucbSuaTL').checked = true;
                                        } if (item['hd'] === 'Xóa') {
                                            document.getElementById('ucbXoaTL').checked = true;
                                        }
                                        break;
                                    case '9':
                                        if (item['hd'] === 'Xem') {
                                            document.getElementById('ucbXemTKe').checked = true;
                                        }
                                        break;
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nhacungcap')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var sdt = row.find('td:nth-child(3)').text(); // Lấy dữ liệu từ cột thứ ba
                    var diachi = row.find('td:nth-child(4)').text(); // Lấy dữ liệu từ cột thứ tư

                    // Đặt dữ liệu vào modal
                    $('#updateID').val(id);
                    $('#updateName').val(name);
                    $('#updatePN').val(sdt);
                    $('#updateDiaChi').val(diachi);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('nguoidung')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var name = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var sdt = row.find('td:nth-child(3)').text(); // Lấy dữ liệu từ cột thứ ba
                    var email = row.find('td:nth-child(4)').text(); // Lấy dữ liệu từ cột thứ tư

                    // Đặt dữ liệu vào modal
                    $('#updateID').val(id);
                    $('#updateName').val(name);
                    $('#updatePN').val(sdt);
                    $('#updateEmail').val(email);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('taikhoan')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var username = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var password = row.find('td:nth-child(3)').text(); // Lấy dữ liệu từ cột thứ ba
                    var nq = row.find('td:nth-child(4)').text(); // Lấy dữ liệu từ cột thứ tư
                    var ngaytao = row.find('td:nth-child(5)').text();

                    // Đặt dữ liệu vào modal
                    $('#updateId').val(id);

                    $.ajax({
                        url: 'get_nd.php', // Tập tin PHP xử lý yêu cầu
                        type: 'GET',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#updateND').empty();
                            $.each(data, function (index, item) {
                                var option = $(
                                    '<option></option>'); // Tạo một tùy chọn mới
                                option.attr('value', item[
                                    'id']); // Đặt giá trị của tùy chọn
                                option.text(item['ten']); // Đặt văn bản của tùy chọn
                                $('#updateND').append(option);

                                // Kiểm tra xem giá trị "ten" của tùy chọn có khớp với giá trị được chọn không
                                if (item['id'] === username) {
                                    option.prop('selected',
                                        true); // Chọn tùy chọn nếu khớp
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });

                    $('#updateNQ option').each(function () {
                        if ($(this).text() === nq) {
                            $(this).prop('selected', true);
                            return false;
                        }
                    });
                    $('#updatePass').val(password);
                    $('#updateDate').val(ngaytao);
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('hoadon')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var namenv = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var namekh = row.find('td:nth-child(3)').text(); // Lấy dữ liệu từ cột thứ ba
                    var tongtien = row.find('td:nth-child(4)').text(); // Lấy dữ liệu từ cột thứ tư
                    var ngaytao = row.find('td:nth-child(5)').text();
                    var trangthai = row.find('td:nth-child(6)').text();
                    // Đặt dữ liệu vào modal
                    $('#idhdupdate').val(id);
                    // Lặp qua từng tùy chọn trong select với id là 'namekh'
                    $('#namekhupdate option').each(function () {
                        // Kiểm tra văn bản của tùy chọn hiện tại
                        if ($(this).text() === namekh) {
                            // Nếu văn bản của tùy chọn khớp với 'Nguyen D', chọn tùy chọn đó
                            $(this).prop('selected', true);
                            // Thoát khỏi vòng lặp vì đã tìm thấy tùy chọn khớp
                            return false;
                        }
                    });
                    $('#namenvupdate option').each(function () {
                        if ($(this).text() === namenv) {
                            $(this).prop('selected', true);
                            return false;
                        }
                    });
                    $('#totalAllupdate').val(tongtien);
                    $('#ngaytaoupdate').val(ngaytao);
                    $('#trangthaiupdate').val(trangthai);

                    $.ajax({
                        url: 'get_cthd.php', // Tập tin PHP xử lý yêu cầu
                        type: 'GET',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#productListupdate tbody').empty();
                            $.each(data, function (index, item) {
                                // Tạo một chuỗi HTML cho mỗi dòng
                                var dataString = `<tr>
                                                    <td>${item.id}</td>
                                                    <td>${item.tensp}</td>
                                                    <td>${item.gia}</td>
                                                    <td>${item.soluong}</td>
                                                    <td>${parseInt(item.gia) * parseInt(item.soluong)}</td>
                                                    <td><button onclick="deleteRow_update(this)">Xóa</button></td>
                                                </tr>`;
                                // Thêm chuỗi dữ liệu vào tbody của bảng
                                $('#productListupdate tbody').append(dataString);
                            });

                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $(document).on('click', '.update', function () {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('phieunhap')) {
                    var row = $(this).closest('tr'); // Lấy dòng chứa nút được nhấn
                    var id = row.find('td:nth-child(1)').text(); // Lấy dữ liệu từ cột đầu tiên
                    var namenv = row.find('td:nth-child(2)').text(); // Lấy dữ liệu từ cột thứ hai
                    var namekh = row.find('td:nth-child(3)').text(); // Lấy dữ liệu từ cột thứ ba
                    var tongtien = row.find('td:nth-child(4)').text(); // Lấy dữ liệu từ cột thứ tư
                    var ngaytao = row.find('td:nth-child(5)').text();

                    // Đặt dữ liệu vào modal
                    $('#idhdupdate').val(id);
                    // Lặp qua từng tùy chọn trong select với id là 'namekh'
                    $('#namekhupdate option').each(function () {
                        // Kiểm tra văn bản của tùy chọn hiện tại
                        if ($(this).text() === namekh) {
                            // Nếu văn bản của tùy chọn khớp với 'Nguyen D', chọn tùy chọn đó
                            $(this).prop('selected', true);
                            // Thoát khỏi vòng lặp vì đã tìm thấy tùy chọn khớp
                            return false;
                        }
                    });
                    $('#namenvupdate option').each(function () {
                        if ($(this).text() === namenv) {
                            $(this).prop('selected', true);
                            return false;
                        }
                    });
                    $('#totalAllupdate').val(tongtien);
                    $('#ngaytaoupdate').val(ngaytao);


                    $.ajax({
                        url: 'get_ctpn.php', // Tập tin PHP xử lý yêu cầu
                        type: 'GET',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#productListupdate tbody').empty();
                            $.each(data, function (index, item) {
                                // Tạo một chuỗi HTML cho mỗi dòng
                                var dataString = `<tr>
                                                    <td>${item.id}</td>
                                                    <td>${item.tensp}</td>
                                                    <td>${item.gia}</td>
                                                    <td>${item.soluong}</td>
                                                    <td>${parseInt(item.gia) * parseInt(item.soluong)}</td>
                                                    <td><button onclick="deleteRow_update(this)">Xóa</button></td>
                                                </tr>`;
                                // Thêm chuỗi dữ liệu vào tbody của bảng
                                $('#productListupdate tbody').append(dataString);
                            });

                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $(document).ready(function () {
                $('.imgHoverLink').hover(
                    function (e) {
                        // Hiển thị hình ảnh và đặt vị trí của nó dựa trên vị trí của chuột
                        $(this).find('.imgHover').css({
                            'top': e.pageY + 10 + 'px', // Vị trí Y của chuột + 10px
                            'left': e.pageX + 10 + 'px' // Vị trí X của chuột + 10px
                        }).show();
                    },
                    function () {
                        // Ẩn hình ảnh khi không hover nữa
                        $(this).find('.imgHover').hide();
                    }
                );
            });


        });
    </script>
    <script>
        (function () {
            'use strict'

            // Check if there are forms with the class 'needs-validation'
            var forms = document.querySelectorAll('.needs-validation');

            // If there are, then apply Bootstrap validation styles
            if (forms.length > 0) {
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            }
        })();
    </script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css' rel='stylesheet'>
    <script>
        console.log(<?php echo json_encode($_SESSION['logged_in']); ?>);
        console.log(<?php echo json_encode($_SESSION['Username']); ?>);
        console.log(<?php echo json_encode($_SESSION['MaNQ']); ?>);
        console.log(<?php echo json_encode($_SESSION['MaTK']); ?>);

        <?php
            echo "document.getElementById('namenv').value = '" . addslashes($_SESSION['MaTK']) . "';";
        ?>
    </script>
</body>

</html>