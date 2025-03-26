<?php
session_start();
include "../../config.php";

// Kiểm tra nếu chưa đăng nhập thì chuyển về trang đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Truy vấn danh sách học phần
$result = $conn->query("SELECT * FROM HocPhan");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
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
        .register-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .register-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="../../index.php">Trang Chủ</a>
        <a href="../students/list.php">Sinh Viên</a>
        <a href="list.php">Học Phần</a>
        <a href="register.php">Đăng Ký</a>
        <a href="../auth/logout.php">Đăng Xuất</a>
    </div>
    
    <div class="container">
        <h2>DANH SÁCH HỌC PHẦN</h2>
        <table>
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Đăng Ký</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaHP'] ?></td>
                    <td><?= $row['TenHP'] ?></td>
                    <td><?= $row['SoTinChi'] ?></td>
                    <td><a href="register.php?mahp=<?= $row['MaHP'] ?>" class="register-btn">Đăng Ký</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
