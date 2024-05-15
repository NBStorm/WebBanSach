function addProductToCart(ma, ten, gia, hinhanh) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    // Tìm sản phẩm trong giỏ hàng theo mã
    let sanPhamTonTai = cart.find(sanPham => sanPham.ma === ma);

    if (sanPhamTonTai) {
        // Nếu sản phẩm đã tồn tại, tăng số lượng lên
        sanPhamTonTai.soLuong += 1;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới với số lượng là 1
        const sanPhamMoi = {
            ma: ma,
            ten: ten,
            gia: gia,
            hinhAnh: hinhanh,
            soLuong: 1
        };
        cart.push(sanPhamMoi);
    }

    // Cập nhật lại giỏ hàng trong localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    alert("Thêm sản phẩm vào giỏ hàng thành công");
}

function addProductToCart2(ma, ten, gia, hinhanh) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    let quantity = document.getElementById(`quantity-${ma}`).value;
    quantity = parseInt(quantity);

    // Tìm sản phẩm trong giỏ hàng theo mã
    let sanPhamTonTai = cart.find(sanPham => sanPham.ma === ma);

    if (sanPhamTonTai) {
        // Nếu sản phẩm đã tồn tại, tăng số lượng lên
        sanPhamTonTai.soLuong += quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới với số lượng là 1
        const sanPhamMoi = {
            ma: ma,
            ten: ten,
            gia: gia,
            hinhAnh: hinhanh,
            soLuong: quantity
        };
        cart.push(sanPhamMoi);
    }

    // Cập nhật lại giỏ hàng trong localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    alert("Thêm sản phẩm vào giỏ hàng thành công");
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
                            <td id="tenSanPham">${sanPham.ten}</td>
                            <td>${sanPham.gia}</td>
                            <td class="qty"><input type="number" class="form-control" value="${sanPham.soLuong}" onchange="updateQuantity(${sanPham.ma}, this.value)"></td>
                            <td>${tongGia}</td>
                            <td>
                                <button onclick="deleteProductFromCart(${sanPham.ma})" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>`;
        tongtienhang += tongGia;
    });

    document.getElementById('load-product-cart').innerHTML = tableContent;
    document.getElementById('load-total-cart').innerHTML = tongtienhang;
}

function deleteProductFromCart(ma) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    // Lọc để giữ lại các sản phẩm không có mã là ma
    temp = cart.filter(sanPham => sanPham.ma != ma);

    // Cập nhật lại giỏ hàng trong localStorage
    localStorage.setItem('cart', JSON.stringify(temp));

    // Gọi lại hàm renderCart để cập nhật giao diện giỏ hàng
    renderCart();
}

// Hàm để cập nhật số lượng sản phẩm trong giỏ hàng
function updateQuantity(ma, soLuong) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
    
    // Tìm sản phẩm trong giỏ hàng theo mã
    let sanPhamTonTai = cart.find(sanPham => sanPham.ma == ma);

    if (sanPhamTonTai) {
        // Cập nhật số lượng mới
        sanPhamTonTai.soLuong = parseInt(soLuong);

        // Cập nhật lại giỏ hàng trong localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Gọi lại hàm renderCart để cập nhật giao diện giỏ hàng
        renderCart();
    }
}

function logOut() {
    localStorage.removeItem('cart');
    window.location.href = './admin/logout.php';
}

function addModalDetailsProduct(ma, ten, gia, hinhAnh) {

    let content = `
        <div class="col-md-4">
            <img src="./img/${hinhAnh}" alt="Book Image" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h5>Tên sách: ${ten}</h5>
            <p>Giá: ${gia} VND</p>
            <div class="form-group">
                <label for="quantity-${ma}">Số lượng:</label>
                <input type="number" class="form-control" id="quantity-${ma}" value="1" min="1">
            </div>
            <button type="button" class="btn btn-success" onclick='addProductToCart2(${ma},\"${ten}\", ${gia}, \"${hinhAnh}\")'">Thêm vào giỏ hàng</button>
        </div>`;

    
    document.getElementById('loadContent').innerHTML = content;
    // document.getElementById('modalDetailsProduct').style.display = 'block';
}













