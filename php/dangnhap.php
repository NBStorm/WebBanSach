<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <h1>Đăng nhập</h1>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Đăng nhập">
    </form>
    <script>
        $(document).ready(function () {
            $('form').submit(function (e) {
                e.preventDefault();

                var formData = $(this).serialize();
                
                $.ajax({
                    type: "POST",
                    url: "sign-in-process.php", // Thay thế bằng URL xử lý đăng nhập
                    data: formData,
                    success: function (response) {
                        var parsedResponse = JSON.parse(response);
                        if (parsedResponse.status === "2") {
                            alert("Đăng nhập thành công");
                            // Chuyển hướng người dùng đến trang index.php
                            window.location.href = parsedResponse.redirect;
                        }else if(parsedResponse.status === "1"){
                            alert("Đăng nhập thành công");
                            // Chuyển hướng người dùng đến trang admin.php
                            window.location.href = parsedResponse.redirect;
                        } 
                        else {
                            // Hiển thị thông báo lỗi
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>