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






