<?php
session_start();
include "../../config.php";

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Lấy mã học phần từ URL
if (!isset($_GET['MaHP'])) {
    header("Location: list.php");
    exit();
}

$maHP = $_GET['MaHP'];
$maSV = $_SESSION['user_id']; // Lấy mã sinh viên từ session

// Kiểm tra xem sinh viên đã đăng ký học phần này chưa
$check = $conn->query("SELECT * FROM ChiTietDangKy WHERE MaSV='$maSV' AND MaHP='$maHP'");
if ($check->num_rows > 0) {
    echo "<script>alert('Bạn đã đăng ký học phần này rồi!'); window.location='list.php';</script>";
    exit();
}

// Tạo bản ghi đăng ký nếu chưa có
$conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), '$maSV')");
$maDK = $conn->insert_id; // Lấy mã đăng ký vừa tạo

// Thêm vào bảng ChiTietDangKy
$conn->query("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$maDK', '$maHP')");

echo "<script>alert('Đăng ký thành công!'); window.location='list.php';</script>";
?>
