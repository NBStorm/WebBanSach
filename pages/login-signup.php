<div class="modal" id="modalLoginSignup">
    <div class="wrapper">
        <div class="form signup">
            <header>Signup</header>
            <form id="signupForm" action="#" style="margin-top:10px">
                <input style="height:40px" type="text" placeholder="Username" required />
                <input style="height:40px" type="text" placeholder="Họ tên" required />
                <input style="height:40px" type="text" placeholder="Số điện thoại" required />
                <input style="height:40px" type="email" placeholder="Email" required />
                <input style="height:40px" type="password" placeholder="Password" required />
                <input style="height:40px" type="hidden" id="ngay" name="ngay" placeholder="Ngày" />

                <input style="height:40px" type="submit" value="Signup" />
            </form>
        </div>
        <div class="form login">
            <header>Login</header>
            <form id="loginForm" action="#" style="margin-top:10px">
                <input style="height:40px" type="text" placeholder="Username" id='username' required />
                <input style="height:40px" type="password" placeholder="Password" id='password' required />

                <input style="height:40px" type="submit" value="Login" />
            </form>
        </div>
    </div>
    <script>
        const wrapper = document.querySelector(".wrapper"),
            signupHeader = document.querySelector(".signup header"),
            loginHeader = document.querySelector(".login header");
        loginHeader.addEventListener("click", () => {
            wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
            wrapper.classList.remove("active");
        });
        let modal = document.getElementById('modalLoginSignup');
        //mở modal
        function addModalLoginSignup() {
            modal.style.display = "flex";
        }
        //đóng modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#signupForm').submit(function (event) {
                // Ngăn chặn việc gửi biểu mẫu một cách thông thường
                event.preventDefault();

                // Thu thập dữ liệu từ biểu mẫu
                var formData = {
                    username: $('input[type="text"][placeholder="Username"]').val(),
                    fullName: $('input[type="text"][placeholder="Họ tên"]').val(),
                    phone: $('input[type="text"][placeholder="Số điện thoại"]').val(),
                    email: $('input[type="email"][placeholder="Email"]').val(),
                    password: $('input[type="password"][placeholder="Password"]').val(),
                    date: $('input[type="hidden"][placeholder="Ngày"]').val(),
                    action: 'signup'
                };

                // Gửi dữ liệu qua AJAX
                $.ajax({
                    type: 'POST',
                    url: './admin/process_signuplogin.php', // Thay đổi đường dẫn tới tập tin xử lý form của bạn
                    data: formData,
                    success: function (response) {
                        if (response) {
                            alert('Đăng ký thành công');
                            wrapper.classList.add("active");
                        } else {
                            alert(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                // Ngăn chặn việc gửi biểu mẫu một cách thông thường
                event.preventDefault();

                // Thu thập dữ liệu từ biểu mẫu
                var formData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    action: 'login'
                };

                // Gửi dữ liệu qua AJAX
                $.ajax({
                    type: 'POST',
                    url: './admin/process_signuplogin.php', // Thay đổi đường dẫn tới tập tin xử lý form của bạn
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response) {
                        
                            $.each(response, function (index, item) {
                                // Sử dụng dữ liệu từ mảng để thực hiện các hành động tương ứng
                                if (item.trangthai) {
                                    alert('Đăng nhập thành công <?php 
                                        if(isset($_SESSION['Username'])){echo $_SESSION['Username'];}?>' );
                                    window.location.href = item.redirect;
                                } else {
                                    alert('Đăng nhập không thành công');
                                }
                            });
                        } else {
                            alert('Đăng nhập không thành công');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("Tài khoản mật khẩu không đúng")
                    }
                });
            });
        });

    </script>
    <script>
        // Tạo một đối tượng ngày hôm nay
        var today = new Date();

        // Lấy ngày, tháng, năm của hôm nay
        var day = today.getDate();
        var month = today.getMonth() + 1; // Lưu ý rằng tháng bắt đầu từ 0
        var year = today.getFullYear();

        // Format lại thành chuỗi "YYYY-MM-DD" để có thể đặt giá trị cho input hidden
        var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);

        // Đặt giá trị cho input hidden
        document.getElementById('ngay').value = formattedDate;
    </script>
</div>