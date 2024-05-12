window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('theloai')) {
    document.getElementById('formAddTheLoai').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('floatingValidationID').value;
            var ten = document.getElementById('floatingValidationName').value;

            var formData = new FormData();
            formData.append('MaTL', id);
            formData.append('TenTL', ten);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('theloaixuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    document.getElementById('formDeleteTheLoai').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;

        $.ajax({
            url: 'theloaixuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response === 'success') {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.');
                }
            }
        });

    });

    document.getElementById('formUpdateTheLoai').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateID').value;
            var ten = document.getElementById('updateName').value;

            var formData = new FormData();
            formData.append('MaTL', id);
            formData.append('TenTL', ten);
            formData.append('action', 'sua'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('theloaixuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('nhacungcap')) {
    document.getElementById('formAddNhaCC').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('floatingValidationID').value;
            var ten = document.getElementById('floatingValidationName').value;
            var sdt = document.getElementById('floatingValidationPN').value;
            var diachi = document.getElementById('floatingValidationDiaChi').value;
            if (!validatePhoneNumber(sdt)) {
                alert('Số điện thoại không hợp lệ');
                return;
            }
            var formData = new FormData();
            formData.append('MaNCC', id);
            formData.append('TenNCC', ten);
            formData.append('SoDienThoai', sdt);
            formData.append('DiaChi', diachi);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nhacungcapxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    document.getElementById('formDeleteNhaCC').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;

        $.ajax({
            url: 'nhacungcapxuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response === 'success') {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.');
                }
            }
        });

    });
    document.getElementById('formUpdateNhaCC').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateID').value;
            var ten = document.getElementById('updateName').value;
            var sdt = document.getElementById('updatePN').value;
            var diachi = document.getElementById('updateDiaChi').value;
            if (!validatePhoneNumber(sdt)) {
                alert('Số điện thoại không hợp lệ');
                return;
            }

            var formData = new FormData();
            formData.append('MaNCC', id);
            formData.append('TenNCC', ten);
            formData.append('SoDienThoai', sdt);
            formData.append('DiaChi', diachi);
            formData.append('action', 'sua');// Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nhacungcapxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

}

