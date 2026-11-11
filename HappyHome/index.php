
<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
}

$tenDangNhap = $_SESSION['ten_dang_nhap'];
$vaiTro = $_SESSION['vaiTro'];

// Khai báo menu theo vai trò
$menu = [];

if ($vaiTro == 'QuanLy') {
    $menu = [
        ["icon" => "🏠", "ten" => "Tổng quan", "link" => "index.php"],
        ["icon" => "🚪", "ten" => "Quản lý phòng", "link" => "pages/phong.php"],
        ["icon" => "👥", "ten" => "Khách thuê", "link" => "pages/khachthue.php"],
        ["icon" => "👨‍💼", "ten" => "Nhân viên", "link" => "pages/nhanvien.php"],
        ["icon" => "📄", "ten" => "Hợp đồng", "link" => "pages/hopdong.php"],
        ["icon" => "🧾", "ten" => "Hóa đơn", "link" => "pages/hoadon.php"],
        ["icon" => "💰", "ten" => "Thu chi", "link" => "pages/thuchi.php"],
        ["icon" => "🛠️", "ten" => "Công việc", "link" => "pages/congviec.php"],
        ["icon" => "📩", "ten" => "Kiến nghị", "link" => "pages/kiennghi.php"]
    ];
} 
elseif ($vaiTro == 'NhanVien') {
    $menu = [
        ["icon" => "🏠", "ten" => "Tổng quan", "link" => "index.php"],
        ["icon" => "🚪", "ten" => "Phòng trọ", "link" => "pages/phong.php"],
        ["icon" => "🛠️", "ten" => "Công việc", "link" => "pages/congviec.php"],
        ["icon" => "📩", "ten" => "Kiến nghị", "link" => "pages/kiennghi.php"]
    ];
} 
elseif ($vaiTro == 'KhachThue') {
    $menu = [
        ["icon" => "🏠", "ten" => "Tổng quan", "link" => "index.php"],
        ["icon" => "📄", "ten" => "Hợp đồng của tôi", "link" => "pages/hopdong.php"],
        ["icon" => "🧾", "ten" => "Hóa đơn của tôi", "link" => "pages/hoadon.php"],
        ["icon" => "📩", "ten" => "Gửi kiến nghị", "link" => "pages/kiennghi.php"]
    ];
}
else {
    session_unset();
    session_destroy();
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHome - Dashboard</title>

    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <div class="container">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="logo">
                Happy<span>Home.</span>
            </div>

            <p class="menu-title">MENU CHÍNH</p>

            <nav>
                <?php foreach ($menu as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>"
                       class="<?php echo $item['link'] == 'index.php' ? 'active' : ''; ?>">

                        <span><?php echo $item['icon']; ?></span>
                        <?php echo htmlspecialchars($item['ten']); ?>

                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="sidebar-bottom">
                <a href="auth/logout.php" class="logout">
                    🚪 Đăng xuất
                </a>
            </div>

        </aside>


        <!-- MAIN CONTENT -->
        <main class="main-content">

            <header class="topbar">
                <div>
                    <h2>Tổng quan</h2>
                    <p>Chào mừng bạn đến với hệ thống HappyHome</p>
                </div>

                <div class="user-info">
                    <div class="avatar">👤</div>

                    <div>
                        <strong>
                            <?php echo htmlspecialchars($tenDangNhap); ?>
                        </strong>

                        <p>
                            <?php
                            if ($vaiTro == 'QuanLy') echo "Quản lý";
                            elseif ($vaiTro == 'NhanVien') echo "Nhân viên";
                            else echo "Khách thuê";
                            ?>
                        </p>
                    </div>
                </div>
            </header>


            <!-- WELCOME -->
            <section class="welcome-banner">
                <div>
                    <h1>Xin chào, <?php echo htmlspecialchars($tenDangNhap); ?>!</h1>
                    <p>Chúc bạn có một ngày làm việc hiệu quả.</p>
                </div>

                <span>🏡</span>
            </section>


            <!-- STATISTICS -->
            <section class="section">
                <h3>Tổng quan hệ thống</h3>

                <div class="dashboard-cards">

                    <?php if ($vaiTro == 'QuanLy'): ?>

                        <div class="card">
                            <span>🏠</span>
                            <h3>Quản lý phòng</h3>
                            <p>Theo dõi tình trạng phòng trọ</p>
                            <a href="pages/phong.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>👥</span>
                            <h3>Khách thuê</h3>
                            <p>Quản lý thông tin khách thuê</p>
                            <a href="pages/khachthue.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>👨‍💼</span>
                            <h3>Nhân viên</h3>
                            <p>Quản lý thông tin nhân viên</p>
                            <a href="pages/nhanvien.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>💰</span>
                            <h3>Thu chi</h3>
                            <p>Theo dõi doanh thu và chi phí</p>
                            <a href="pages/thuchi.php">Truy cập →</a>
                        </div>

                    <?php elseif ($vaiTro == 'NhanVien'): ?>

                        <div class="card">
                            <span>🛠️</span>
                            <h3>Công việc</h3>
                            <p>Xem các công việc được giao</p>
                            <a href="pages/congviec.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>🚪</span>
                            <h3>Phòng trọ</h3>
                            <p>Xem tình trạng phòng</p>
                            <a href="pages/phong.php">Truy cập →</a>
                        </div>

                    <?php else: ?>

                        <div class="card">
                            <span>📄</span>
                            <h3>Hợp đồng</h3>
                            <p>Xem thông tin hợp đồng thuê</p>
                            <a href="pages/hopdong.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>🧾</span>
                            <h3>Hóa đơn</h3>
                            <p>Theo dõi hóa đơn của bạn</p>
                            <a href="pages/hoadon.php">Truy cập →</a>
                        </div>

                        <div class="card">
                            <span>📩</span>
                            <h3>Kiến nghị</h3>
                            <p>Gửi kiến nghị đến quản lý</p>
                            <a href="pages/kiennghi.php">Truy cập →</a>
                        </div>

                    <?php endif; ?>

                </div>
            </section>

            <footer>
                © 2026 HappyHome - Hệ thống quản lý nhà trọ
            </footer>

        </main>

    </div>

</body>
</html>
