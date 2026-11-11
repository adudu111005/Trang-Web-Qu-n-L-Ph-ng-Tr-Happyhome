
<?php
session_start();

require_once "../config/database.php";

// Chỉ tiếp nhận POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../welcome.php");
    exit();
}

// Lấy dữ liệu
$tenDangNhap = trim($_POST['ten_dang_nhap'] ?? '');
$matKhau = $_POST['mat_khau'] ?? '';
$vaiTro = $_POST['vai_tro'] ?? '';

// Kiểm tra dữ liệu
if ($tenDangNhap == '' || $matKhau == '') {
    die("Vui lòng nhập đầy đủ thông tin!");
}

// Kiểm tra vai trò
if (!in_array($vaiTro, ['QuanLy', 'NhanVien', 'KhachThue'])) {
    die("Vai trò không hợp lệ!");
}

// Tìm tài khoản theo tên đăng nhập
$sql = "SELECT * FROM TaiKhoan WHERE TenDangNhap = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tenDangNhap);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows != 1) {
    die("Tên đăng nhập không tồn tại!");
}

$user = $result->fetch_assoc();

// Kiểm tra vai trò
if ($user['VaiTro'] != $vaiTro) {
    die("Bạn đã chọn sai vai trò đăng nhập!");
}

// Kiểm tra trạng thái
if ($user['TrangThai'] != 'HoatDong') {
    die("Tài khoản của bạn đã bị khóa!");
}

// Hỗ trợ hash chuẩn và chuyển mật khẩu chữ thường cũ sang hash sau khi xác minh.
$matKhauLuu = (string) $user['MatKhau'];
$matKhauHopLe = password_verify($matKhau, $matKhauLuu);

if (!$matKhauHopLe && hash_equals($matKhauLuu, $matKhau)) {
    $matKhauHash = password_hash($matKhau, PASSWORD_DEFAULT);
    $updateStmt = $conn->prepare(
        "UPDATE TaiKhoan SET MatKhau = ? WHERE MaTaiKhoan = ?"
    );
    $updateStmt->bind_param("si", $matKhauHash, $user['MaTaiKhoan']);

    if (!$updateStmt->execute()) {
        die("Không thể cập nhật mật khẩu: " . $updateStmt->error);
    }

    $updateStmt->close();
    $matKhauHopLe = true;
}

if (!$matKhauHopLe) {
    die("Mật khẩu không chính xác!");
}

// Đăng nhập thành công
session_regenerate_id(true);

$_SESSION['user_id'] = $user['MaTaiKhoan'];
$_SESSION['ten_dang_nhap'] = $user['TenDangNhap'];
$_SESSION['vaiTro'] = $user['VaiTro'];

header("Location: ../index.php");
exit();
?>
