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
        if (this.classList.contains('was-validated')) {
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
        if (this.classList.contains('was-validated')) {
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
        if (this.classList.contains('was-validated')) {
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
        if (this.classList.contains('was-validated')) {
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
        var slspInput = document.getElementById('slsp');
        var giaspInput = document.getElementById('giasp');
        var totalInput = document.getElementById('total');

        slspInput.addEventListener('input', function () {
            var slsp = parseInt(slspInput.value) || 0;
            var giasp = parseInt(giaspInput.value) || 0;
            var total = slsp * giasp;
            totalInput.value = total.toFixed(0); // Làm tròn đến 2 chữ số thập phân
        });
    });

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
            if (!selectedRow && idsp==='') {
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
        });
    });


    // Function to delete a row in the table
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

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
            console.log(rows)
            // Lặp qua từng hàng và tính tổng của cột "Tổng tiền"
            for (var i = 0; i < rows.length; i++) {
                // Lấy ô cuối cùng trong hàng, chứa giá trị "Tổng tiền"
                var cell = rows[i].getElementsByTagName('td')[4];
                // Chuyển đổi giá trị từ chuỗi sang số và cộng vào tổng
                total += parseInt(cell.innerText);
            }

            // Gán tổng tính được vào trường nhập liệu "Tổng tiền"
            document.getElementById('totalAll').value = total;
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

    $(document).ready(function () {
        $('#saveButton').click(function (event) {
            event.preventDefault();
            var namenv = $('#namenv').val();
            var namekh = $('#namekh').val();
            var ngaytao = $('#ngaytao').val();
            var totalAll = parseInt($('#totalAll').val());
            var trangthai = $('#trangthai').val();
            var productList = [];

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
            console.log(ngaytao)
            var data = {
                namenv: namenv,
                namekh: namekh,
                ngaytao: ngaytao,
                totalAll: totalAll,
                trangthai: trangthai,
                productList: productList,
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


}