function validatePhoneNumber(phoneNumber) {
    const regex = /^0\d{9}$/;
    return regex.test(phoneNumber);
}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('hoadon')) {
    document.addEventListener("DOMContentLoaded", function () {
        var table = document.getElementById("tableSelectHD");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener("click", function () {
                // Xóa class 'selected' khỏi tất cả các hàng
                for (var j = 0; j < rows.length; j++) {
                    rows[j].classList.remove("selected");
                }
                // Thêm class 'selected' vào hàng hiện tại được click
                this.classList.add("selected");
                // Hiển thị thông tin
                var cells = this.getElementsByTagName("td");
                document.getElementById('idsp').value = cells[0].innerText;
                document.getElementById('tensp').value = cells[1].innerText;
                document.getElementById('giasp').value = cells[2].innerText;
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        var table = document.getElementById("tableSelectHD_update");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener("click", function () {
                // Xóa class 'selected' khỏi tất cả các hàng
                for (var j = 0; j < rows.length; j++) {
                    rows[j].classList.remove("selected");
                }
                // Thêm class 'selected' vào hàng hiện tại được click
                this.classList.add("selected");
                // Hiển thị thông tin
                var cells = this.getElementsByTagName("td");
                document.getElementById('idsp_update').value = cells[0].innerText;
                document.getElementById('tensp_update').value = cells[1].innerText;
                document.getElementById('giasp_update').value = cells[2].innerText;
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        var slspInput = document.getElementById('slsp');
        var giaspInput = document.getElementById('giasp');
        var totalInput = document.getElementById('total');

        var slspInput_update = document.getElementById('slsp_update');
        var giaspInput_update = document.getElementById('giasp_update');
        var totalInput_update = document.getElementById('total_update');

        slspInput.addEventListener('input', function () {
            var slsp = parseInt(slspInput.value) || 0;
            var giasp = parseInt(giaspInput.value) || 0;
            var total = slsp * giasp;
            totalInput.value = total.toFixed(0); // Làm tròn đến 2 chữ số thập phân
        });

        slspInput_update.addEventListener('input', function () {
            var slsp = parseInt(slspInput_update.value) || 0;
            var giasp = parseInt(giaspInput_update.value) || 0;
            var total = slsp * giasp;
            totalInput_update.value = total.toFixed(0); // Làm tròn đến 2 chữ số thập phân
        });
    });
    //add
    document.addEventListener("DOMContentLoaded", function () {
        var addButton = document.getElementById('addButton');
        var productList = document.getElementById('productList').getElementsByTagName('tbody')[0];
        var tableSelectHD = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];

        addButton.addEventListener('click', function (event) {
            event.preventDefault();
            var idsp = document.getElementById('idsp').value;
            var tensp = document.getElementById('tensp').value;
            var giasp = document.getElementById('giasp').value;
            var slsp = document.getElementById('slsp').value;
            var total = document.getElementById('total').value;

            // Tìm dòng được chọn trong bảng tableSelectHD
            var selectedRow = tableSelectHD.querySelector('.selected');

            // Nếu không có dòng nào được chọn, hiển thị cảnh báo và ngăn không cho thêm vào
            if (!selectedRow && idsp === '') {
                alert("Vui lòng chọn một sản phẩm.");
                return;
            }

            // Kiểm tra số lượng nhập vào
            if (slsp === '' || parseInt(slsp) <= 0) {
                alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
                return;
            }

            // Lấy số lượng hiện có của sản phẩm
            var currentQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);

            // Kiểm tra số lượng nhập vào có vượt quá số lượng hiện có không
            if (parseInt(slsp) > currentQuantity) {
                alert("Số lượng sản phẩm nhập vào vượt quá số lượng hiện có.");
                return;
            }

            // Kiểm tra xem idsp đã tồn tại trong bảng chưa
            var existingRow = null;
            var rows = productList.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0 && cells[0].innerText === idsp) {
                    existingRow = rows[i];
                    break;
                }
            }

            if (existingRow) {
                // Nếu idsp đã tồn tại, cập nhật tổng số lượng và tổng tiền
                var currentQuantity = parseInt(existingRow.getElementsByTagName('td')[3].innerText);
                var currentTotal = parseInt(existingRow.getElementsByTagName('td')[4].innerText);

                var newQuantity = currentQuantity + parseInt(slsp);
                var newTotal = currentTotal + parseInt(total);

                existingRow.getElementsByTagName('td')[3].innerText = newQuantity;
                existingRow.getElementsByTagName('td')[4].innerText = newTotal;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity - parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            } else {
                // Nếu idsp chưa tồn tại, thêm hàng mới vào bảng
                var newRow = productList.insertRow();
                newRow.innerHTML = `<td>${idsp}</td><td>${tensp}</td><td>${giasp}</td><td>${slsp}</td><td>${total}</td><td><button onclick="deleteRow(this)">Xóa</button></td>`;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity - parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            }

            // Clear the input fields after adding
            document.getElementById('idsp').value = '';
            document.getElementById('tensp').value = '';
            document.getElementById('giasp').value = '';
            document.getElementById('slsp').value = '';
            document.getElementById('total').value = '';
            selectedRow.classList.remove("selected");
        });
    });
    //update
    document.addEventListener("DOMContentLoaded", function () {
        var addButton = document.getElementById('addButton_update');
        var productList = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];
        var tableSelectHD = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];

        addButton.addEventListener('click', function (event) {
            event.preventDefault();
            var idsp = document.getElementById('idsp_update').value;
            var tensp = document.getElementById('tensp_update').value;
            var giasp = document.getElementById('giasp_update').value;
            var slsp = document.getElementById('slsp_update').value;
            var total = document.getElementById('total_update').value;

            // Tìm dòng được chọn trong bảng tableSelectHD
            var selectedRow = tableSelectHD.querySelector('.selected');

            // Nếu không có dòng nào được chọn, hiển thị cảnh báo và ngăn không cho thêm vào
            if (!selectedRow && idsp === '') {
                alert("Vui lòng chọn một sản phẩm.");
                return;
            }

            // Kiểm tra số lượng nhập vào
            if (slsp === '' || parseInt(slsp) <= 0) {
                alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
                return;
            }

            // Lấy số lượng hiện có của sản phẩm
            var currentQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);

            // Kiểm tra số lượng nhập vào có vượt quá số lượng hiện có không
            if (parseInt(slsp) > currentQuantity) {
                alert("Số lượng sản phẩm nhập vào vượt quá số lượng hiện có.");
                return;
            }

            // Kiểm tra xem idsp đã tồn tại trong bảng chưa
            var existingRow = null;
            var rows = productList.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0 && cells[0].innerText === idsp) {
                    existingRow = rows[i];
                    break;
                }
            }

            if (existingRow) {
                // Nếu idsp đã tồn tại, cập nhật tổng số lượng và tổng tiền
                var currentQuantity = parseInt(existingRow.getElementsByTagName('td')[3].innerText);
                var currentTotal = parseInt(existingRow.getElementsByTagName('td')[4].innerText);

                var newQuantity = currentQuantity + parseInt(slsp);
                var newTotal = currentTotal + parseInt(total);

                existingRow.getElementsByTagName('td')[3].innerText = newQuantity;
                existingRow.getElementsByTagName('td')[4].innerText = newTotal;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity - parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            } else {
                // Nếu idsp chưa tồn tại, thêm hàng mới vào bảng
                var newRow = productList.insertRow();
                newRow.innerHTML = `<td>${idsp}</td><td>${tensp}</td><td>${giasp}</td><td>${slsp}</td><td>${total}</td><td><button onclick="deleteRow_update(this)">Xóa</button></td>`;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity - parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            }

            // Clear the input fields after adding
            document.getElementById('idsp_update').value = '';
            document.getElementById('tensp_update').value = '';
            document.getElementById('giasp_update').value = '';
            document.getElementById('slsp_update').value = '';
            document.getElementById('total_update').value = '';
            selectedRow.classList.remove("selected");
        });
    });
    //update end

    // Sự kiện được gọi khi modal được hiển thị
    $('#addHoaDonModal').on('shown.bs.modal', function () {
        // Lấy thời gian hiện tại
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Thêm số 0 phía trước nếu tháng < 10
        var day = String(now.getDate()).padStart(2, '0'); // Thêm số 0 phía trước nếu ngày < 10
        var currentDate = `${year}-${month}-${day}`;

        // Gán thời gian hiện tại cho trường nhập liệu "Ngày tạo"
        document.getElementById('ngaytao').value = currentDate;
    });

    // Hàm để tính tổng tiền
    function calculateTotal() {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];
        // Lấy tất cả các hàng trong tbody
        var rows = tbody.getElementsByTagName('tr');
        // Khởi tạo biến để tính tổng
        var total = 0;

        // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
        for (var i = 0; i < rows.length; i++) {
            // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
            var cell = rows[i].getElementsByTagName('td')[4];
            // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
            total += parseInt(cell.innerText);
        }

        // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
        document.getElementById('totalAll').value = total;
    }

    // Hàm để xóa hàng và cập nhật tổng tiền và số lượng đã chọn
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        var productId = row.getElementsByTagName('td')[0].innerText;

        // Lấy số lượng đã xóa
        var deletedQuantity = parseInt(row.getElementsByTagName('td')[3].innerText);

        // Xóa hàng
        row.parentNode.removeChild(row);

        // Cập nhật số lượng đã chọn
        var tableSelectHD = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];
        var selectedRow = null;
        var rows = tableSelectHD.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].getElementsByTagName('td')[0];
            if (idCell.innerText === productId) {
                selectedRow = rows[i];
                break;
            }
        }

        if (selectedRow) {
            // Lấy số lượng đã chọn
            var currentSelectedQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
            // Cập nhật số lượng đã chọn
            selectedRow.getElementsByTagName('td')[3].innerText = currentSelectedQuantity + deletedQuantity;
        }

        // Tính lại tổng tiền
        calculateTotal();
    }

    // Hàm để tính tổng tiền
    function calculateTotal_update() {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];
        // Lấy tất cả các hàng trong tbody
        var rows = tbody.getElementsByTagName('tr');
        // Khởi tạo biến để tính tổng
        var total = 0;

        // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
        for (var i = 0; i < rows.length; i++) {
            // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
            var cell = rows[i].getElementsByTagName('td')[4];
            // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
            total += parseInt(cell.innerText);
        }

        // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
        document.getElementById('totalAllupdate').value = total;
    }

    // Hàm để xóa hàng và cập nhật tổng tiền và số lượng đã chọn
    function deleteRow_update(btn) {
        var row = btn.parentNode.parentNode;
        var productId = row.getElementsByTagName('td')[0].innerText;

        // Lấy số lượng đã xóa
        var deletedQuantity = parseInt(row.getElementsByTagName('td')[3].innerText);

        // Xóa hàng
        row.parentNode.removeChild(row);

        // Cập nhật số lượng đã chọn
        var tableSelectHD = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];
        var selectedRow = null;
        var rows = tableSelectHD.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].getElementsByTagName('td')[0];
            if (idCell.innerText === productId) {
                selectedRow = rows[i];
                break;
            }
        }

        if (selectedRow) {
            // Lấy số lượng đã chọn
            var currentSelectedQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
            // Cập nhật số lượng đã chọn
            selectedRow.getElementsByTagName('td')[3].innerText = currentSelectedQuantity + deletedQuantity;
        }

        // Tính lại tổng tiền
        calculateTotal_update();
    }

    // Sự kiện được gọi khi modal được hiển thị
    $('#addHoaDonModal').on('shown.bs.modal', function () {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];

        // Sự kiện được gọi khi có một dòng mới được thêm vào bảng
        $('#productList').on('DOMNodeInserted', function () {
            // Lấy tất cả các hàng trong tbody
            var rows = tbody.getElementsByTagName('tr');
            // Khởi tạo biến để tính tổng
            var total = 0;

            // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
            for (var i = 0; i < rows.length; i++) {
                // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
                var cell = rows[i].cells[4];
                // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
                total += parseInt(cell.innerText);
            }

            // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
            document.getElementById('totalAll').value = total;
        });
    });

    // Sự kiện được gọi khi modal được hiển thị
    $('#updateHoaDonModal').on('shown.bs.modal', function () {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];

        // Sự kiện được gọi khi có một dòng mới được thêm vào bảng
        $('#productListupdate').on('DOMNodeInserted', function () {
            // Lấy tất cả các hàng trong tbody
            var rows = tbody.getElementsByTagName('tr');
            // Khởi tạo biến để tính tổng
            var total = 0;

            // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
            for (var i = 0; i < rows.length; i++) {
                total += parseInt(rows[i].cells[4].innerText);
            }

            // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
            document.getElementById('totalAllupdate').value = total;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var searchInput = document.querySelector('.form-control-dark');
        var rows = document.querySelectorAll('#tableSelectHD tbody tr');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.trim().toLowerCase();

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                // Lặp qua tất cả các ô trong mỗi hàng và kiểm tra nội dung của chúng
                for (var i = 0; i < cells.length; i++) {
                    var cellContent = cells[i].textContent.toLowerCase();
                    if (cellContent.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                // Nếu hàng chứa từ khóa tìm kiếm, hiển thị nó; ngược lại, ẩn đi
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var searchInput = document.querySelector('.form-control-dark-update');
        var rows = document.querySelectorAll('#tableSelectHD_update tbody tr');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.trim().toLowerCase();

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                // Lặp qua tất cả các ô trong mỗi hàng và kiểm tra nội dung của chúng
                for (var i = 0; i < cells.length; i++) {
                    var cellContent = cells[i].textContent.toLowerCase();
                    if (cellContent.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                // Nếu hàng chứa từ khóa tìm kiếm, hiển thị nó; ngược lại, ẩn đi
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    $(document).ready(function () {
        $('#saveButton').click(function (event) {
            event.preventDefault();
            var namenv = $('#namenv').val();
            var namekh = $('#namekh').val();
            var ngaytao = $('#ngaytao').val();
            var totalAll = parseInt($('#totalAll').val());
            var trangthai = $('#trangthai').val();
            var productList = [];
            var productAfter = [];
            // Truy cập tbody của bảng productList
            var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody.rows.length; i++) {
                var row = tbody.rows[i];
                var rowData = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData.idsp = row.cells[0].innerText;
                rowData.giasp = parseInt(row.cells[2].innerText);
                rowData.slsp = parseInt(row.cells[3].innerText);

                // Thêm dữ liệu hàng vào mảng productList
                productList.push(rowData);
            }

            // Truy cập tbody của bảng productList
            var tbody2 = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody2.rows.length; i++) {
                var row2 = tbody2.rows[i];
                var rowData2 = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData2.idsp = row2.cells[0].innerText;
                rowData2.slsp = parseInt(row2.cells[3].innerText);
                console.log(rowData2.slsp);

                // Thêm dữ liệu hàng vào mảng productList
                productAfter.push(rowData2);
            }

            var data = {
                namenv: namenv,
                namekh: namekh,
                ngaytao: ngaytao,
                totalAll: totalAll,
                trangthai: trangthai,
                productList: productList,
                productAfter: productAfter,
                action: 'them',
            };

            $.ajax({
                type: 'POST',
                url: 'hoadonxuly.php',
                data: data,
                success: function (response) {
                    if (response) {
                        alert("Thêm thành công");
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi lưu hóa đơn.');
                }
            });
        });
    });

    $(document).ready(function () {
        $('#saveButton_update').click(function (event) {
            event.preventDefault();
            var idhd = $('#idhdupdate').val();
            var namenv = $('#namenvupdate').val();
            var namekh = $('#namekhupdate').val();
            var ngaytao = $('#ngaytaoupdate').val();
            var totalAll = parseInt($('#totalAllupdate').val());
            var trangthai = $('#trangthaiupdate').val();
            var productList = [];
            var productAfter = [];
            // Truy cập tbody của bảng productList
            var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody.rows.length; i++) {
                var row = tbody.rows[i];
                var rowData = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData.idsp = row.cells[0].innerText;
                rowData.giasp = parseInt(row.cells[2].innerText);
                rowData.slsp = parseInt(row.cells[3].innerText);

                // Thêm dữ liệu hàng vào mảng productList
                productList.push(rowData);
            }

            var tbody2 = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody2.rows.length; i++) {
                var row2 = tbody2.rows[i];
                var rowData2 = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData2.idsp = row2.cells[0].innerText;
                rowData2.slsp = parseInt(row2.cells[3].innerText);


                productAfter.push(rowData2);
            }

            var data = {
                idhd: idhd,
                namenv: namenv,
                namekh: namekh,
                ngaytao: ngaytao,
                totalAll: totalAll,
                trangthai: trangthai,
                productList: productList,
                productAfter: productAfter,
                action: 'sua',
            };

            $.ajax({
                type: 'POST',
                url: 'hoadonxuly.php',
                data: data,
                success: function (response) {
                    if (response) {
                        alert("Sửa thành công");
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi lưu hóa đơn.');
                }
            });
        });
    });

    document.getElementById('formDeleteHD').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;
        var trangthai = document.getElementById('trangthai').value;

        if (trangthai == 'Đợi xác nhận' || trangthai == 'Xác nhận') {
            $.ajax({
                url: 'hoadonxuly.php', // Đường dẫn tới file xử lý trên server
                type: 'POST',
                data: {
                    recordId: id,
                    action: 'xoa'
                }, // Truyền dữ liệu trực tiếp vào data
                success: function (response) {
                    console.log(response)
                    if (response) {
                        alert("Xóa thành công")
                        location.reload();
                    } else {
                        alert('Error: Unable to delete the record.' + response);
                    }
                }
            });
        } else {
            alert('Đơn hàng đã hoặc đang được giao')
        }
    });
}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('phieunhap')) {
    document.addEventListener("DOMContentLoaded", function () {
        var table = document.getElementById("tableSelectHD");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener("click", function () {
                // Xóa class 'selected' khỏi tất cả các hàng
                for (var j = 0; j < rows.length; j++) {
                    rows[j].classList.remove("selected");
                }
                // Thêm class 'selected' vào hàng hiện tại được click
                this.classList.add("selected");
                // Hiển thị thông tin
                var cells = this.getElementsByTagName("td");
                document.getElementById('idsp').value = cells[0].innerText;
                document.getElementById('tensp').value = cells[1].innerText;
                document.getElementById('giasp').value = cells[2].innerText;
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        var table = document.getElementById("tableSelectHD_update");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener("click", function () {
                // Xóa class 'selected' khỏi tất cả các hàng
                for (var j = 0; j < rows.length; j++) {
                    rows[j].classList.remove("selected");
                }
                // Thêm class 'selected' vào hàng hiện tại được click
                this.classList.add("selected");
                // Hiển thị thông tin
                var cells = this.getElementsByTagName("td");
                document.getElementById('idsp_update').value = cells[0].innerText;
                document.getElementById('tensp_update').value = cells[1].innerText;
                document.getElementById('giasp_update').value = cells[2].innerText;
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        var slspInput = document.getElementById('slsp');
        var giaspInput = document.getElementById('giasp');
        var totalInput = document.getElementById('total');

        var slspInput_update = document.getElementById('slsp_update');
        var giaspInput_update = document.getElementById('giasp_update');
        var totalInput_update = document.getElementById('total_update');

        slspInput.addEventListener('input', function () {
            var slsp = parseInt(slspInput.value) || 0;
            var giasp = parseInt(giaspInput.value) || 0;
            var total = slsp * giasp;
            totalInput.value = total.toFixed(0); // Làm tròn đến 2 chữ số thập phân
        });

        slspInput_update.addEventListener('input', function () {
            var slsp = parseInt(slspInput_update.value) || 0;
            var giasp = parseInt(giaspInput_update.value) || 0;
            var total = slsp * giasp;
            totalInput_update.value = total.toFixed(0); // Làm tròn đến 2 chữ số thập phân
        });
    });
    //add
    document.addEventListener("DOMContentLoaded", function () {
        var addButton = document.getElementById('addButton');
        var productList = document.getElementById('productList').getElementsByTagName('tbody')[0];
        var tableSelectHD = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];

        addButton.addEventListener('click', function (event) {
            event.preventDefault();
            var idsp = document.getElementById('idsp').value;
            var tensp = document.getElementById('tensp').value;
            var giasp = document.getElementById('giasp').value;
            var slsp = document.getElementById('slsp').value;
            var total = document.getElementById('total').value;

            // Tìm dòng được chọn trong bảng tableSelectHD
            var selectedRow = tableSelectHD.querySelector('.selected');

            // Nếu không có dòng nào được chọn, hiển thị cảnh báo và ngăn không cho thêm vào
            if (!selectedRow && idsp === '') {
                alert("Vui lòng chọn một sản phẩm.");
                return;
            }

            // Kiểm tra số lượng nhập vào
            if (slsp === '' || parseInt(slsp) <= 0) {
                alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
                return;
            }

            // Lấy số lượng hiện có của sản phẩm
            var currentQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);

            // Kiểm tra xem idsp đã tồn tại trong bảng chưa
            var existingRow = null;
            var rows = productList.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0 && cells[0].innerText === idsp) {
                    existingRow = rows[i];
                    break;
                }
            }

            if (existingRow) {
                // Nếu idsp đã tồn tại, cập nhật tổng số lượng và tổng tiền
                var currentQuantity = parseInt(existingRow.getElementsByTagName('td')[3].innerText);
                var currentTotal = parseInt(existingRow.getElementsByTagName('td')[4].innerText);

                var newQuantity = currentQuantity + parseInt(slsp);
                var newTotal = currentTotal + parseInt(total);

                existingRow.getElementsByTagName('td')[3].innerText = newQuantity;
                existingRow.getElementsByTagName('td')[4].innerText = newTotal;

                // Tăng số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity + parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            } else {
                // Nếu idsp chưa tồn tại, thêm hàng mới vào bảng
                var newRow = productList.insertRow();
                newRow.innerHTML = `<td>${idsp}</td><td>${tensp}</td><td>${giasp}</td><td>${slsp}</td><td>${total}</td><td><button onclick="deleteRow(this)">Xóa</button></td>`;

                // Tăng số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity + parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            }

            // Clear the input fields after adding
            document.getElementById('idsp').value = '';
            document.getElementById('tensp').value = '';
            document.getElementById('giasp').value = '';
            document.getElementById('slsp').value = '';
            document.getElementById('total').value = '';
            selectedRow.classList.remove("selected");
        });
    });
    //update
    document.addEventListener("DOMContentLoaded", function () {
        var addButton = document.getElementById('addButton_update');
        var productList = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];
        var tableSelectHD = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];

        addButton.addEventListener('click', function (event) {
            event.preventDefault();
            var idsp = document.getElementById('idsp_update').value;
            var tensp = document.getElementById('tensp_update').value;
            var giasp = document.getElementById('giasp_update').value;
            var slsp = document.getElementById('slsp_update').value;
            var total = document.getElementById('total_update').value;

            // Tìm dòng được chọn trong bảng tableSelectHD
            var selectedRow = tableSelectHD.querySelector('.selected');

            // Nếu không có dòng nào được chọn, hiển thị cảnh báo và ngăn không cho thêm vào
            if (!selectedRow && idsp === '') {
                alert("Vui lòng chọn một sản phẩm.");
                return;
            }

            // Kiểm tra số lượng nhập vào
            if (slsp === '' || parseInt(slsp) <= 0) {
                alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
                return;
            }

            // Lấy số lượng hiện có của sản phẩm
            var currentQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);

            // Kiểm tra số lượng nhập vào có vượt quá số lượng hiện có không
            if (parseInt(slsp) > currentQuantity) {
                alert("Số lượng sản phẩm nhập vào vượt quá số lượng hiện có.");
                return;
            }

            // Kiểm tra xem idsp đã tồn tại trong bảng chưa
            var existingRow = null;
            var rows = productList.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0 && cells[0].innerText === idsp) {
                    existingRow = rows[i];
                    break;
                }
            }

            if (existingRow) {
                // Nếu idsp đã tồn tại, cập nhật tổng số lượng và tổng tiền
                var currentQuantity = parseInt(existingRow.getElementsByTagName('td')[3].innerText);
                var currentTotal = parseInt(existingRow.getElementsByTagName('td')[4].innerText);

                var newQuantity = currentQuantity + parseInt(slsp);
                var newTotal = currentTotal + parseInt(total);

                existingRow.getElementsByTagName('td')[3].innerText = newQuantity;
                existingRow.getElementsByTagName('td')[4].innerText = newTotal;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity + parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            } else {
                // Nếu idsp chưa tồn tại, thêm hàng mới vào bảng
                var newRow = productList.insertRow();
                newRow.innerHTML = `<td>${idsp}</td><td>${tensp}</td><td>${giasp}</td><td>${slsp}</td><td>${total}</td><td><button onclick="deleteRow_update(this)">Xóa</button></td>`;

                // Giảm số lượng tương ứng trong tableSelectHD
                var currentSelectQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
                var newSelectQuantity = currentSelectQuantity + parseInt(slsp);
                selectedRow.getElementsByTagName('td')[3].innerText = newSelectQuantity;
            }

            // Clear the input fields after adding
            document.getElementById('idsp_update').value = '';
            document.getElementById('tensp_update').value = '';
            document.getElementById('giasp_update').value = '';
            document.getElementById('slsp_update').value = '';
            document.getElementById('total_update').value = '';
            selectedRow.classList.remove("selected");
        });
    });
    //update end

    // Sự kiện được gọi khi modal được hiển thị
    $('#addPhieuNhapModal').on('shown.bs.modal', function () {
        // Lấy thời gian hiện tại
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Thêm số 0 phía trước nếu tháng < 10
        var day = String(now.getDate()).padStart(2, '0'); // Thêm số 0 phía trước nếu ngày < 10
        var currentDate = `${year}-${month}-${day}`;

        // Gán thời gian hiện tại cho trường nhập liệu "Ngày tạo"
        document.getElementById('ngaytao').value = currentDate;
    });

    // Hàm để tính tổng tiền
    function calculateTotal() {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];
        // Lấy tất cả các hàng trong tbody
        var rows = tbody.getElementsByTagName('tr');
        // Khởi tạo biến để tính tổng
        var total = 0;

        // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
        for (var i = 0; i < rows.length; i++) {
            // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
            var cell = rows[i].getElementsByTagName('td')[4];
            // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
            total += parseInt(cell.innerText);
        }

        // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
        document.getElementById('totalAll').value = total;
    }

    // Hàm để xóa hàng và cập nhật tổng tiền và số lượng đã chọn
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        var productId = row.getElementsByTagName('td')[0].innerText;

        // Lấy số lượng đã xóa
        var deletedQuantity = parseInt(row.getElementsByTagName('td')[3].innerText);

        // Xóa hàng
        row.parentNode.removeChild(row);

        // Cập nhật số lượng đã chọn
        var tableSelectHD = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];
        var selectedRow = null;
        var rows = tableSelectHD.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].getElementsByTagName('td')[0];
            if (idCell.innerText === productId) {
                selectedRow = rows[i];
                break;
            }
        }

        if (selectedRow) {
            // Lấy số lượng đã chọn
            var currentSelectedQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
            // Cập nhật số lượng đã chọn
            selectedRow.getElementsByTagName('td')[3].innerText = currentSelectedQuantity - deletedQuantity;
        }

        // Tính lại tổng tiền
        calculateTotal();
    }

    // Hàm để tính tổng tiền
    function calculateTotal_update() {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];
        // Lấy tất cả các hàng trong tbody
        var rows = tbody.getElementsByTagName('tr');
        // Khởi tạo biến để tính tổng
        var total = 0;

        // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
        for (var i = 0; i < rows.length; i++) {
            // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
            var cell = rows[i].getElementsByTagName('td')[4];
            // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
            total += parseInt(cell.innerText);
        }

        // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
        document.getElementById('totalAllupdate').value = total;
    }

    // Hàm để xóa hàng và cập nhật tổng tiền và số lượng đã chọn
    function deleteRow_update(btn) {
        var row = btn.parentNode.parentNode;
        var productId = row.getElementsByTagName('td')[0].innerText;

        // Lấy số lượng đã xóa
        var deletedQuantity = parseInt(row.getElementsByTagName('td')[3].innerText);

        // Xóa hàng
        row.parentNode.removeChild(row);

        // Cập nhật số lượng đã chọn
        var tableSelectHD = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];
        var selectedRow = null;
        var rows = tableSelectHD.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].getElementsByTagName('td')[0];
            if (idCell.innerText === productId) {
                selectedRow = rows[i];
                break;
            }
        }

        if (selectedRow) {
            // Lấy số lượng đã chọn
            var currentSelectedQuantity = parseInt(selectedRow.getElementsByTagName('td')[3].innerText);
            // Cập nhật số lượng đã chọn
            selectedRow.getElementsByTagName('td')[3].innerText = currentSelectedQuantity - deletedQuantity;
        }

        // Tính lại tổng tiền
        calculateTotal_update();
    }

    // Sự kiện được gọi khi modal được hiển thị
    $('#addPhieuNhapModal').on('shown.bs.modal', function () {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];

        // Sự kiện được gọi khi có một dòng mới được thêm vào bảng
        $('#productList').on('DOMNodeInserted', function () {
            // Lấy tất cả các hàng trong tbody
            var rows = tbody.getElementsByTagName('tr');
            // Khởi tạo biến để tính tổng
            var total = 0;

            // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
            for (var i = 0; i < rows.length; i++) {
                // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
                var cell = rows[i].cells[4];
                // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
                total += parseInt(cell.innerText);
            }

            // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
            document.getElementById('totalAll').value = total;
        });
    });

    // Sự kiện được gọi khi modal được hiển thị
    $('#updatePhieuNhapModal').on('shown.bs.modal', function () {
        // Lấy tbody của bảng sản phẩm
        var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];

        // Sự kiện được gọi khi có một dòng mới được thêm vào bảng
        $('#productListupdate').on('DOMNodeInserted', function () {
            // Lấy tất cả các hàng trong tbody
            var rows = tbody.getElementsByTagName('tr');
            // Khởi tạo biến để tính tổng
            var total = 0;

            // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
            for (var i = 0; i < rows.length; i++) {
                total += parseInt(rows[i].cells[4].innerText);
            }

            // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
            document.getElementById('totalAllupdate').value = total;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var searchInput = document.querySelector('.form-control-dark');
        var rows = document.querySelectorAll('#tableSelectHD tbody tr');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.trim().toLowerCase();

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                // Lặp qua tất cả các ô trong mỗi hàng và kiểm tra nội dung của chúng
                for (var i = 0; i < cells.length; i++) {
                    var cellContent = cells[i].textContent.toLowerCase();
                    if (cellContent.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                // Nếu hàng chứa từ khóa tìm kiếm, hiển thị nó; ngược lại, ẩn đi
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var searchInput = document.querySelector('.form-control-dark-update');
        var rows = document.querySelectorAll('#tableSelectHD_update tbody tr');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.trim().toLowerCase();

            rows.forEach(function (row) {
                var cells = row.getElementsByTagName('td');
                var found = false;

                // Lặp qua tất cả các ô trong mỗi hàng và kiểm tra nội dung của chúng
                for (var i = 0; i < cells.length; i++) {
                    var cellContent = cells[i].textContent.toLowerCase();
                    if (cellContent.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }

                // Nếu hàng chứa từ khóa tìm kiếm, hiển thị nó; ngược lại, ẩn đi
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    $(document).ready(function () {
        $('#saveButton').click(function (event) {
            event.preventDefault();
            var namenv = $('#namenv').val();
            var namekh = $('#namekh').val();
            var ngaytao = $('#ngaytao').val();
            var totalAll = parseInt($('#totalAll').val());
            var productList = [];
            var productAfter = [];
            // Truy cập tbody của bảng productList
            var tbody = document.getElementById('productList').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody.rows.length; i++) {
                var row = tbody.rows[i];
                var rowData = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData.idsp = row.cells[0].innerText;
                rowData.giasp = parseInt(row.cells[2].innerText);
                rowData.slsp = parseInt(row.cells[3].innerText);

                // Thêm dữ liệu hàng vào mảng productList
                productList.push(rowData);
            }

            // Truy cập tbody của bảng productList
            var tbody2 = document.getElementById('tableSelectHD').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody2.rows.length; i++) {
                var row2 = tbody2.rows[i];
                var rowData2 = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData2.idsp = row2.cells[0].innerText;
                rowData2.slsp = parseInt(row2.cells[3].innerText);
                console.log(rowData2.slsp);

                // Thêm dữ liệu hàng vào mảng productList
                productAfter.push(rowData2);
            }

            var data = {
                namenv: namenv,
                namekh: namekh,
                ngaytao: ngaytao,
                totalAll: totalAll,
                productList: productList,
                productAfter: productAfter,
                action: 'them',
            };

            $.ajax({
                type: 'POST',
                url: 'phieunhapxuly.php',
                data: data,
                success: function (response) {
                    if (response) {
                        alert("Thêm thành công");
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi lưu hóa đơn.');
                }
            });
        });
    });

    $(document).ready(function () {
        $('#saveButton_update').click(function (event) {
            event.preventDefault();
            var idhd = $('#idhdupdate').val();
            var namenv = $('#namenvupdate').val();
            var namekh = $('#namekhupdate').val();
            var ngaytao = $('#ngaytaoupdate').val();
            var totalAll = parseInt($('#totalAllupdate').val());
            var productList = [];
            var productAfter = [];
            // Truy cập tbody của bảng productList
            var tbody = document.getElementById('productListupdate').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody.rows.length; i++) {
                var row = tbody.rows[i];
                var rowData = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData.idsp = row.cells[0].innerText;
                rowData.giasp = parseInt(row.cells[2].innerText);
                rowData.slsp = parseInt(row.cells[3].innerText);

                // Thêm dữ liệu hàng vào mảng productList
                productList.push(rowData);
            }

            var tbody2 = document.getElementById('tableSelectHD_update').getElementsByTagName('tbody')[0];

            // Lặp qua các hàng của tbody
            for (var i = 0; i < tbody2.rows.length; i++) {
                var row2 = tbody2.rows[i];
                var rowData2 = {};

                // Lấy giá trị từ mỗi ô của hàng
                rowData2.idsp = row2.cells[0].innerText;
                rowData2.slsp = parseInt(row2.cells[3].innerText);


                productAfter.push(rowData2);
            }

            var data = {
                idhd: idhd,
                namenv: namenv,
                namekh: namekh,
                ngaytao: ngaytao,
                totalAll: totalAll,
                productList: productList,
                productAfter: productAfter,
                action: 'sua',
            };

            $.ajax({
                type: 'POST',
                url: 'phieunhapxuly.php',
                data: data,
                success: function (response) {
                    if (response) {
                        alert("Sửa thành công");
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi lưu hóa đơn.');
                }
            });
        });
    });

    document.getElementById('formDeletePN').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;
        console.log(id);
        $.ajax({
            url: 'phieunhapxuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response) {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.' + response);
                }
            }
        });
    });
}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('nguoidung')) {
    document.getElementById('formAddND').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('floatingValidationID').value;
            var ten = document.getElementById('floatingValidationName').value;
            var sdt = document.getElementById('floatingValidationPN').value;
            var email = document.getElementById('floatingValidationEmail').value;
            if (!validatePhoneNumber(sdt)) {
                alert('Số điện thoại không hợp lệ');
                return;
            }
            var formData = new FormData();
            formData.append('MaND', id);
            formData.append('HoTen', ten);
            formData.append('SoDienThoai', sdt);
            formData.append('Email', email);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nguoidungxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    document.getElementById('formDeleteND').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;

        $.ajax({
            url: 'nguoidungxuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response === 'success') {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.');
                }
            }
        });

    });
    document.getElementById('formUpdateND').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateID').value;
            var ten = document.getElementById('updateName').value;
            var sdt = document.getElementById('updatePN').value;
            var email = document.getElementById('updateEmail').value;
            if (!validatePhoneNumber(sdt)) {
                alert('Số điện thoại không hợp lệ');
                return;
            }

            var formData = new FormData();
            formData.append('MaND', id);
            formData.append('HoTen', ten);
            formData.append('SoDienThoai', sdt);
            formData.append('Email', email);
            formData.append('action', 'sua');// Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nguoidungxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('taikhoan')) {
    document.getElementById('formAddTK').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('floatingValidationID').value;
            var user = document.getElementById('floatingValidationUserName').value;
            var pass = document.getElementById('floatingValidationPW').value;
            var nq = document.getElementById('floatingValidationNQ').value;
            var date = document.getElementById('floatingValidationDate').value;

            var formData = new FormData();
            formData.append('MaTK', id);
            formData.append('Username', user);
            formData.append('Password', pass);
            formData.append('NhomQuyen', nq);
            formData.append('NgayTao', date);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('taikhoanxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    document.getElementById('formDeleteTK').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;

        $.ajax({
            url: 'taikhoanxuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response === 'success') {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.');
                }
            }
        });

    });
    document.getElementById('formUpdateTK').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateId').value;
            var user = document.getElementById('updateND').value;
            var pass = document.getElementById('updatePass').value;
            var nq = document.getElementById('updateNQ').value;


            var formData = new FormData();
            formData.append('MaTK', id);
            formData.append('Username', user);
            formData.append('Password', pass);
            formData.append('NhomQuyen', nq);
            formData.append('action', 'sua');// Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('taikhoanxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    $(document).ready(function () {
        $('#addTaiKhoanModal').on('shown.bs.modal', function () {
            // Lấy thời gian hiện tại
            var now = new Date();
            var year = now.getFullYear();
            var month = String(now.getMonth() + 1).padStart(2, '0'); // Thêm số 0 phía trước nếu tháng < 10
            var day = String(now.getDate()).padStart(2, '0'); // Thêm số 0 phía trước nếu ngày < 10
            var currentDate = `${year}-${month}-${day}`;

            // Gán thời gian hiện tại cho trường nhập liệu "Ngày tạo"
            document.getElementById('floatingValidationDate').value = currentDate;
        });
    });

}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('sanpham')) {
    document.getElementById('chooseFileButtonUpdate').addEventListener('click', function (event) {
        event.preventDefault();
        // Kích hoạt sự kiện click trên phần tử input file ẩn
        document.getElementById('updateFileInput').click();
    });

    // Lắng nghe sự kiện change trên phần tử input file
    document.getElementById('updateFileInput').addEventListener('change', function (event) {
        event.preventDefault();
        // Kiểm tra xem người dùng đã chọn tệp nào chưa
        if (this.files.length > 0) {
            // Lấy tên của tệp đã chọn
            var fileName = this.files[0].name;

            // Hiển thị tên tệp đã chọn
            document.getElementById('updateSelectedFileName').textContent = fileName;

            // Lấy URL của tệp hình ảnh và gán cho phần tử <img>
            var imageURL = URL.createObjectURL(this.files[0]);
            document.getElementById('myImageUpdate').src = imageURL;
            document.getElementById('myImageUpdate').classList.remove('d-none');

            // Hiển thị nút "Xóa"
            document.getElementById('delete-btn-update').classList.remove('d-none');
        } else {
            // Ẩn nút "Xóa" nếu không có tệp nào được chọn
            document.getElementById('delete-btn-update').classList.add('d-none');
        }
    });

    // Lắng nghe sự kiện click trên nút "Xóa"
    document.getElementById('delete-btn-update').addEventListener('click', function (event) {
        event.preventDefault();
        // Xóa đường dẫn hình ảnh của phần tử <img> và ẩn nút "Xóa"
        document.getElementById('myImageUpdate').src = '';
        document.getElementById('myImageUpdate').classList.add('d-none');
        this.classList.add('d-none');

        // Đặt lại giá trị của phần tử input file
        document.getElementById('updateFileInput').value = '';
        // Xóa nội dung hiển thị tên tệp đã chọn
        document.getElementById('updateSelectedFileName').textContent = '';
    });

    //add start
    document.getElementById('chooseFileButton').addEventListener('click', function (event) {
        event.preventDefault();
        // Kích hoạt sự kiện click trên phần tử input file ẩn
        document.getElementById('fileInput').click();
    });

    // Lắng nghe sự kiện change trên phần tử input file
    document.getElementById('fileInput').addEventListener('change', function (event) {
        event.preventDefault();
        // Kiểm tra xem người dùng đã chọn tệp nào chưa
        if (this.files.length > 0) {
            // Lấy tên của tệp đã chọn
            var fileName = this.files[0].name;

            // Hiển thị tên tệp đã chọn
            document.getElementById('selectedFileName').textContent = fileName;

            // Lấy URL của tệp hình ảnh và gán cho phần tử <img>
            var imageURL = URL.createObjectURL(this.files[0]);
            document.getElementById('myImage').src = imageURL;
            document.getElementById('myImage').classList.remove('d-none');

            // Hiển thị nút "Xóa"
            document.getElementById('delete-btn').classList.remove('d-none');
        } else {
            // Ẩn nút "Xóa" nếu không có tệp nào được chọn
            document.getElementById('delete-btn').classList.add('d-none');
        }
    });

    // Lắng nghe sự kiện click trên nút "Xóa"
    document.getElementById('delete-btn').addEventListener('click', function (event) {
        event.preventDefault();
        // Xóa đường dẫn hình ảnh của phần tử <img> và ẩn nút "Xóa"
        document.getElementById('myImage').src = '';
        document.getElementById('myImage').classList.add('d-none');
        this.classList.add('d-none');

        // Đặt lại giá trị của phần tử input file
        document.getElementById('fileInput').value = '';
        // Xóa nội dung hiển thị tên tệp đã chọn
        document.getElementById('selectedFileName').textContent = '';
    });
    //add end

    document.getElementById('formAddSP').addEventListener('submit', function (event) {
        event.preventDefault();
        var form = this;
        //if (this.checkValidity()) {
        if (form.checkValidity()) {
            var id = document.getElementById('floatingValidationID').value;
            var ten = document.getElementById('floatingValidationName').value;
            var gia = document.getElementById('floatingValidationGia').value;
            var tl = document.getElementById('floatingValidationTheLoai').value;
            var hinhanh = document.getElementById('fileInput').value;

            const parts = hinhanh.split("\\");
            const fileName = parts[parts.length - 1];
            console.log(fileName);

            if (!fileName.toLowerCase().endsWith('.jpg')) {
                alert('Tệp không có định dạng JPG.');
                return;
            }

            var formData = new FormData();
            formData.append('MaSP', id);
            formData.append('TenSP', ten);
            formData.append('DonGia', gia);
            formData.append('TheLoai', tl);
            formData.append('HinhAnh', fileName);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('sanphamxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        else {
            alert('Vui lòng nhập tất cả các trường')
        }
    });

    document.getElementById('formDeleteSP').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường

        var id = document.getElementById('recordId').value;

        $.ajax({
            url: 'sanphamxuly.php', // Đường dẫn tới file xử lý trên server
            type: 'POST',
            data: {
                recordId: id,
                action: 'xoa'
            }, // Truyền dữ liệu trực tiếp vào data
            success: function (response) {
                console.log(response)
                if (response === 'success') {
                    alert("Xóa thành công")
                    location.reload();
                } else {
                    alert('Error: Unable to delete the record.');
                }
            }
        });

    });
    document.getElementById('formUpdateSP').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateId').value;
            var ten = document.getElementById('updateName').value;
            var gia = document.getElementById('updateGia').value;
            var tl = document.getElementById('updateTheLoai').value;
            var hinhanh = document.getElementById('updateSelectedFileName').textContent;

            console.log('id ' + id);
            console.log('ten ' + ten);
            console.log('gia ' + gia);
            console.log('tl ' + tl);
            console.log('hinhanh ' + hinhanh);

            var formData = new FormData();
            formData.append('MaSP', id);
            formData.append('TenSP', ten);
            formData.append('DonGia', gia);
            formData.append('TheLoai', tl);
            formData.append('HinhAnh', hinhanh);
            formData.append('action', 'sua');// Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('sanphamxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}
