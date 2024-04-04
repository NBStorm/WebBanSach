<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">


    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

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
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Sản Phẩm</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sản Phẩm</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Bảng sản phẩm
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped">
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
                                <tbody>
                                    <?php
                                    require_once 'sanpham.php';
                                    require_once 'DatabaseConnection.php';
                                    $sanpham = new Sanpham();
                                    $sanpham->__construct();
                                    echo $sanpham->getAll();
                                    ?>
                                </tbody>
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
        </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>