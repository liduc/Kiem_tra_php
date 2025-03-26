<?php
include "../../config.php"; 

// Lấy ID sinh viên từ URL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['HoTen'];
    $gioitinh = $_POST['GioiTinh'];
    $ngaysinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];

    $conn->query("UPDATE SinhVien SET HoTen='$hoten', GioiTinh='$gioitinh', NgaySinh='$ngaysinh', MaNganh='$maNganh' WHERE MaSV='$id'");
    header("Location: ../../index.php");
}
?>

<form method="post">
    <label>Họ Tên:</label>
    <input type="text" name="HoTen" value="<?= $row['HoTen'] ?>"><br>
    
    <label>Giới Tính:</label>
    <select name="GioiTinh">
        <option value="Nam" <?= ($row['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= ($row['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
    </select><br>

    <label>Ngày Sinh:</label>
    <input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>"><br>

    <label>Mã Ngành:</label>
    <input type="text" name="MaNganh" value="<?= $row['MaNganh'] ?>"><br>

    <button type="submit">Cập nhật</button>
</form>
<a href="../../index.php">Quay lại</a>
