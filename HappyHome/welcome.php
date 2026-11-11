<?php
// welcome.php
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HappyHome - Quản lý nhà trọ</title>

    <!-- Kết nối file CSS -->
    <link rel="stylesheet" href="assets/css/welcome.css">
</head>

<body>

    <!-- BÊN TRÁI -->
    <div class="left">

        <div class="logo">
            Happy<span>Home.</span>
        </div>

        <h1>
            Quản lý nhà trọ<br>
            dễ dàng hơn!
        </h1>

        <p>
            HappyHome mang đến giải pháp quản lý nhà trọ
            toàn diện, giúp kết nối quản lý, nhân viên
            và khách hàng trên cùng một hệ thống.
        </p>

        <div class="features">
            <p>✓ Quản lý phòng trọ</p>
            <p>✓ Theo dõi hợp đồng và thanh toán</p>
            <p>✓ Quản lý nhân viên và công việc</p>
            <p>✓ Theo dõi doanh thu và chi phí</p>
        </div>

    </div>


    <!-- BÊN PHẢI -->
    <div class="right">

        <div class="login-box">

            <h2>Chào mừng trở lại!</h2>

            <p class="subtitle">
                Đăng nhập để tiếp tục sử dụng HappyHome.
            </p>

            <form action="auth/login.php" method="POST">

                <p class="role-title">Bạn là:</p>

                <div class="roles">

                   <label>
    <input type="radio" name="vai_tro" value="QuanLy" checked>
    Quản lý
</label>

<label>
    <input type="radio" name="vai_tro" value="NhanVien">
    Nhân viên
</label>

<label>
    <input type="radio" name="vai_tro" value="KhachThue">
    Khách hàng
</label>
                </div>


                <!-- TÊN ĐĂNG NHẬP -->
                <div class="input-group">

                    <label>Tên đăng nhập</label>

                    <input type="text"
                           name="ten_dang_nhap"
                           placeholder="Nhập tên đăng nhập"
                           required>

                </div>


                <!-- MẬT KHẨU -->
                <div class="input-group">

                    <label>Mật khẩu</label>

                    <input type="password"
                           name="mat_khau"
                           placeholder="Nhập mật khẩu"
                           required>

                </div>


                <button type="submit" class="btn-login">
                    Đăng nhập
                </button>

            </form>


<div class="register">
    Chưa có tài khoản?
    <p>Vui lòng liên hệ Quản lý để được cấp tài khoản.</p>
</div>

        </div>

    </div>

</body>

</html>