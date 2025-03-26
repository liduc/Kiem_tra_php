<?php
include "../../config.php"; // Đảm bảo đường dẫn đúng

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['HoTen'];
    $gioitinh = $_POST['GioiTinh'];
    $ngaysinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];
    $hinh = $_POST['Hinh'];

    // Tạo mã sinh viên ngẫu nhiên (10 số)
    $masv = mt_rand(1000000000, 9999999999);
    $checkSQL = "SELECT * FROM SinhVien WHERE MaSV = '$masv'";
    $result = $conn->query($checkSQL);
    while ($result->num_rows > 0) {
        $masv = mt_rand(1000000000, 9999999999);
    }

    // Xử lý upload ảnh
    if (!empty($_FILES["HinhFile"]["name"])) {
        $target_dir = "../../assets/uploads/"; // Đảm bảo thư mục tồn tại
        $target_file = $target_dir . basename($_FILES["HinhFile"]["name"]);
        move_uploaded_file($_FILES["HinhFile"]["tmp_name"], $target_file);
        $hinh = "assets/uploads/" . basename($_FILES["HinhFile"]["name"]);
    }

    // Chèn dữ liệu vào database
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$masv', '$hoten', '$gioitinh', '$ngaysinh', '$hinh', '$maNganh')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../index.php"); // Quay về trang chính
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<h2>Thêm Sinh Viên</h2>
<form method="post" enctype="multipart/form-data">
    <label>Họ Tên:</label>
    <input type="text" name="HoTen" required><br>

    <label>Giới Tính:</label>
    <select name="GioiTinh">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br>

    <label>Ngày Sinh:</label>
    <input type="date" name="NgaySinh" required><br>

    <label>Mã Ngành:</label>
    <input type="text" name="MaNganh" required><br>

    <label>Ảnh (Nhập URL hoặc Upload):</label>
    <input type="text" name="Hinh" placeholder="Nhập URL ảnh"><br>
    <input type="file" name="HinhFile" accept="image/*"><br>

    <button type="submit">Thêm Sinh Viên</button>
</form>
<a href="../../index.php">Quay lại</a>
