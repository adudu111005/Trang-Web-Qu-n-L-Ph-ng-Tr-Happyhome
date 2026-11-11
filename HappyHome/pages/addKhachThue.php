
<?php
session_start();

require_once "../config/database.php";

// Kiểm tra đăng nhập và quyền Quản lý
if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['vaiTro'] != 'QuanLy'
) {
    header("Location: ../welcome.php");
    exit();
}

$thongBao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ form
    $tenDangNhap = trim($_POST['ten_dang_nhap']);
    $matKhau = $_POST['mat_khau'];
    $email = trim($_POST['email']);
    $soDienThoai = trim($_POST['so_dien_thoai']);

    $hoTen = trim($_POST['ho_ten']);
    $ngaySinh = $_POST['ngay_sinh'];
    $cccd = trim($_POST['cccd']);
    $diaChi = trim($_POST['dia_chi']);

    // Kiểm tra dữ liệu bắt buộc
    if (
        $tenDangNhap == '' ||
        $matKhau == '' ||
        $hoTen == ''
    ) {
        $thongBao = "Vui lòng nhập đầy đủ thông tin bắt buộc!";
    } else {

        // Mã hóa mật khẩu
        $matKhauHash = password_hash($matKhau, PASSWORD_DEFAULT);

        // Bắt đầu transaction
        $conn->begin_transaction();

        try {

            // 1. Thêm tài khoản
            $sqlTaiKhoan = "INSERT INTO TaiKhoan
                (TenDangNhap, MatKhau, Email, SoDienThoai, VaiTro, TrangThai)
                VALUES (?, ?, ?, ?, 'KhachThue', 'HoatDong')";

            $stmt = $conn->prepare($sqlTaiKhoan);
            $stmt->bind_param(
                "ssss",
                $tenDangNhap,
                $matKhauHash,
                $email,
                $soDienThoai
            );

            $stmt->execute();

            // Lấy mã tài khoản vừa tạo
            $maTaiKhoan = $conn->insert_id;

            // 2. Thêm hồ sơ khách thuê
            $sqlKhachThue = "INSERT INTO KhachThue
                (MaTaiKhoan, HoTen, NgaySinh, CCCD, DiaChi)
                VALUES (?, ?, ?, ?, ?)";

            $stmt2 = $conn->prepare($sqlKhachThue);
            $stmt2->bind_param(
                "issss",
                $maTaiKhoan,
                $hoTen,
                $ngaySinh,
                $cccd,
                $diaChi
            );

            $stmt2->execute();

            // Hoàn tất cả hai thao tác
            $conn->commit();

            $thongBao = "Thêm khách thuê thành công!";

        } catch (Exception $e) {

            // Nếu có lỗi thì hủy cả hai thao tác
            $conn->rollback();

            $thongBao = "Thêm khách thuê thất bại! Có thể tên đăng nhập hoặc CCCD đã tồn tại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách thuê - HappyHome</title>
</head>

<body>

    <h2>THÊM KHÁCH THUÊ</h2>

    <p><?php echo htmlspecialchars($thongBao); ?></p>

    <form method="POST">

        <h3>Thông tin tài khoản</h3>

        <label>Tên đăng nhập:</label><br>
        <input type="text" name="ten_dang_nhap" required>
        <br><br>

        <label>Mật khẩu:</label><br>
        <input type="password" name="mat_khau" required>
        <br><br>

        <label>Email:</label><br>
        <input type="email" name="email">
        <br><br>

        <label>Số điện thoại:</label><br>
        <input type="text" name="so_dien_thoai">
        <br><br>

        <h3>Thông tin khách thuê</h3>

        <label>Họ tên:</label><br>
        <input type="text" name="ho_ten" required>
        <br><br>

        <label>Ngày sinh:</label><br>
        <input type="date" name="ngay_sinh">
        <br><br>

        <label>CCCD:</label><br>
        <input type="text" name="cccd">
        <br><br>

        <label>Địa chỉ:</label><br>
        <textarea name="dia_chi"></textarea>
        <br><br>

        <button type="submit">Thêm khách thuê</button>

    </form>

    <br>

    <a href="../index.php">Quay lại trang chủ</a>

</body>
</html>
