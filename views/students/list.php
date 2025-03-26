<?php
include "../../config.php";
$result = $conn->query("SELECT * FROM SinhVien");
?>
<table border="1">
    <tr>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Giới Tính</th>
        <th>Ngày Sinh</th>
        <th>Hình</th>
        <th>Hành Động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['MaSV'] ?></td>
        <td><?= $row['HoTen'] ?></td>
        <td><?= $row['GioiTinh'] ?></td>
        <td><?= $row['NgaySinh'] ?></td>
        <td><img src="<?= $row['Hinh'] ?>" width="50"></td>
        <td>
            <a href="edit.php?id=<?= $row['MaSV'] ?>">Sửa</a> |
            <a href="delete.php?id=<?= $row['MaSV'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
