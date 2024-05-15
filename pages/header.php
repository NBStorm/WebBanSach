<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/main-logo.png" class="logo" style="width: 143px; height: 48px;">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="navbar-icon">
                    <use xlink:href="#navbar-icon"></use>
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="index.php">
                        <img src="img/main-logo.png" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                        aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar"
                        class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="#billboard">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#company-services">Dịch vụ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#selling-products">Sách bán chạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#all-product">Tất cả sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#yearly-sale">Khuyến mãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="search-item pe-3">
                                        <a href="#" class="search-button">
                                            <svg class="search">
                                                <use xlink:href="#search"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php
                                    // Kiểm tra trạng thái đăng nhập

                                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                        // Nếu người dùng đã đăng nhập, hiển thị tên người đăng nhập
                                        echo "
                                        <li class='nav-item dropdown'>
                                            <a class='nav-link me-4 dropdown-toggle link-dark' data-bs-toggle='dropdown' href='#'
                                                role='button' aria-expanded='false'>Xin chào, " . $_SESSION['Username'] . "</a>
                                            <ul class='dropdown-menu'>
                                                <li>
                                                    <button class='dropdown-item' data-toggle='modal' data-target='#modalOrders' onclick='loadContentModalOrders()'>Đơn hàng đã mua</button>
                                                </li>
                                                <li>
                                                    <button onclick='logOut()' class='dropdown-item' id='logout-link'>Đăng xuất</button>
                                                </li>
                                            </ul>
                                        </li>
                                        ";
                                    } else {
                                        // Nếu người dùng chưa đăng nhập, hiển thị liên kết đăng nhập
                                        echo '<li class="pe-3"><a href="#" onclick="addModalLoginSignup()"><svg class="user"><use xlink:href="#user"></use></svg></a></li>';
                                    }
                                    ?>
                                    <li class="pe-3">
                                        <a href="#" onclick="addModalCart()">
                                            <svg class="cart">
                                                <use xlink:href="#cart"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>