if (urlParams.has('nhomquyen')) {
    document.getElementById('formAddNQ').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('idnq').value;
            var ten = document.getElementById('tennq').value;

            // Lấy tất cả các phần tử input là checkbox trong biểu mẫu
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Mảng để lưu trữ các giá trị của checkbox được chọn
            var selectedValues = [];

            // Lặp qua tất cả các checkbox được chọn và lấy giá trị của chúng
            checkboxes.forEach(function (checkbox) {
                selectedValues.push(checkbox.id);
            });
            console.log('id : ' + selectedValues)
            var chitietquyen = [];
            selectedValues.forEach(function (value) {
                switch (value) {
                    case 'cbXemTK'://1
                        chitietquyen.push({ idcn: 1, hd: 'Xem' })
                        break;
                    case 'cbThemTK':
                        chitietquyen.push({ idcn: 1, hd: 'Thêm' })
                        break;
                    case 'cbSuaTK':
                        chitietquyen.push({ idcn: 1, hd: 'Sửa' })
                        break;
                    case 'cbXoaTK':
                        chitietquyen.push({ idcn: 1, hd: 'Xóa' })
                        break;
                    case 'cbXemNQ'://2
                        chitietquyen.push({ idcn: 2, hd: 'Xem' })
                        break;
                    case 'cbThemNQ':
                        chitietquyen.push({ idcn: 2, hd: 'Thêm' })
                        break;
                    case 'cbSuaNQ':
                        chitietquyen.push({ idcn: 2, hd: 'Sửa' })
                        break;
                    case 'cbXoaNQ':
                        chitietquyen.push({ idcn: 2, hd: 'Xóa' })
                        break;
                    case 'cbXemSP'://3
                        chitietquyen.push({ idcn: 3, hd: 'Xem' })
                        break;
                    case 'cbThemSP':
                        chitietquyen.push({ idcn: 3, hd: 'Thêm' })
                        break;
                    case 'cbSuaSP':
                        chitietquyen.push({ idcn: 3, hd: 'Sửa' })
                        break;
                    case 'cbXoaSP':
                        chitietquyen.push({ idcn: 3, hd: 'Xóa' })
                        break;
                    case 'cbXemPN'://4
                        chitietquyen.push({ idcn: 4, hd: 'Xem' })
                        break;
                    case 'cbThemPN':
                        chitietquyen.push({ idcn: 4, hd: 'Thêm' })
                        break;
                    case 'cbSuaPN':
                        chitietquyen.push({ idcn: 4, hd: 'Sửa' })
                        break;
                    case 'cbXoaPN':
                        chitietquyen.push({ idcn: 4, hd: 'Xóa' })
                        break;
                    case 'cbXemHD'://5
                        chitietquyen.push({ idcn: 5, hd: 'Xem' })
                        break;
                    case 'cbThemHD':
                        chitietquyen.push({ idcn: 5, hd: 'Thêm' })
                        break;
                    case 'cbSuaHD':
                        chitietquyen.push({ idcn: 5, hd: 'Sửa' })
                        break;
                    case 'cbXoaHD':
                        chitietquyen.push({ idcn: 5, hd: 'Xóa' })
                        break;
                    case 'cbXemNCC'://6
                        chitietquyen.push({ idcn: 6, hd: 'Xem' })
                        break;
                    case 'cbThemNCC':
                        chitietquyen.push({ idcn: 6, hd: 'Thêm' })
                        break;
                    case 'cbSuaNCC':
                        chitietquyen.push({ idcn: 6, hd: 'Sửa' })
                        break;
                    case 'cbXoaNCC':
                        chitietquyen.push({ idcn: 6, hd: 'Xóa' })
                        break;
                    case 'cbXemND'://7
                        chitietquyen.push({ idcn: 7, hd: 'Xem' })
                        break;
                    case 'cbThemND':
                        chitietquyen.push({ idcn: 7, hd: 'Thêm' })
                        break;
                    case 'cbSuaND':
                        chitietquyen.push({ idcn: 7, hd: 'Sửa' })
                        break;
                    case 'cbXoaND':
                        chitietquyen.push({ idcn: 7, hd: 'Xóa' })
                        break;
                    case 'cbXemTL'://8
                        chitietquyen.push({ idcn: 8, hd: 'Xem' })
                        break;
                    case 'cbThemTL':
                        chitietquyen.push({ idcn: 8, hd: 'Thêm' })
                        break;
                    case 'cbSuaTL':
                        chitietquyen.push({ idcn: 8, hd: 'Sửa' })
                        break;
                    case 'cbXoaTL':
                        chitietquyen.push({ idcn: 8, hd: 'Xóa' })
                        break;
                    case 'cbXemTKe':
                        chitietquyen.push({ idcn: 9, hd: 'Xem' })
                        break;
                    default:
                }
            });

            // Hiển thị các giá trị đã được chọn trong console
            var jsonString = JSON.stringify(chitietquyen);

            var formData = new FormData();
            formData.append('MaNQ', id);
            formData.append('TenNQ', ten);
            formData.append('chitietquyen', jsonString);
            formData.append('action', 'them'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nhomquyenxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Thêm thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
    
        document.getElementById('formDeleteNQ').addEventListener('submit', function (event) {
            event.preventDefault(); // Ngăn chặn gửi yêu cầu POST thông thường
    
            var id = document.getElementById('recordId').value;
    
            $.ajax({
                url: 'nhomquyenxuly.php', // Đường dẫn tới file xử lý trên server
                type: 'POST',
                data: {
                    recordId: id,
                    action: 'xoa'
                }, // Truyền dữ liệu trực tiếp vào data
                success: function (response) {
                    console.log(response)
                    if (response) {
                        alert("Xóa thành công")
                        location.reload();
                    } else {
                        alert('Error: Unable to delete the record.');
                    }
                }
            });
    
        });

    document.getElementById('formUpdateNQ').addEventListener('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity()) {
            var id = document.getElementById('updateId').value;
            var ten = document.getElementById('updateName').value;

            // Lấy tất cả các phần tử input là checkbox trong biểu mẫu
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Mảng để lưu trữ các giá trị của checkbox được chọn
            var selectedValues = [];

            // Lặp qua tất cả các checkbox được chọn và lấy giá trị của chúng
            checkboxes.forEach(function (checkbox) {
                selectedValues.push(checkbox.id);
            });
            console.log('id : ' + selectedValues)
            var chitietquyen = [];
            selectedValues.forEach(function (value) {
                switch (value) {
                    case 'ucbXemTK'://1
                        chitietquyen.push({ idnq: id, idcn: 1, hd: 'Xem' })
                        break;
                    case 'ucbThemTK':
                        chitietquyen.push({ idnq: id, idcn: 1, hd: 'Thêm' })
                        break;
                    case 'ucbSuaTK':
                        chitietquyen.push({ idnq: id, idcn: 1, hd: 'Sửa' })
                        break;
                    case 'ucbXoaTK':
                        chitietquyen.push({ idnq: id, idcn: 1, hd: 'Xóa' })
                        break;
                    case 'ucbXemNQ'://2
                        chitietquyen.push({ idnq: id, idcn: 2, hd: 'Xem' })
                        break;
                    case 'ucbThemNQ':
                        chitietquyen.push({ idnq: id, idcn: 2, hd: 'Thêm' })
                        break;
                    case 'ucbSuaNQ':
                        chitietquyen.push({ idnq: id, idcn: 2, hd: 'Sửa' })
                        break;
                    case 'ucbXoaNQ':
                        chitietquyen.push({ idnq: id, idcn: 2, hd: 'Xóa' })
                        break;
                    case 'ucbXemSP'://3
                        chitietquyen.push({ idnq: id, idcn: 3, hd: 'Xem' })
                        break;
                    case 'ucbThemSP':
                        chitietquyen.push({ idnq: id, idcn: 3, hd: 'Thêm' })
                        break;
                    case 'ucbSuaSP':
                        chitietquyen.push({ idnq: id, idcn: 3, hd: 'Sửa' })
                        break;
                    case 'ucbXoaSP':
                        chitietquyen.push({ idnq: id, idcn: 3, hd: 'Xóa' })
                        break;
                    case 'ucbXemPN'://4
                        chitietquyen.push({ idnq: id, idcn: 4, hd: 'Xem' })
                        break;
                    case 'ucbThemPN':
                        chitietquyen.push({ idnq: id, idcn: 4, hd: 'Thêm' })
                        break;
                    case 'ucbSuaPN':
                        chitietquyen.push({ idnq: id, idcn: 4, hd: 'Sửa' })
                        break;
                    case 'ucbXoaPN':
                        chitietquyen.push({ idnq: id, idcn: 4, hd: 'Xóa' })
                        break;
                    case 'ucbXemHD'://5
                        chitietquyen.push({ idnq: id, idcn: 5, hd: 'Xem' })
                        break;
                    case 'ucbThemHD':
                        chitietquyen.push({ idnq: id, idcn: 5, hd: 'Thêm' })
                        break;
                    case 'ucbSuaHD':
                        chitietquyen.push({ idnq: id, idcn: 5, hd: 'Sửa' })
                        break;
                    case 'ucbXoaHD':
                        chitietquyen.push({ idnq: id, idcn: 5, hd: 'Xóa' })
                        break;
                    case 'ucbXemNCC'://6
                        chitietquyen.push({ idnq: id, idcn: 6, hd: 'Xem' })
                        break;
                    case 'ucbThemNCC':
                        chitietquyen.push({ idnq: id, idcn: 6, hd: 'Thêm' })
                        break;
                    case 'ucbSuaNCC':
                        chitietquyen.push({ idnq: id, idcn: 6, hd: 'Sửa' })
                        break;
                    case 'ucbXoaNCC':
                        chitietquyen.push({ idnq: id, idcn: 6, hd: 'Xóa' })
                        break;
                    case 'ucbXemND'://7
                        chitietquyen.push({ idnq: id, idcn: 7, hd: 'Xem' })
                        break;
                    case 'ucbThemND':
                        chitietquyen.push({ idnq: id, idcn: 7, hd: 'Thêm' })
                        break;
                    case 'ucbSuaND':
                        chitietquyen.push({ idnq: id, idcn: 7, hd: 'Sửa' })
                        break;
                    case 'ucbXoaND':
                        chitietquyen.push({ idnq: id, idcn: 7, hd: 'Xóa' })
                        break;
                    case 'ucbXemTL'://8
                        chitietquyen.push({ idnq: id, idcn: 8, hd: 'Xem' })
                        break;
                    case 'ucbThemTL':
                        chitietquyen.push({ idnq: id, idcn: 8, hd: 'Thêm' })
                        break;
                    case 'ucbSuaTL':
                        chitietquyen.push({ idnq: id, idcn: 8, hd: 'Sửa' })
                        break;
                    case 'ucbXoaTL':
                        chitietquyen.push({ idnq: id, idcn: 8, hd: 'Xóa' })
                        break;
                    case 'ucbXemTKe':
                        chitietquyen.push({ idnq: id, idcn: 9, hd: 'Xem' })
                        break;
                    default:
                }
            });

            // Hiển thị các giá trị đã được chọn trong console
            var jsonString = JSON.stringify(chitietquyen);

            var formData = new FormData();
            formData.append('MaNQ', id);
            formData.append('TenNQ', ten);
            formData.append('chitietquyen', jsonString);
            formData.append('action', 'sua'); // Thêm hành động 'them' vào dữ liệu gửi đi

            fetch('nhomquyenxuly.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data == true) {
                        alert('Sửa thành công');
                        location.reload();
                    } else {
                        console.log(data);
                        alert(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    })
}


