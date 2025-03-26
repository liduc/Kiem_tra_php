<?php
include "../../config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('{$_POST['MaSV']}', '{$_POST['HoTen']}', '{$_POST['GioiTinh']}', '{$_POST['NgaySinh']}', '{$_POST['Hinh']}', '{$_POST['MaNganh']}')";
    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<form method="POST">
    <input type="text" name="MaSV" placeholder="Mã SV">
    <input type="text" name="HoTen" placeholder="Họ tên">
    <input type="text" name="GioiTinh" placeholder="Giới tính">
    <input type="date" name="NgaySinh">
    <input type="text" name="Hinh" placeholder="URL hình">
    <input type="text" name="MaNganh" placeholder="Mã Ngành">
    <button type="submit">Thêm</button>
</form>
