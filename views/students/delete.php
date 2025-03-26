<?php
include "../../config.php";

$id = $_GET['id'];

// Xóa sinh viên khỏi database
$conn->query("DELETE FROM SinhVien WHERE MaSV = '$id'");

// Chuyển hướng về trang chủ
header("Location: ../../index.php");
exit;
