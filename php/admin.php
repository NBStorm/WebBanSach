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
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="admin.php?nguoidung">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Người Dùng
                        </a>
                        <a class="nav-link" href="admin.php?taikhoan">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Tài Khoản
                        </a>
                        <a class="nav-link" href="admin.php?sanpham">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Sản Phẩm
                        </a>
                        <a class="nav-link" href="admin.php?theloai">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thể Loại
                        </a>
                        <a class="nav-link" href="admin.php?phieunhap">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Phiếu Nhập
                        </a>
                        <a class="nav-link" href="admin.php?hoadon">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Hóa Đơn
                        </a>
                        <a class="nav-link" href="admin.php?nhacungcap">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Nhà Cung Cấp
                        </a>
                        <a class="nav-link" href="admin.php?phanquyen">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Phân Quyền
                        </a>
                        <a class="nav-link" href="admin.php?thongke">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thống kê
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
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
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
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
</body>

</html>