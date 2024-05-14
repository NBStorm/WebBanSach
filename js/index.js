function addProductToCart(ten, gia, hinhanh) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    // Tìm sản phẩm trong giỏ hàng theo tên
    let sanPhamTonTai = cart.find(sanPham => sanPham.ten === ten);

    if (sanPhamTonTai) {
        // Nếu sản phẩm đã tồn tại, tăng số lượng lên
        sanPhamTonTai.soLuong += 1;
        sanPhamTonTai.tongGia += gia;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới với số lượng là 1
        const sanPhamMoi = {
            ten: ten,
            gia: gia,
            hinhAnh: hinhanh,
            soLuong: 1,
            tongGia: gia
        };
        cart.push(sanPhamMoi);
    }

    // Cập nhật lại giỏ hàng trong localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
}

function renderCart() {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
    let tableContent = ``;
    let tongtienhang = 0;


    cart.forEach(sanPham => {
        let tongGia = sanPham.gia * sanPham.soLuong;
        tableContent += `<tr>
                            <td class="w-25">
                                <img src="./img/${sanPham.hinhAnh}" class="img-fluid img-thumbnail" alt="Sheep" style="height:150px">
                            </td>
                            <td>${sanPham.ten}</td>
                            <td>${sanPham.gia}</td>
                            <td class="qty"><input type="text" class="form-control" value="${sanPham.soLuong}"></td>
                            <td>${tongGia}</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>`
        tongtienhang += sanPham.tongGia;
    });

    document.getElementById('load-product-cart').innerHTML = tableContent;

    document.getElementById('load-total-cart').innerHTML = tongtienhang;
}