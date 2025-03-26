<?php
session_start();
include "../../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$user'");
    
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $user;
        header("Location: ../../index.php"); // Chuyển hướng về trang chính
        exit();
    } else {
        $error = "Đăng nhập thất bại! Vui lòng kiểm tra lại.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Mã SV" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>

    </div>
</body>
</html>
