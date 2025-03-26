<?php
include "../../config.php";

// Lấy ID sinh viên từ URL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$id'");
$row = $result->fetch_assoc();
?>

<h2>Thông tin chi tiết sinh viên</h2>
<p><b>Mã SV:</b> <?= $row['MaSV'] ?></p>
<p><b>Họ Tên:</b> <?= $row['HoTen'] ?></p>
<p><b>Giới Tính:</b> <?= $row['GioiTinh'] ?></p>
<p><b>Ngày Sinh:</b> <?= $row['NgaySinh'] ?></p>
<p><b>Mã Ngành:</b> <?= $row['MaNganh'] ?></p>
<p><b>Ảnh:</b> <br><img src="../../<?= $row['Hinh'] ?>" width="150"></p>

<a href="../../index.php">Quay lại</a>
