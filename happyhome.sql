-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2026 lúc 07:21 AM
-- Phiên bản máy phục vụ: 8.4.7
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `happyhome`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `MaCongViec` int NOT NULL,
  `MaNhanVien` int NOT NULL,
  `MaPhong` int DEFAULT NULL,
  `TenCongViec` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MoTa` text COLLATE utf8mb4_unicode_ci,
  `NgayGiao` datetime DEFAULT CURRENT_TIMESTAMP,
  `HanHoanThanh` datetime DEFAULT NULL,
  `NgayHoanThanh` datetime DEFAULT NULL,
  `TrangThai` enum('ChoXuLy','DangXuLy','HoanThanh','DaHuy') COLLATE utf8mb4_unicode_ci DEFAULT 'ChoXuLy'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `MaDanhGia` int NOT NULL,
  `MaKhachThue` int NOT NULL,
  `SoSao` int NOT NULL,
  `NoiDung` text COLLATE utf8mb4_unicode_ci,
  `NgayDanhGia` datetime DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHoaDon` int NOT NULL,
  `MaHopDong` int NOT NULL,
  `KyThang` date NOT NULL,
  `TienPhong` decimal(15,2) DEFAULT '0.00',
  `TienDien` decimal(15,2) DEFAULT '0.00',
  `TienNuoc` decimal(15,2) DEFAULT '0.00',
  `TienDichVu` decimal(15,2) DEFAULT '0.00',
  `TongTien` decimal(15,2) NOT NULL,
  `NgayTao` datetime DEFAULT CURRENT_TIMESTAMP,
  `HanThanhToan` date DEFAULT NULL,
  `TrangThai` enum('ChuaThanhToan','ThanhToanMotPhan','DaThanhToan') COLLATE utf8mb4_unicode_ci DEFAULT 'ChuaThanhToan'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `MaHopDong` int NOT NULL,
  `MaKhachThue` int NOT NULL,
  `MaPhong` int NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `TienCoc` decimal(15,2) DEFAULT '0.00',
  `GiaThue` decimal(15,2) NOT NULL,
  `TrangThai` enum('ChoDuyet','HieuLuc','HetHan','DaHuy') COLLATE utf8mb4_unicode_ci DEFAULT 'ChoDuyet'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachthue`
--

CREATE TABLE `khachthue` (
  `MaKhachThue` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `HoTen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `CCCD` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kiennghi`
--

CREATE TABLE `kiennghi` (
  `MaKienNghi` int NOT NULL,
  `MaKhachThue` int NOT NULL,
  `TieuDe` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoiDung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayGui` datetime DEFAULT CURRENT_TIMESTAMP,
  `PhanHoi` text COLLATE utf8mb4_unicode_ci,
  `NgayPhanHoi` datetime DEFAULT NULL,
  `TrangThai` enum('ChoXuLy','DangXuLy','DaXuLy','TuChoi') COLLATE utf8mb4_unicode_ci DEFAULT 'ChoXuLy'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `HoTen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LoaiNhanVien` enum('KyThuat','VeSinh') COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayVaoLam` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `MaPhong` int NOT NULL,
  `TenPhong` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LoaiPhong` enum('PhongTro','SleepBox') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DienTich` decimal(6,2) DEFAULT NULL,
  `GiaThue` decimal(15,2) NOT NULL,
  `MoTa` text COLLATE utf8mb4_unicode_ci,
  `TrangThai` enum('Trong','DaCoNguoiO','DangDonDep','DangSuaChua') COLLATE utf8mb4_unicode_ci DEFAULT 'Trong'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTaiKhoan` int NOT NULL,
  `TenDangNhap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoDienThoai` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VaiTro` enum('Admin','QuanLy','NhanVien','KhachThue') COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrangThai` enum('HoatDong','Khoa') COLLATE utf8mb4_unicode_ci DEFAULT 'HoatDong',
  `NgayTao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `Email`, `SoDienThoai`, `VaiTro`, `TrangThai`, `NgayTao`) VALUES
(1, 'admin', 'CHUOI_MA_HOA', 'admin@happyhome.com', NULL, 'QuanLy', 'HoatDong', '2026-11-11 02:33:41'),
(2, 'kha', '$2y$10$o4S.JGKmeg4ZZVNM.VRmv.LMIL6tcVUB7IfO7NmWKiYyAT5.fX1Cm', 'akhan@happyhome.com', NULL, 'QuanLy', 'HoatDong', '2026-11-11 03:03:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `MaThanhToan` int NOT NULL,
  `MaHoaDon` int NOT NULL,
  `SoTien` decimal(15,2) NOT NULL,
  `NgayThanhToan` datetime DEFAULT CURRENT_TIMESTAMP,
  `PhuongThuc` enum('TienMat','ChuyenKhoan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `GhiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuchi`
--

CREATE TABLE `thuchi` (
  `MaThuChi` int NOT NULL,
  `MaThanhToan` int DEFAULT NULL,
  `MaNhanVien` int DEFAULT NULL,
  `Loai` enum('Thu','Chi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DanhMuc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoTien` decimal(15,2) NOT NULL,
  `NgayGiaoDich` datetime DEFAULT CURRENT_TIMESTAMP,
  `MoTa` text COLLATE utf8mb4_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`MaCongViec`),
  ADD KEY `MaNhanVien` (`MaNhanVien`),
  ADD KEY `MaPhong` (`MaPhong`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `MaKhachThue` (`MaKhachThue`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD UNIQUE KEY `MaHopDong` (`MaHopDong`,`KyThang`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`MaHopDong`),
  ADD KEY `MaKhachThue` (`MaKhachThue`),
  ADD KEY `MaPhong` (`MaPhong`);

--
-- Chỉ mục cho bảng `khachthue`
--
ALTER TABLE `khachthue`
  ADD PRIMARY KEY (`MaKhachThue`),
  ADD UNIQUE KEY `MaTaiKhoan` (`MaTaiKhoan`),
  ADD UNIQUE KEY `CCCD` (`CCCD`);

--
-- Chỉ mục cho bảng `kiennghi`
--
ALTER TABLE `kiennghi`
  ADD PRIMARY KEY (`MaKienNghi`),
  ADD KEY `MaKhachThue` (`MaKhachThue`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD UNIQUE KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`MaPhong`),
  ADD UNIQUE KEY `TenPhong` (`TenPhong`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTaiKhoan`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`MaThanhToan`),
  ADD KEY `MaHoaDon` (`MaHoaDon`);

--
-- Chỉ mục cho bảng `thuchi`
--
ALTER TABLE `thuchi`
  ADD PRIMARY KEY (`MaThuChi`),
  ADD UNIQUE KEY `MaThanhToan` (`MaThanhToan`),
  ADD KEY `MaNhanVien` (`MaNhanVien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `MaCongViec` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `MaDanhGia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHoaDon` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `MaHopDong` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachthue`
--
ALTER TABLE `khachthue`
  MODIFY `MaKhachThue` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `kiennghi`
--
ALTER TABLE `kiennghi`
  MODIFY `MaKienNghi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNhanVien` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `MaPhong` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTaiKhoan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `MaThanhToan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thuchi`
--
ALTER TABLE `thuchi`
  MODIFY `MaThuChi` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
