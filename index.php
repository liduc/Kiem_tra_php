
<?php
session_start();
include "config.php";

// Kiểm tra nếu có tham số logout trên URL thì đăng xuất
if (isset($_GET['logout'])) {
    session_destroy(); // Hủy session
    unset($_SESSION['user']); // Xóa session user nếu có
    header("Location: index.php"); // Chuyển hướng về trang chủ
    exit();
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #222;
            padding: 10px;
            text-align: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f4f4f4;
        }
        img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .actions a {
            margin-right: 10px;
            color: blue;
            text-decoration: none;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="index.php">Trang Chủ</a>
    <a href="views/students/list.php">Sinh Viên</a>
    <a href="views/courses/list.php">Học Phần</a>
    <a href="views/courses/register.php">Đăng Ký</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?logout=true">Đăng xuất</a>
    <?php else: ?>
        <a href="views/auth/login.php">Đăng Nhập</a>
    <?php endif; ?>
</div>

    
    <div class="container">
    <h1>Chào mừng đến với Hệ thống Đăng ký Học phần</h1>

<?php if (isset($_SESSION['user'])): ?>
    <p>Xin chào, <?= $_SESSION['user'] ?> | <a href="views/auth/logout.php">Đăng xuất</a></p>
    <p><a href="views/students/add.php">Thêm sinh viên</a></p>
<?php else: ?>
    <p><a href="views/students/add.php">Thêm sinh viên</a></p>
<?php endif; ?>

        
        <h2>Danh sách Sinh Viên</h2>
        <table>
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Mã Ngành</th>
                <th>Hình</th>
                <th>Hành Động</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM SinhVien");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaSV'] ?></td>
                    <td><?= $row['HoTen'] ?></td>
                    <td><?= $row['GioiTinh'] ?></td>
                    <td><?= $row['NgaySinh'] ?></td>
                    <td><?= $row['MaNganh'] ?></td>
                    <td><img src="<?= 'http://localhost/webdangkyhocphan/' . $row['Hinh'] ?>" alt="Ảnh sinh viên" width="100">
                    </td>

                    <td class="actions">
    <a href="views/students/edit.php?id=<?= $row['MaSV'] ?>">Edit</a>
    <a href="views/students/detail.php?id=<?= $row['MaSV'] ?>">Details</a>
    <a href="views/students/delete.php?id=<?= $row['MaSV'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</a>
</td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>